'use strict';

let routeApp = angular.module('routeApp', [
    'ngRoute',
    'routeAppControllers'
]);

routeApp.config(['$routeProvider',
    function($routeProvider) {

        $routeProvider
            .when('/', {
                templateUrl: 'views/default/index.html',
                controller: 'IndexController'
            })
            .when('/login',{
                templateUrl: 'views/default/home.html',
                controller: 'HomeController'
            })
            .otherwise({
                redirectTo: '/user'
            });
    }
]);

let routeAppControllers = angular.module('routeAppControllers', []);

routeAppControllers.controller('IndexController', ['$scope', '$http',
    function($scope , $http){
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000'
        }).then(function successCallback(response) {
            console.log(response);
            // if (response.data.length > 0) {
            //     $scope.message = response.data[0];
            // }
        });
    }
]);


routeAppControllers.controller('HomeController', ['$scope', '$http',
    function($scope , $http){
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/register'
        }).then(function successCallback(response) {
            console.log(response);
            // if (response.data.length > 0) {
            //     $scope.message = response.data[0];
            // }
        });
    }
]);

