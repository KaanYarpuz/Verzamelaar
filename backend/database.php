<?php
$servername = "localhost";
$username = "contact";
$password = "9O4?3p0ky";
$database = "Database89530";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>