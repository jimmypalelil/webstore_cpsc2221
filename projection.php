<?php

session_start();

$servername = "pfw0ltdr46khxib3.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "dg119y7d795dimsq";
$password = "jzcdnflbkyvt96fm";
$dbname = "c0jpw95ctoh4yqag";


$conn = new mysqli($servername, $username, $password, $dbname);

$req = $_REQUEST['field'];

$query = "SELECT DISTINCT $req FROM PRODUCT";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    // output data of each row   
    while ($row = $result->fetch_assoc()){
        $resultArray[] = $row;
    }
    echo json_encode($resultArray,JSON_NUMERIC_CHECK);
}

?>