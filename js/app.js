var app = angular.module('myApp', ['ngRoute']);

app.config(['$routeProvider', function($routeProvider) {
    $routeProvider
        .when("/products/:pageType/:productType/:uid", {
            templateUrl: './products/productsView.php',
            controller: 'productController'
        })
        .when("/usr/:pageType/:uid", {
            templateUrl: './products/productsView.php',
            controller: 'productController'
        })
        .when("/", {
            templateUrl: 'home.php',
            controller: 'mainController'
        })
        .when("/home/:uid", {
            templateUrl: 'home.php',
            controller: 'mainController'
        })
        .when("/usr/admin/home/:uid", {
            templateUrl: 'admin.php',
            controller: 'adminController'
        });
}]);

app.controller('mainController', ['$scope', '$rootScope', '$routeParams', '$http', function($scope, $rootScope, $routeParams, $http) {    
    $rootScope.pageType = $routeParams.pageType;
    $rootScope.isAdmin = $routeParams.uid < 5;    
   
    $scope.getCartTotal = function() {        
        var url = './products/GetCart.php?uid=' + $routeParams.uid;
        url = url + '&req=getCartTotal'
        $http.get(url).success(function(data) {
            $rootScope.cartTotal = data;
        })    
    }    

    $scope.getCartTotal();

    $scope.tab = 'home';

    $scope.registerUser = function() {
        registerUser($scope.email, $scope.password,$scope.firstName, $scope.lastName, $scope.address);
    }

    $scope.setTab = function(tab) {
        $scope.tab = tab;
    }
}]);