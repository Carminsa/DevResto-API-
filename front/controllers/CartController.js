'use strict';

routeAppControllers.controller('PanierController', ['$scope', '$http', '$cookies',

    function($scope , $http, $cookies){

        var myToken = $cookies.get('DevResto');

        let data = {
            token : myToken
        };

        let config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'
            }
        };

        $http.post("http://localhost:8000/cart", data, config)

            .then(function(data) {
                $scope.data = data.data;
                console.log(data.data);
                // $window.location.href = '#/';
            })
            .catch(function(data, status) {
                // $scope.status = status;
                console.log(data + ' => ' + status);
            });
    }
]);

routeAppControllers.controller('NewController', ['$scope', '$http', function ($scope, $http ) {

    $scope.save = function () {

        let data = {
            name    : $scope.name,
            cost    : $scope.cost,
            quantity: $scope.quantity
        };

        let config = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'
            }
        };

        $http.post("http://localhost:8000/new", data, config)

            .then(function (data) {
                // $scope.data = data.data;
                console.log(data);
                // $window.location.href = '#/';
            })
            .catch(function (data, status) {
                // $scope.status = status;
                console.log(data + ' => ' + status);
            });
    }
}]);