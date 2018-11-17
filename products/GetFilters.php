<?php
session_start();

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

$productType = $_REQUEST["p"];
$filterType = $_REQUEST['filterType'];  

if($filterType === 'brand') {    
    $query = "SELECT DISTINCT brand FROM PRODUCT WHERE type='$productType' ORDER BY brand ASC";
    $result = $conn->query($query);
    sendRes($result);    
} else if($filterType === 'colour') {
    $query = "SELECT DISTINCT colour FROM PRODUCT WHERE type='$productType' ORDER BY colour ASC";
    $result = $conn->query($query);
    sendRes($result);
} else if($filterType === 'storage') {
    $query = "SELECT DISTINCT storage FROM PRODUCT WHERE type='$productType'";
    $result = $conn->query($query);
    sendRes($result);
} else if($filterType === 'price') {
    $query = "SELECT DISTINCT price + 100 - MOD(price,100) AS price FROM PRODUCT WHERE type='$productType' ORDER BY price ASC";
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