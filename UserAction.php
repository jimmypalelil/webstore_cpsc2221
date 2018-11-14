<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "9830100Avenue";
$dbname = "webstore";


if($_REQUEST['req'] === 'logout') {
    session_destroy();
} else if($_REQUEST['req'] === 'register') {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $firstName = $_REQUEST['firstName'];
    $lastName = $_REQUEST['lastName'];
    $email = $_REQUEST['email'];
    $passowrd = $_REQUEST['password'];
    $address = $_REQUEST['address'];
    $query = "INSERT into USERS(firstName, lastName, email, password, address) values ('$firstName', '$lastName', '$email', '$passowrd', '$address')";    
    if($conn->query($query) === true) {
        echo "User Registered Succesfully\nYou can Login now";
    } else {
        echo "Registration Failed. Try Again!!!";
    }
} else {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];

    $query = "SELECT * FROM USERS WHERE email='$email'";
        
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // output data of each row   
        $row = $result->fetch_assoc();
        if($row['password'] == $password) {            
            $_SESSION['email'] = $email;
            $_SESSION['UID'] = $row['UID'];
            echo "1"; //success
        } else {
            echo 0; //Login failed
        }
    } else {
        echo 0; //Login failed
    }

    $conn->close();
} 