var app = angular.module('myApp', ['ngRoute']);

app.config(function($routeProvider) {
    $routeProvider
        .when("/products/:pageType/:productType/:uid", {
            templateUrl: './products/productsView.php',
            controller: 'productController'
        })
        .when("/usr/:pageType/:uid", {
            templateUrl: './products/productsView.php',
            controller: 'productController'
        })
        .when("/usr/:pageType/:uid", {
            templateUrl: './products/productsView.php',
            controller: 'productController'
        });
});

app.controller('mainController', ['$scope', '$rootScope', '$routeParams', function($scope, $rootScope, $routeParams) {    
    $rootScope.pageType = $routeParams.pageType;
    $rootScope.uid = $routeParams.uid;    

    $scope.registerUser = function() {
        registerUser($scope.email, $scope.password,$scope.firstName, $scope.lastName, $scope.address);
    }
}]);

app.controller('productController', ['$scope', '$http', '$routeParams', '$rootScope', function($scope, $http, $routeParams, $rootScope) {
    $scope.showFilters = false;

    if($routeParams.pageType == 'products') {
        $scope.showFilters = true;
        getProduct($routeParams.uid, $routeParams.productType, "name");

        //Get Price Filters
        var query = "./products/GetFilters.php?p=" + $routeParams.productType;
        query = query + "&filterType" + "=" + 'price';
        $http.get(query).success(function(data) {            
            data.forEach(function(data) {                
                data['label'] = 'less than $' + data.price;
            });
            $scope.priceOptions = data;
        });
        
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
                $scope.priceFilterQuery = " AND price < '" + $scope.priceOptionSelected.price + "'";    
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
    } else if ($routeParams.pageType === 'shoppingCart') {
        getCart($routeParams.uid, "name");
    } else if($routeParams.pageType === 'orders') {
        getOrders($routeParams.uid, "orderNo");
    }
}]);