angular
	.module('app')
	.controller('createcontrCtrl', ['$scope', '$http', '$state', function ($scope, $http, $state) {
		$scope.title = "Create Contract";
		// create a blank object to hold our form information
      	// $scope will allow this to pass between controller and view
      	$scope.formData = {type: '1'};
      	//$http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
      	// process the form
      	$scope.save = function(){
	        $http.post('/contracts',$scope.formData).success(function (data) {
	        	console.log(data.contract_id);
	            if (!data.success) {
			      // if not successful, bind errors to error variables
			      $scope.errorTitle = data.errors.title;
			      $scope.errorContent = data.errors.content;
			    } else {
			      // if successful, bind success message to message
			      $state.go('addfiles',{contractId: data.contract_id});
			    }
	        });
	    };
	} ]);

angular
	.module('app')
	.controller('editcontrCtrl', ['$scope', '$http', '$state','$stateParams' , function ($scope, $http, $state, $stateParams) {
		$scope.title = "Edit Contract";
		// create a blank object to hold our form information
      	// $scope will allow this to pass between controller and view
      	$scope.formData = {};
      	$scope.init = function (){
	        $http.get('/contracts/'+$stateParams.contractId+'/edit').success(function(data){
	            $scope.formData=data;
	        })
	    };
      	// process the form
      	$scope.save = function(){
	        $http.post('/contracts/'+$stateParams.contractId,$scope.formData).success(function (data) {
	            if (!data.success) {
			      // if not successful, bind errors to error variables
			      $scope.errorTitle = data.errors.title;
			      $scope.errorContent = data.errors.content;
			    } else {
			      // if successful, bind success message to message
			      $state.go('addfiles',{contractId: data.contract_id});
			    }
	        });
	    };
	    $scope.init();
	} ]);

angular
	.module('app')
	.controller('indexcontrCtrl', ['$scope', '$http', function ($scope, $http) {
		$scope.title = "My Contracts";
		$scope.breadcrumbs = {'root':'Dashboard','parent':'Contracts','child':'My Contracts'};
		$scope.contracts=[];
		// get and fill data
		$scope.init = function (){
	        $http.get('/contracts/index/1').success(function(data){
	            $scope.contracts=data;
	        });
	    };
	 
	    $scope.save = function(){
	        $http.post('/api/todo',$scope.newTodo).success(function (data) {
	            $scope.todos.push(data);
	            $scope.newTodo={};
	        });
	    };
	 
	    $scope.update = function(index){
	         $http.put('/api/todo/'+ $scope.todos[index].id,$scope.todos[index]);
	    };
	 
	    $scope.delete = function(index){
	         $http.delete('/api/todo/'+ $scope.todos[index].id).success(function(){
	             $scope.todos.splice(index,1);
	         });
	    };

	    $scope.init();
	} ]);

angular
	.module('app')
	.controller('addfilesCtrl', ['$scope', '$http', '$stateParams', '$log', 'uiUploader', '$auth', function ($scope, $http, $stateParams, $log, uiUploader, $auth) {
		$scope.title = "Add Files";
		$scope.breadcrumbs = {'root':'Dashboard','parent':'Contracts','child':'My Contracts'};
		$scope.contractID = $stateParams.contractId;
		// get and fill data
		$scope.files = [];
		$scope.init = function (){
	        $http.get('file/'+$stateParams.contractId+'/index').success(function(data){
	            $scope.files=data;
	        });
	    };
	 
	    $scope.delete = function(index) {
            $log.info('deleting=' + index);
            var file = $scope.files[index];
            $http.get('file/'+ file.id +'/delete').success(function(data){
	            if (data.success) {
	            	$log.info('successfully deleted');
	            	$scope.files.splice(index,1);
	            }
	        });
        };
        // $scope.btn_clean = function() {
        //     uiUploader.removeAll();
        // };

        var element = document.getElementById('files');
        element.addEventListener('change', function(e) {
            var files = e.target.files;
            uiUploader.addFiles(files);
            $log.info('uploading...');
            uiUploader.startUpload({
                url: 'file/'+ $stateParams.contractId +'/store',
                concurrency: 2,
                headers: {
                    'Authorization': 'Bearer '+ $auth.getToken(),
                    'Accept': 'application/json'
                },
                onProgress: function(file) {
                    $log.info(file.name + '=' + file.humanSize);
                    //$scope.$apply();
                },
                onCompleted: function(file, response) {
                    $scope.files.push(JSON.parse(response)[0]);
                    $scope.$apply();
                }
            });
            
        });

	    $scope.init();
	} ]);