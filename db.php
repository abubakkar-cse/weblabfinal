<?php
$host = "localhost";
$user = "root";
$parsword = "";
$db_name = "newspaper";
$conn = new mysqli($host, $user, $parsword, $db_name);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

?>