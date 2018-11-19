app.controller('productController', ['$scope', '$http', '$routeParams', '$rootScope', function($scope, $http, $routeParams, $rootScope) {
    $scope.showFilters = false;

    $scope.getCartTotal();

    $rootScope.isAdmin = $routeParams.uid < 5;

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
        query = "./products/GetFilters.php?p=" + $routeParams.productType;
        query = query + "&filterType" + "=" + 'brand';
        $http.get(query).success(function(data) {
            $scope.brandOptions = data;
        });

        //Get Colour Filters
        query = "./products/GetFilters.php?p=" + $routeParams.productType;
        query = query + "&filterType" + "=" + 'colour';
        $http.get(query).success(function(data) {
            $scope.colourOptions = data;
        });

        //Get storage Filters
        query = "./products/GetFilters.php?p=" + $routeParams.productType;
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