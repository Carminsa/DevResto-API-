'use strict';

routeAppControllers.controller('HomeController', ['$scope', '$http',
    function($scope , $http){
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/home'
        }).then(function (data) {
            console.log(data);
        }).catch(function(){
            console.log('error');
        })
    }
]);