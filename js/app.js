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
            templateUrl: 'home.php'
        })
        .when("/usr/admin", {
            templateUrl: 'admin.php',
            controller: 'adminController'
        });
}]);

app.controller('mainController', ['$scope', '$rootScope', '$routeParams', function($scope, $rootScope, $routeParams) {    
    $rootScope.pageType = $routeParams.pageType;
    $rootScope.uid = $routeParams.uid;    
   

    $scope.registerUser = function() {
        registerUser($scope.email, $scope.password,$scope.firstName, $scope.lastName, $scope.address);
    }
}]);