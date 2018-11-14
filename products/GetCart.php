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

$orderingType = $_REQUEST['ot'];
$ordering = $_REQUEST['o'];
$uid = $_REQUEST['uid'];

$cartQuery = "SELECT * from product p, shopping_cart sc Where p.PID = sc.PID AND sc.UID = '$uid' 
    order by $orderingType $ordering";

$result = $conn->query($cartQuery);

$totalPriceQuery = "SELECT SUM(totalPrice) as sum from shopping_cart where UID='$uid'";

$totalPrice = $conn->query($totalPriceQuery);

if ($result->num_rows > 0) {
    // output data of each row   
    $totalPrice = $totalPrice->fetch_assoc();
    $totalPrice = $totalPrice['sum'];
    sendRes($result, $uid, $totalPrice);
} else {
    echo "0 results";
}
$conn->close();

function sendRes($dbResult, $uid, $totalPrice) {
    //Setup the product display table
    echo "<table class='table'><tr>";
    echo "<th onclick='getCart(\"$uid\",\"type\")'>Product Type</th>";
    echo "<th onclick='getCart(\"$uid\",\"name\")'>Name</th>";
    echo "<th onclick='getCart(\"$uid\",\"brand\")'>Brand</th>";
    echo "<th onclick='getCart(\"$uid\",\"colour\")'>Colour</th>";
    echo "<th onclick='getCart(\"$uid\",\"quantity\")'>Quantity</th>";
    echo "<th onclick='getCart(\"$uid\",\"totalPrice\")'>Total</th>";     
    echo "<th>Remove From Cart</tr>";
    while($row = $dbResult->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".strtoupper($row['type'])."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['brand']."</td>";
        echo "<td> ".$row['colour']."</td>";
        echo "<td>".$row['quantity']."</td>";
        echo "<td>$".$row['totalPrice']."</td>";        
        echo "<td><button class='btn btn-danger' onclick='setProductVars(" .$row['PID']. ",".$uid .")' data-toggle='modal' data-target='#removeFromCartModal'/>Remove From Cart</td>";
        echo "</tr>";
    }
    echo "<tr><td></td><td></td><td></td><td></td><td><b>Cart Total:</td>";
    echo "<td><b>$".$totalPrice."</td><td><button class='btn btn-primary' onclick='setUID(".$uid .")' data-toggle='modal' data-target='#addToOrdersModal'/>Checkout</td></tr>";
    echo "</table>";
}

?> 