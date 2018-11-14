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

$orderType = $_REQUEST['ot'];
$ordering = $_REQUEST['o'];
$uid = $_REQUEST['uid'];

$orderNoQuery = "SELECT * from orders Where UID = '$uid'
    order by $orderType $ordering";

$orderNoResult = $conn->query($orderNoQuery);

if ($orderNoResult->num_rows > 0) {
    // output data of each row   
    sendRes($orderNoResult, $uid, $conn);        
} else {
    echo "0 results";
}
$conn->close();

function sendRes($dbResult, $uid, $conn) {
    //Setup the product display table
    echo "<table class='table'><tr>";
    echo "<th onclick='getOrders(\"$uid\",\"orderNo\")'>Order #</th>";
    echo "<th>Products</th>";
    echo "<th onclick='getOrders(\"$uid\",\"totalPrice\")'>Total</th></tr>"; 
    while($row = $dbResult->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['orderNo']."</td>";
        $productsQuery = "SELECT p.name, ot.quantity, ot.totalPrice from product p, orderitems ot where p.PID = ot.PID and ot.orderNo=". $row['orderNo'];
        $productResults = $conn->query($productsQuery);
        echo "<td>";
        while($productRow = $productResults->fetch_assoc()) {
            echo $productRow['name']. "\t|\tQuantity:\t ". $productRow['quantity']. "\t|\tTotal Price:\t".$productRow['totalPrice']."<hr class='my-4'>";
        }
        echo "</td>";
        echo "<td>$".$row['totalPrice']."</td>";        
        echo "</tr>";
    }
    echo "</table>";
}

?> 