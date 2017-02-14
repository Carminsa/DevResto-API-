'use strict';

routeAppControllers.controller('IndexController', ['$scope', '$http',
    function($scope , $http){
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000',
        }).then(function successCallback(response) {
        });
    }
]);

routeAppControllers.controller('RegisterController', ['$scope', '$http', '$window', '$route', function ($scope, $http, $window, $route) {

    $scope.send = function () {

        let data = {
            login     : $scope.login,
            lastname  : $scope.lastname,
            firstname : $scope.firstname,
            password  : $scope.password
        };

        let config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'
            }
        };

        $http.post("http://localhost:8000/register", data, config)

            .then(function(data) {
                $route.reload();
            })
            .catch(function(data, status) {
            });
    }
}]);

routeAppControllers.controller('LoginController', ['$scope', '$http', '$window', '$route', '$cookies',  function ($scope, $http, $window, $route, $cookies) {

    $scope.logForm = function () {
        let data = {
            login_log     : $scope.login_log,
            password_log  : $scope.password_log
        };

        let config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'
            },
        };

        $http.post("http://localhost:8000/login", data, config)

            .then(function (data) {
                $cookies.put('DevResto', data.data);
                $window.location.href = '#/home';
            })
            .catch(function (data, status) {
                $scope.error = "Erreur dans le login ou Mot de Passe";
            });
    }
}]);