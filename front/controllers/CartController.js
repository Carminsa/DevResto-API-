'use strict';

routeAppControllers.controller('PanierController', ['$scope', '$http', '$cookies','$window',

    function($scope , $http, $cookies, $window){

        var myToken = $cookies.get('DevResto');

        if (myToken)
        {
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
                })
                .catch(function(data, status) {

                });
        }else {
            $window.location.href = '#/';
        }
    }
]);

routeAppControllers.controller('NewController', ['$scope', '$http', function ($scope, $http) {

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
                $scope.message = "Produit Ajouté";
            })
            .catch(function (data, status) {
                $scope.error = "Un problème est survenue, merci de ressayer";
            });
    }
}]);