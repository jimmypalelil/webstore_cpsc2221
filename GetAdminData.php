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
    $query = "SELECT * FROM ORDERS";
    $result = $conn->query($query);
    sendRes($result);
} else if($tableType === 'popularBrands') {
    $query = "SELECT * FROM ORDERS";
    $result = $conn->query($query);
    sendRes($result);
} else if($tableType === 'popularProducts') {
    $query = "SELECT * FROM ORDERS";
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
    $query = "SELECT  brand, AVG(price) AS average, SUM(price) as total, COUNT(*) as 'total products', 
        MAX(price) as 'max price', MIN(price) as 'min price' FROM PRODUCT GROUP BY brand";
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