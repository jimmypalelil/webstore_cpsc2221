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
$deleteQuery = "DELETE from shopping_cart where PID='$pid' and UID='$uid'";
    
$result = $conn->query($deleteQuery);

$conn->close();