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

$uid = $_REQUEST['uid'];
$totalPriceQuery = "SELECT SUM(totalPrice) AS total FROM SHOPPING_CART WHERE UID='$uid'";

$priceResult = $conn->query($totalPriceQuery);
$totalPrice = $priceResult->fetch_assoc()['total'];

$sql = "INSERT INTO ORDERS(orderDate, UID, totalPrice) VALUES(CURRENT_DATE(), '$uid', '$totalPrice')";

if ($conn->query($sql) === TRUE) {
    $orderNo = $conn->insert_id;
    $query = "SELECT * FROM SHOPPING_CART WHERE UID=$uid";
    $result = $conn->query($query);
    while($row = $result->fetch_assoc()) {
        $insertQuery = "INSERT INTO ORDERITEMS VALUES($orderNo,".$row['PID'].",".$row['quantity'].",".$row['totalPrice'].")";
        $conn->query($insertQuery);
    }
    $delQuery = "DELETE FROM SHOPPING_CART WHERE UID='$uid'";
    $conn->query($delQuery);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();