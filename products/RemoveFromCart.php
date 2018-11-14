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
$deleteQuery = "DELETE FROM SHOPPING_CART WHERE PID='$pid' AND UID='$uid'";
    
$result = $conn->query($deleteQuery);

$conn->close();