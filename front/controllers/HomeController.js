'use strict';

var cart = [];

routeAppControllers.controller('HomeController', ['$scope', '$http', '$cookies', '$window',

    function($scope , $http, $cookies, $window){

        var myToken = $cookies.get('DevResto');

        if (myToken) {

            $http({
                method: 'GET',
                url: 'http://127.0.0.1:8000/home'
            }).then(function (data) {
                $scope.data = data.data;
            }).catch(function () {
                $scope.error = "Une Erreur est Survenue, merci de ressayer";
            });

            $scope.send = function (id) {

                cart.push(id);

                var purchase = {
                    products: cart,
                    token: myToken
                };

                let config = {
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'
                    }
                };

                $http.post("http://localhost:8000/add", purchase, config)
                    .then(function (data) {
                    })
                    .catch(function (data, status) {
                        $scope.error = "Une Erreur est Survenue, merci de ressayer";
                    });
            }
        }else {
            $window.location.href = '#/';
        }
    }
]);

