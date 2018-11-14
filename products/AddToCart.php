<?php
$servername = "localhost";
$username = "root";
$password = "9830100Avenue";
$dbname = "webstore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$pid = $_REQUEST["pid"];
$uid = $_REQUEST['uid'];
$quantity = $_REQUEST['q'];
$priceQuery = "SELECT price from product where PID=$pid";
$priceResult = $conn->query($priceQuery);
$priceResult = $priceResult->fetch_assoc()['price'];
$totalPrice = $priceResult * $quantity;

$query = "REPLACE into shopping_cart values ($uid, $pid, $quantity, $totalPrice)";
    
$result = $conn->query($query);

$conn->close();