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
                 // console.log(data.data);

             }).catch(function () {
                 console.log('error');
             });

             $scope.send = function (id) {

                 cart.push(id);

                 // var myToken = $cookies.get('DevResto');

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
                         // $scope.data = data;
                         console.log('Home');
                         console.log(data);
                         // $route.reload();
                         // $window.location.href = '#/';
                     })

                     .catch(function (data, status) {
                         // $scope.status = status;
                         console.log(data + ' => ' + status);
                     });

             }
         }else {
             $window.location.href = '#/';
         }
    }
]);

