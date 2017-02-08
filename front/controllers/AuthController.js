'use strict';

routeAppControllers.controller('IndexController', ['$scope', '$http',
    function($scope , $http){
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000'
            // }).then(function successCallback(response) {
            //     console.log(response);
            // if (response.data.length > 0) {
            //     $scope.message = response.data[0];
            // }
        });
    }
]);

routeAppControllers.controller('RegisterController', ['$scope', '$http',function ($scope, $http) {

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
                // $scope.data = data;
                console.log('success');
                console.log(data);
            })

            .catch(function(data, status) {
                // $scope.status = status;
                console.log(data + ' => ' + status);
            });
    }
}]);

routeAppControllers.controller('LoginController', ['$scope', '$http',function ($scope, $http) {

    $scope.logForm = function () {
        console.log(1);
        let data = {
            login_log     : $scope.login_log,
            password_log  : $scope.password_log
        };

        let config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'
            }
        };

        $http.post("http://localhost:8000/login", data, config)

            .then(function successLog(data) {
                // $scope.data = data;
                console.log('success');
                console.log(data);
            })

            .catch(function errorLog(data, status) {
                // $scope.status = status;
                console.log(data + ' => ' + status);
            });
    }
}]);

