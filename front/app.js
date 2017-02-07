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
            .when('/register',{
                templateUrl: 'views/default/home.html',
                controller: 'HomeController'
                // })
                // .otherwise({
                //     redirectTo: '/user'
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

// routeAppControllers.controller('HomeController',  ['$scope', '$http',
//     function($scope , $http){
//
//         console.log($scope.allo);
//
//         let data = $.param({
//             fName: $scope.login,
//         });
//
//
//         let config = {
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
//             }
//         };
//
//         $http.post('http://127.0.0.1:8000/register', data, config)
//             .then(function (data, status) {
//                 $scope.PostDataResponse = data;
//                 console.log(data);
//             }).catch(function(data,status){
//             $scope.ResponseDetails = "Data: " + data +
//                 "<hr />status: " + status ;
//         })
//     }
// ]);

routeAppControllers.controller('testController', ['$scope', '$http',function($scope, $http) {

    $scope.update = function () {

        console.log($scope.login);

        var data = {
            name : $scope.login
        };

        $http.post("http://localhost:8000/register", {login : $scope.login})
            .success(function(data, status, headers, config) {
                //$scope.data = data;
                console.log(data);
            }).error(function(data, status, headers, config) {
                    console.log("http post function");
            //$scope.status = status;
        });

        // $http.post("http://localhost:8000/register", data)
        //     .success(function (data) {
        //         // $scope.PostDataResponse = data;
        //         console.log(data);
        //         console.log("http post function");
        //
        //     }).error(function(data, status){
        //         console.log(data);
        // });
    }
}]);

