<?php

$servername = "pfw0ltdr46khxib3.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "dg119y7d795dimsq";
$password = "jzcdnflbkyvt96fm";
$dbname = "c0jpw95ctoh4yqag";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tableType = $_REQUEST["t"];

if($tableType === 'USERS') {    
    $query = "SELECT * FROM USERS";
    $result = $conn->query($query);
    sendRes($result);    
} else if($tableType === 'PRODUCT') {
    $query = "SELECT * FROM PRODUCT ORDER BY name";
    $result = $conn->query($query);
    sendRes($result);
} else if($tableType === 'ORDERS') {
    $query = "SELECT orderNo AS 'ORDER_NO', UID AS 'USER_ID', orderDate as 'order_date', totalPrice as 'total_price'  FROM ORDERS";
    $result = $conn->query($query);
    sendRes($result);
} else if($tableType === 'popularBrands') {
    $query = "SELECT DISTINCT p.brand as 'brand_(bought by every user)'
                FROM PRODUCT p
                WHERE NOT EXISTS
                (SELECT * FROM USERS u
                    WHERE NOT EXISTS 
                    (SELECT * FROM ORDERS o, ORDERITEMS ot
                        WHERE o.orderNo = ot.orderNo AND ot.PID = p.PID AND o.UID = u.UID ))";
    $result = $conn->query($query);
    sendRes($result);
} else if($tableType === 'popularProducts') {
    $query = "SELECT p.name as 'Product_name_(bought_by_every_user)', p.brand, p.price, p.year, SUM(ot.quantity) AS 'quantity_sold'
                FROM PRODUCT p, ORDERITEMS ot
                WHERE p.PID = ot.PID AND NOT EXISTS
                (SELECT * FROM USERS u
                    WHERE NOT EXISTS 
                    (SELECT * FROM ORDERS o, ORDERITEMS ot
                        WHERE o.orderNo = ot.orderNo AND ot.PID = p.PID AND o.UID = u.UID ))
                GROUP BY p.PID";
    $result = $conn->query($query);
    sendRes($result);
} else if ($tableType === 'updatePrice') {
    $pid = $_REQUEST['pid'];
    $price = $_REQUEST['price'];
    $query = "UPDATE PRODUCT SET price='$price' WHERE PID='$pid'";
    $result = $conn->query($query);
    if($result)
        echo "Price changed successfully";
} else if ($tableType === 'avgPrices') {    
    $query = "SELECT  brand AS brand, COUNT(*) AS 'total_products', ROUND(AVG(price), 2) AS 'avg_price', SUM(price) as 'total_price', 
        MAX(price) AS 'max_price', MIN(price) AS 'min_price' FROM PRODUCT GROUP BY brand ORDER BY COUNT(*) DESC";
    $result = $conn->query($query);
    sendRes($result);
} else if ($tableType === 'userStats') {    
    $query = "SELECT u.UID AS 'uid', u.email AS 'email', u.firstName AS 'first_name', u.lastName AS 'last_name', 
                SUM(ot.quantity) AS 'total_items_bought', ROUND(AVG(DISTINCT o.totalPrice), 2) AS 'avg_order_prices', 
                COUNT(DISTINCT p.brand) AS 'total_unique_brands_bought_from'
                    FROM USERS u, ORDERS o, ORDERITEMS ot, PRODUCT p
                    WHERE u.UID = o.UID AND o.orderNo = ot.orderNo AND ot.PID = p.PID
                    GROUP BY u.UID";
    $result = $conn->query($query);
    sendRes($result);
}

$conn->close();

function sendRes($result) {
    if ($result->num_rows > 0) {
        // output data of each row   
        while ($row = $result->fetch_assoc()){
	        $resultArray[] = $row;
        }
        echo json_encode($resultArray,JSON_NUMERIC_CHECK);
    } else {
        echo "0 results";
    }
}

?>

