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
$orderingType = $_REQUEST['ot'];
$ordering = $_REQUEST['o'];
$uid = $_REQUEST['uid'];
$req = $_REQUEST['req'];

if($req === 'all') {

    $query = "SELECT * from product Where type='$productType' 
    order by $orderingType $ordering";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // output data of each row   
        sendRes($result, $productType, $uid);
    } else {
        echo "0 results";
    }
    $conn->close();
} else if($req === 'filterPrice') {
    $price = $_REQUEST['price'];
    $query = "SELECT * from product Where type='$productType' and price < '$price'
    order by $orderingType $ordering";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // output data of each row   
        sendRes($result, $productType, $uid);
    } else {
        echo "0 results";
    }
    $conn->close();
}else if($req === 'filterBrand') {
    $brand = $_REQUEST['brand'];
    $query = "SELECT * from product Where type='$productType' and brand = '$brand'
        order by $orderingType $ordering";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // output data of each row   
        sendRes($result, $productType, $uid);
    } else {
        echo "0 results";
    }
    $conn->close();
} else if($req === 'filterColour') {
    $colour = $_REQUEST['colour'];
    $query = "SELECT * from product Where type='$productType' and colour = '$colour'
        order by $orderingType $ordering";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // output data of each row   
        sendRes($result, $productType, $uid);
    } else {
        echo "0 results";
    }
    $conn->close();
}



function sendRes($dbResult, $productType, $uid) {
    //Setup the product display table
    echo "<table class='table'><tr>";
    echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"name\")'>Name</th>";
    echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"brand\")'>Brand</th>";
    echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"colour\")'>Colour</th>";
    echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"price\")'>Price</th>";
    echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"storage\")'>Storage</th>";
    echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"year\")'>Year</th>"; 
    switch($productType) {
        case "camera":
            echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"lens\")'>Lens</th>";
            break;
        case "laptop":
            echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"screen_size\")'>Screen Size</th>";
            echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"ram\")'>RAM</th>";
            echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"cpu\")'>CPU</th>";
            break;    
        case "smartwatch":
            echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"screen_size\")'>Screen Size</th>";
            echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"cpu\")'>CPU</th>";
            break;  
        case "cellphone":
            echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"screen_size\")'>Screen Size</th>";
            echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"ram\")'>RAM</th>";
            echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"cpu\")'>CPU</th>";
            echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"camera\")'>Camera</th>";
            echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"network\")'>Network</th>";
            break;  
        case "tablet":
            echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"screen_size\")'>Screen Size</th>";
            echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"ram\")'>RAM</th>";
            echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"cpu\")'>CPU</th>";
            echo "<th onclick='getProduct(\"$uid\",\"$productType\",\"camera\")'>Camera</th>";
            break;
    }
    echo "<th>Click to Buy</tr>";
    while($row = $dbResult->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['brand']."</td>";
        echo "<td> ".$row['colour']."</td>";
        echo "<td>$".$row['price']."</td>";
        echo "<td>".$row['storage']."</td>";
        echo "<td>".$row['year']."</td>";    

        //Dynamic table view based on product Type
        switch($productType) {
            case "camera":
                echo "<td>".$row['lens']."</td>";
                break;
            case "laptop":
                echo "<td>".$row['screen_size']."</td>";
                echo "<td>".$row['ram']."</td>";
                echo "<td>".$row['cpu']."</td>";
                break;    
            case "smartwatch":
                echo "<td>".$row['screen_size']."</td>";
                echo "<td>".$row['cpu']."</td>";
                break;  
            case "cellphone":
                echo "<td>".$row['screen_size']."</td>";
                echo "<td>".$row['ram']."</td>";
                echo "<td>".$row['cpu']."</td>";
                echo "<td>".$row['camera']."</td>";
                echo "<td>".$row['network']."</td>";
                break;  
            case "tablet":
                echo "<td>".$row['screen_size']."</td>";
                echo "<td> ".$row['ram']."</td>";
                echo "<td>".$row['cpu']."</td>";
                echo "<td>".$row['camera']."</td>";
                break;
        }
        
        echo "<td><button class='btn btn-success' onclick='setProductVars(" .$row['PID']. ",".$uid .")' data-toggle='modal' data-target='#addToCartModal'/>Add To Cart</td>";
        echo "</tr>";
    }
    echo "</table>";
}

?> 