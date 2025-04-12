<?php
session_start();
$host = "localhost";
$user = "root";
$pass = '';
$db   = "mjcodersnet_pdf";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function sanitize($data) {
    global $conn;
    return $conn->real_escape_string(htmlspecialchars(trim($data)));
}
?>