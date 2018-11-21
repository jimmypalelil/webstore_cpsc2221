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

$uid = $_REQUEST['uid'];

if($_REQUEST['req'] === 'getCartTotal') { //Get cart total for notification on nav bar
    $query = "SELECT SUM(sc.quantity) as 'total' FROM SHOPPING_CART sc WHERE sc.UID = '$uid'";

    $result = $conn->query($query);

    if($result->num_rows > 0) {
        echo $result->fetch_assoc()['total'];
    }
} else { //get cart items

    $orderingType = $_REQUEST['ot'];
    $ordering = $_REQUEST['o'];

    $cartQuery = "SELECT * FROM PRODUCT p, SHOPPING_CART sc WHERE p.PID = sc.PID AND sc.UID = '$uid' 
        order by $orderingType $ordering";

    $result = $conn->query($cartQuery);

    $totalPriceQuery = "SELECT SUM(totalPrice) as sum FROM SHOPPING_CART WHERE UID='$uid'";

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

}


function sendRes($dbResult, $uid, $totalPrice) {
    //Setup the PRODUCT display table
    echo "<table class='table'><tr>";
    echo "<th onclick='getCart(\"$uid\",\"type\")'>PRODUCT Type</th>";
    echo "<th onclick='getCart(\"$uid\",\"name\")'>Name</th>";
    echo "<th onclick='getCart(\"$uid\",\"brand\")'>Brand</th>";
    echo "<th onclick='getCart(\"$uid\",\"colour\")'>Colour</th>";
    echo "<th onclick='getCart(\"$uid\",\"quantity\")'>Quantity</th>";
    echo "<th onclick='getCart(\"$uid\",\"totalPrice\")'>Total</th>";     
    echo "<th>Remove FROM Cart</tr>";
    while($row = $dbResult->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".strtoupper($row['type'])."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['brand']."</td>";
        echo "<td>".$row['colour']."</td>";
        echo "<td>".$row['quantity']."</td>";
        echo "<td>$".$row['totalPrice']."</td>";        
        echo "<td><button class='btn btn-danger' onclick='setProductVars(" .$row['PID']. ",".$uid .")' data-toggle='modal' data-target='#removeFromCartModal'/>Remove from Cart</td>";
        echo "</tr>";
    }
    echo "<tr><td></td><td></td><td></td><td></td><td><b>Cart Total:</td>";
    echo "<td><b>$".$totalPrice."</td><td><button class='btn btn-primary' onclick='setUID(".$uid .")' data-toggle='modal' data-target='#addToOrdersModal'/>Checkout</td></tr>";
    echo "</table>";
}

?> 