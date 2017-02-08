'use strict';

let routeApp = angular.module('routeApp', [
    'ngRoute',
    'routeAppControllers'
]);

routeApp.config(['$routeProvider',
    function($routeProvider) {

        $routeProvider
            .when('/', {
                templateUrl: 'views/auth/index.html',
                controller: 'IndexController'
            })
            .when('/home',{
                templateUrl: 'views/home/index.html',
                controller: 'HomeController'
            })
            .when('/login',{
            //     templateUrl: 'views/auth/index.html',
            //     controller: 'LoginController'
                // .otherwise({
                //     redirectTo: '/user'
            });
    }
]);

var routeAppControllers = angular.module('routeAppControllers', []);

