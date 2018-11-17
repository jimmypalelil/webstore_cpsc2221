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
    $query = "SELECT * FROM PRODUCT";
    $result = $conn->query($query);
    sendRes($result);
} else if($tableType === 'ORDERS') {
    $query = "SELECT orderNo AS 'ORDER #', UID AS 'USER ID', orderDate as 'order date', totalPrice as 'total price'  FROM ORDERS";
    $result = $conn->query($query);
    sendRes($result);
} else if($tableType === 'popularBrands') {
    $query = "SELECT DISTINCT p.brand as 'brand (bought by every user)'
        FROM PRODUCT p
        WHERE NOT EXISTS
        (SELECT * FROM USERS u
            WHERE NOT EXISTS 
            (SELECT * FROM ORDERS o, ORDERITEMS ot
                WHERE o.orderNo = ot.orderNo AND ot.PID = p.PID AND o.UID = u.UID ))";
    $result = $conn->query($query);
    sendRes($result);
} else if($tableType === 'popularProducts') {
    $query = "SELECT p.name as 'Product name (bought by every user)', p.brand, p.price, p.year
        FROM PRODUCT p
        WHERE NOT EXISTS
        (SELECT * FROM USERS u
            WHERE NOT EXISTS 
            (SELECT * FROM ORDERS o, ORDERITEMS ot
                WHERE o.orderNo = ot.orderNo AND ot.PID = p.PID AND o.UID = u.UID ))";
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
    $query = "SELECT  brand AS BRAND, COUNT(*) AS 'total products', AVG(price) AS 'average price', SUM(price) as 'total price', 
        MAX(price) AS 'max price', MIN(price) AS 'min price' FROM PRODUCT GROUP BY brand ORDER BY COUNT(*) DESC";
    $result = $conn->query($query);
    sendRes($result);
} else if ($tableType === 'userStats') {    
    $query = "SELECT u.UID AS 'uid', u.email AS 'EMAIL', u.firstName AS 'FIRST NAME', u.lastName AS 'LAST NAME', 
                SUM(ot.quantity) AS 'Total Items Bought', ROUND(AVG(o.totalPrice)) AS 'average of Order Prices($)', 
                COUNT(DISTINCT p.brand) AS 'total unique brands bought from'
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
        echo json_encode($resultArray);
    } else {
        echo "0 results";
    }
}

?>

