angular
	.module('app', ['ui.router', 'ui.tinymce', 'ui.bootstrap', 'satellizer', 'ui.uploader', 'ui.select', 'ngSanitize'])
	.config(['$urlRouterProvider', '$stateProvider', '$authProvider','$provide', '$httpProvider', function($urlRouterProvider, $stateProvider, $authProvider, $provide, $httpProvider){
  		$authProvider.loginUrl = '/api/authenticate';

		$urlRouterProvider.otherwise('/login');

		$stateProvider
			.state('home', {
				url: '/',
				templateUrl: 'app/views/home.html',
				controller: 'homeController'
			})
			.state('createip', {
				url: '/ip/create',
				templateUrl: 'ip/create',
				controller: ['$scope', function($scope) {
					$scope.title = "Create IP";
					$scope.breadcrumbs = [''];
				}]
			})
			.state('manageip', {
				url: '/ip/manage',
				templateUrl: 'ip/index',
				controller: function($scope) {
					$scope.title = "Manage IP";
					$scope.breadcrumbs = [''];
				}
			})
			.state('pendingsigs', {
				url: '/signatures/pending',
				templateUrl: 'signatures/pending',
				controller: function($scope) {
					$scope.title = "Pending Signatures";
					$scope.breadcrumbs = [''];
				}
			})
			.state('completedsigs', {
				url: '/signatures/completed',
				templateUrl: 'signatures/signed',
				controller: function($scope) {
					$scope.title = "Completed Signatures";
					$scope.breadcrumbs = [''];
				}
			})
			.state('mycontracts', {
				url: '/contracts',
				templateUrl: 'app/views/contract/index.html',
				controller: 'indexcontrCtrl'
			})
			.state('createcontract', {
				url: '/contracts/create',
				templateUrl: 'app/views/contract/create.html',
				controller: 'createcontrCtrl'
			})
			.state('editcontract', {
				url: '/contracts/{contractId}/edit',
				templateUrl: 'app/views/contract/edit.html',
				controller: 'editcontrCtrl',
				params: {
				    'contractId': 'new'
				  }
			})
			.state('createtemplate', {
				url: '/template/create',
				templateUrl: 'templates/create',
				controller: function($scope) {
					$scope.title = "Create Template";
					$scope.breadcrumbs = [''];
				}
			})
			.state('addfiles', {
				url: '/contract/{contractId}/files',
				templateUrl: 'app/views/file/create.html',
				controller: 'addfilesCtrl',
				params: {
				    'contractId': 'nothing'
				  }
			})
			.state('addsignees', {
				url: '/contract/{contractId}/signees',
				views: {
				    'menu': {
				        templateUrl:
				                 function (stateParams){
				                    return 'contract/'+stateParams.contractId+'/signees';
				            	}
				    }
				},
				controller: function($scope) {
					$scope.title = "Completed Signatures";
					$scope.breadcrumbs = [''];
				}
			})
			.state('login', {
                url: '/login',
                templateUrl: '/app/views/auth/login.html',
                controller: 'AuthController'
            })
            .state('register', {
                url: '/register',
                templateUrl: '/js/tpl/register.html',
                controller: 'AuthController'
            });
			function redirectWhenLoggedOut($q, $injector) {
	            return {
	                responseError: function (rejection) {
	                    var $state = $injector.get('$state');
	                    var rejectionReasons = ['token_not_provided', 'token_expired', 'token_absent', 'token_invalid'];
	 
	                    angular.forEach(rejectionReasons, function (value, key) {
	                        if (rejection.data.error === value) {
	                            localStorage.removeItem('user');
	                            $state.go('login');
	                        }
	                    });
	 
	                    return $q.reject(rejection);
	                }
	            }
	        }
	 
	        $provide.factory('redirectWhenLoggedOut', redirectWhenLoggedOut);
	}]);