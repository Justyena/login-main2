<?php
session_start();
// // Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_main";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>