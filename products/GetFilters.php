<?php
session_start();

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

$productType = $_REQUEST["p"];
$filterType = $_REQUEST['filterType'];  

if($filterType === 'brand') {    
    $query = "SELECT DISTINCT brand from product Where type='$productType'";
    $result = $conn->query($query);
    sendRes($result);    
} else if($filterType === 'colour') {
    $query = "SELECT DISTINCT colour from product Where type='$productType'";
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