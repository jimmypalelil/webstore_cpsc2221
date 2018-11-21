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

    $scope.populateTable = function(tableType) {
        $http.get(makeAdminURL(tableType)).success(function(data) {
            if(typeof data === 'string') {
                $scope.table = '';
                $scope.item = '';
            } else 
                $scope.table = data;
        });
    }

    $scope.populateTable('USERS');
    $scope.selectedButton = 'USERS';

    $scope.setTableType = function(tableType) {
        $scope.tableType = tableType;
        if(tableType === 'USERS')       
            $scope.populateTable('USERS');       
        if(tableType === 'PRODUCTS')
            $scope.populateTable('PRODUCT');  
        if(tableType === 'ORDERS')
            $scope.populateTable('ORDERS');  
        if(tableType === 'Most Popular Brands')
            $scope.populateTable('popularBrands');  
        if(tableType === 'Most Popular Products')
            $scope.populateTable('popularProducts');  
        if(tableType === 'Price Stats By Brand') 
            $scope.populateTable('avgPrices');    
        if(tableType === 'User Stats') 
            $scope.populateTable('userStats');          
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

    $scope.views = ['USERS', 'PRODUCTS', 'ORDERS',
         'Most Popular Brands', 'Most Popular Products',
                'Price Stats By Brand', 'User Stats'];
}]);