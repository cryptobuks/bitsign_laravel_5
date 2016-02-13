angular
	.module('app', ['ui.router'])
	.config(['$urlRouterProvider', '$stateProvider', function($urlRouterProvider, $stateProvider){
		//Play nice with blade templating engine
		// $interpolateProvider.startSymbol('<@@');
  //       $interpolateProvider.endSymbol('@@>');

		$urlRouterProvider.otherwise('/');

		$stateProvider
			.state('home', {
				url: '/',
				templateUrl: 'home',
				controller: ['$scope', function($scope) {
					$scope.title = "Home";
					$scope.breadcrumbs = [''];
				}]
			})
			.state('createip', {
				url: '/ip/create',
				templateUrl: 'ip/create',
				controller: function($scope) {
					$scope.title = "Home";
					$scope.breadcrumbs = [''];
				}
			})
	}]);