var app = angular.module('myApp', ['ngRoute']);

app.config(function($routeProvider) {
    $routeProvider
        .when("/products/:productType/:uid", {
            templateUrl: './products/products.php',
            controller: 'productController'
        })
        .when("/usr/shoppingCart/:uid", {
            templateUrl: './products/cart.php',
            controller: 'cartController'
        })
        .when("/usr/orders/:uid", {
            templateUrl: './products/orders.php',
            controller: 'orderController'
        });
});

app.controller('mainController', ['$scope', '$rootScope', '$routeParams', function($scope, $rootScope, $routeParams) {
    

    $scope.setProductType = function() {
        $rootScope.productType = $routeParams.productType;
        $rootScope.uid = $routeParams.uid;
    };

    $scope.registerUser = function() {
        registerUser($scope.email, $scope.password,$scope.firstName, $scope.lastName, $scope.address);
    }
}]);

app.controller('productController', ['$scope', '$http', '$routeParams', '$rootScope', function($scope, $http, $routeParams, $rootScope) {
    getProduct($routeParams.uid, $routeParams.productType, "name");

    //Get Brand Filters
    var query = "./products/GetFilters.php?p=" + $routeParams.productType;
    query = query + "&filterType" + "=" + 'brand';
    $http.get(query).success(function(data) {
        $scope.brandOptions = data;
    });

    //Get Colour Filters
    var query = "./products/GetFilters.php?p=" + $routeParams.productType;
    query = query + "&filterType" + "=" + 'colour';
    $http.get(query).success(function(data) {
        $scope.colourOptions = data;
    });

    //Get storage Filters
    var query = "./products/GetFilters.php?p=" + $routeParams.productType;
    query = query + "&filterType" + "=" + 'storage';
    $http.get(query).success(function(data) {
        $scope.storageOptions = data;
    });

    $scope.filterProducts = function() {
        if($scope.priceOptionSelected == null) {
            $scope.priceFilterQuery = '';
        } else {
            $scope.priceFilterQuery = " AND price < '" + $scope.priceOptionSelected.id + "'";    
        }
        if($scope.brandOptionSelected == null) {
            $scope.brandFilterQuery = '';
        } else {
            $scope.brandFilterQuery = " AND brand = '" + $scope.brandOptionSelected.brand + "'";
        }
        if($scope.colourOptionSelected == null) {
            $scope.colourFilterQuery = '';
        } else {
            $scope.colourFilterQuery = " AND colour = '" + $scope.colourOptionSelected.colour + "'";
        }
        if($scope.storageOptionSelected == null) {
            $scope.storageFilterQuery = '';
        } else {
             $scope.storageFilterQuery = " AND storage = '" + $scope.storageOptionSelected.storage + "'";
        }         
        
        $scope.query = "SELECT * FROM PRODUCT WHERE type = '" + $routeParams.productType + "'" + $scope.priceFilterQuery 
                + $scope.brandFilterQuery + $scope.colourFilterQuery + $scope.storageFilterQuery + ";";
        getFilteredProducts($routeParams.uid, $routeParams.productType, $scope.query);
    }    

    $scope.priceOptions = [{
        id: 500,
        label: 'less than $500'
      }, {
        id: 1000,
        label: 'less than $1000'
      },{
        id: 1500,
        label: 'less than $1500'
      }, {
        id: 2500,
        label: 'less than $2500'
      }];
}]);

app.controller('cartController', ['$scope', '$http', '$routeParams', '$rootScope', function($scope, $http, $routeParams, $rootScope) {
    getCart($routeParams.uid, "name");
}]);

app.controller('orderController', ['$scope', '$http', '$routeParams', '$rootScope', function($scope, $http, $routeParams, $rootScope) {
    getOrders($routeParams.uid, "orderNo");
}]);