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
                // $scope.data = data;
                console.log(data.data);
                // $window.location.href = '#/';
            })
            .catch(function(data, status) {
                // $scope.status = status;
                console.log(data + ' => ' + status);
            });
    }
]);