'use strict';

let routeApp = angular.module('routeApp', [
    'ngRoute',
    'routeAppControllers',
    'ngCookies',
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
            .when('/cart',{
                templateUrl: 'views/panier/cart.html',
                controller: 'PanierController'
            })
            .when('/new',{
                templateUrl: 'views/panier/create.html',
                controller: 'NewController'
            })
            .otherwise({
                redirectTo: '/'
            });
    }
]);

var routeAppControllers = angular.module('routeAppControllers', []);

