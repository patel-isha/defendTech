<?php
//Database connection parameters
$servername = "localhost";
$username = "root";
$password = "Current@2020";
$database = "defend_tech";

//Create a connection
$conn = new mysqli($servername, $username, $password, $database);

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
