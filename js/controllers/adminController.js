app.controller('adminController',  ['$scope', '$http','$rootScope', '$routeParams', function($scope, $http, $rootScope, $routeParams) {

    $rootScope.isAdmin = true;

    $scope.getCartTotal();

    var makeAdminURL = function(tableName) {
        return "GetAdminData.php?t=" + tableName;
    }

    $scope.setSortKey = function(key) {
        if($scope.sortKey === key) {
            $scope.sortKey = '-' + $scope.sortKey;
            $scope.sortKeyDown = key;
        }
        else {
            $scope.sortKey = key;
            $scope.sortKeyDown = '';
        }
    }    

    $scope.setTableType = function(tableType) {
        $scope.tableType = tableType;
        if(tableType === 'Get USERS')       
            $scope.table = $scope.users;        
        if(tableType === 'Get PRODUCTS')
            $scope.table = $scope.products;
        if(tableType === 'Get ORDERS')
            $scope.table = $scope.orders;
        if(tableType === 'Get Most Popular Brands')
            $scope.table = $scope.popBrands;
        if(tableType === 'Get Most Popular Products')
            $scope.table = $scope.popProducts;
        if(tableType === 'Get Price Stats By Brand') 
            $scope.table = $scope.avgPrices;  
        if(tableType === 'Get User Stats') 
            $scope.table = $scope.userStats; 
        if(typeof $scope.table === 'string') {
            $scope.table = '';
            $scope.item = '';
        } 
    }

    //The table to view
    $scope.setButton = function(button) {
        $scope.selectedButton = button;        
    }

    //set the item for update modal
    $scope.setUpdateItem = function(item) {        
        $scope.updateItem = item;
    }

    //Update Price entry
    $scope.updateEntry = function() {
        var url = makeAdminURL("updatePrice");
        url = url + "&pid=" + $scope.updateItem.PID;
        url = url + "&price=" + $scope.newPrice;
        $http.post(url).success(function(data) {
            alert(data);
        });  
    }

    $scope.setUpdatePrice =function(price) {
        $scope.newPrice = price;
        $scope.updateItem.price = price;
    } 

    $scope.views = ['Get USERS', 'Get PRODUCTS', 'Get ORDERS',
         'Get Most Popular Brands', 'Get Most Popular Products',
                'Get Price Stats By Brand', 'Get User Stats'];

    $http.get(makeAdminURL("USERS")).success(function(data) {$scope.users = data; $scope.table = $scope.users; $scope.setButton('Get USERS')});
    $http.get(makeAdminURL("PRODUCT")).success(function(data) {$scope.products = data;});
    $http.get(makeAdminURL("ORDERS")).success(function(data) {$scope.orders = data;});
    $http.get(makeAdminURL("popularBrands")).success(function(data) {$scope.popBrands = data;});
    $http.get(makeAdminURL("popularProducts")).success(function(data) {$scope.popProducts = data;});
    $http.get(makeAdminURL("avgPrices")).success(function(data) {$scope.avgPrices = data;});
    $http.get(makeAdminURL("userStats")).success(function(data) {$scope.userStats = data;});
}]);