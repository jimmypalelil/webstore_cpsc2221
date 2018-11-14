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

$uid = $_REQUEST['uid'];
$totalPriceQuery = "SELECT SUM(totalPrice) as total from shopping_cart where UID='$uid'";

$priceResult = $conn->query($totalPriceQuery);
$totalPrice = $priceResult->fetch_assoc()['total'];

$sql = "insert into orders(orderDate, UID, totalPrice) values(CURRENT_DATE(), '$uid', '$totalPrice')";

if ($conn->query($sql) === TRUE) {
    $orderNo = $conn->insert_id;
    $query = "SELECT * from shopping_cart where uid=$uid";
    $result = $conn->query($query);
    while($row = $result->fetch_assoc()) {
        $insertQuery = "Insert into orderitems values($orderNo,".$row['PID'].",".$row['quantity'].",".$row['totalPrice'].")";
        $conn->query($insertQuery);
    }
    $delQuery = "DELETE from shopping_cart where UID='$uid'";
    $conn->query($delQuery);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();