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
        var xmlhttp = new XMLHttpRequest();
        var query = "/term\ project/UserAction.php?req=register";
        query = query + "&email=" + $scope.email;
        query = query + "&password=" + $scope.password;
        query = query + "&firstName=" + $scope.firstName;
        query = query + "&lastName=" + $scope.lastName;
        query = query + "&address=" + $scope.address;
        xmlhttp.open("POST", query, true);
        xmlhttp.send();     
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
            }
        }; 
    }
}]);

app.controller('productController', ['$scope', '$http', '$routeParams', '$rootScope', function($scope, $http, $routeParams, $rootScope) {
    getProduct($routeParams.uid, $routeParams.productType, "name");

          
    var query = "./products/GetFilters.php?p=" + $routeParams.productType;
    query = query + "&filterType" + "=" + 'brand';
    $http.get(query).success(function(data) {
        $scope.brandOptions = data;
    });

    var query = "./products/GetFilters.php?p=" + $routeParams.productType;
    query = query + "&filterType" + "=" + 'colour';
    $http.get(query).success(function(data) {
        $scope.colourOptions = data;
    });
    
    $scope.filterPrice = function() {
        getPriceFilteredProducts($routeParams.uid, $routeParams.productType, $scope.priceOptionSelected.id);
    }

    $scope.filterBrand = function() {
        getBrandFilteredProducts($routeParams.uid, $routeParams.productType, $scope.brandOptionSelected.brand);
    }

    $scope.filterColour = function() {
        getColourFilteredProducts($routeParams.uid, $routeParams.productType, $scope.colourOptionSelected.colour);
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