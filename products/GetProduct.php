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
$orderingType = $_REQUEST['ot'];
$ordering = $_REQUEST['o'];
$uid = $_REQUEST['uid'];
$req = $_REQUEST['req'];

if($req === 'all') {
    $query = "SELECT * FROM PRODUCT WHERE type='$productType' 
    order by $orderingType $ordering";
    $result = $conn->query($query); 
    sendRes($result, $productType, $uid);
} else if($req === 'filterPrice') {
    $price = $_REQUEST['price'];
    $query = "SELECT * FROM PRODUCT WHERE type='$productType' and price < '$price'
    order by $orderingType $ordering";
    $result = $conn->query($query);
    sendRes($result, $productType, $uid);
}else if($req === 'filterBrand') {
    $brand = $_REQUEST['brand'];
    $query = "SELECT * FROM PRODUCT WHERE type='$productType' AND brand = '$brand'
        ORDER BY $orderingType $ordering";
    $result = $conn->query($query);
    sendRes($result, $productType, $uid);
} else if($req === 'filterColour') {
    $colour = $_REQUEST['colour'];
    $query = "SELECT * FROM PRODUCT WHERE type='$productType' AND colour = '$colour'
        ORDER BY $orderingType $ordering";
    $result = $conn->query($query);
    sendRes($result, $productType, $uid);
    $conn->close();
} else if($req === 'filterStorage') {
    $storage = $_REQUEST['storage'];
    $query = "SELECT * FROM PRODUCT WHERE type='$productType' AND storage = '$storage'
        ORDER BY $orderingType $ordering";
    $result = $conn->query($query);       
    sendRes($result, $productType, $uid);   
} else if($req === 'filter') {
    $query = $_REQUEST['q'];    
    $result = $conn->query($query); 
    sendRes($result, $productType, $uid);   
}

$conn->close();
function sendRes($dbResult, $productType, $uid) {
    if($dbResult->num_rows > 0) {
        //Setup the PRODUCT display table
        echo "<table class='table'><tr>";
        echo "<th></th>";
        echo "<th>Product Info</th>";        
        echo "<th>Click to Buy</tr>";
        while($row = $dbResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td><img class='product-image' width='300px' height ='200px' src='./images/products/".$row['PID'].".jpg'></td>";
            echo "<td><b>Product Name: </b>".$row['name']."<br>";
            echo "<b>Brand: </b>".$row['brand']."<br>";
            echo "<b>Colour: </b>".$row['colour']."<br>";
            echo "<b>Price: $</b>".$row['price']."<br>";
            echo "<b>Storage Capacity: </b>".$row['storage']."<br>";
            echo "<b>Year Released: </b>".$row['year']."<br>";    

            //Dynamic table view based on PRODUCT Type
            switch($productType) {
                case "camera":
                    echo "<b>Lens Type: </b>".$row['lens']."<br>";
                    break;
                case "laptop":
                    echo "<b>Screen Size: </b>".$row['screen_size']."<br>";
                    echo "<b>RAM: </b>".$row['ram']."<br>";
                    echo "<b>CPU: </b>".$row['cpu']."<br>";
                    break;    
                case "smartwatch":
                    echo "<b>Screen Size</b>".$row['screen_size']."<br>";
                    echo "<b>CPU: </b>".$row['cpu']."<br>";
                    break;  
                case "cellphone":
                    echo "<b>Screen Size: </b>".$row['screen_size']."<br>";
                    echo "<b>RAM: </b>".$row['ram']."<br>";
                    echo "<b>CPU: </b>".$row['cpu']."<br>";
                    echo "<b>Camera: </b>".$row['camera']."<br>";
                    echo "<b>Network: </b>".$row['network']."<br>";
                    break;  
                case "tablet":
                    echo "<b>Screen Size: </b>".$row['screen_size']."<br>";
                    echo "<b>RAM: </b>".$row['ram']."<br>";
                    echo "<b>CPU: </b>".$row['cpu']."<br>";
                    echo "<b>Camera: </b>".$row['camera']."<br>";
                    break;
            }
            echo "</td>";
            echo "<td><button class='btn btn-success' onclick='setProductVars(" .$row['PID']. ",".$uid .")' data-toggle='modal' data-target='#addToCartModal'/>Add To Cart</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<b>0 Results";
    }
}

?> 