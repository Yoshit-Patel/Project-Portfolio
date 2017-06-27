<?php
$servername = "localhost";
$username = "yoshit";
$password = "patel";
$dbname = "ai";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("MySQL Connection Failed: " . $conn->connect_error);
}

//$conn->close();
?>
