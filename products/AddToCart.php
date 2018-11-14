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

$pid = $_REQUEST["pid"];
$uid = $_REQUEST['uid'];
$quantity = $_REQUEST['q'];
$priceQuery = "SELECT price FROM PRODUCT WHERE PID=$pid";
$priceResult = $conn->query($priceQuery);
$priceResult = $priceResult->fetch_assoc()['price'];
$totalPrice = $priceResult * $quantity;

$query = "REPLACE INTO SHOPPING_CART VALUES ($uid, $pid, $quantity, $totalPrice)";
    
$result = $conn->query($query);

$conn->close();