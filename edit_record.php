<?php
session_start();
require_once('db.php');

// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "login_main";

$conn = new mysqli($servername, $username, $password, $dbname);

// Получение данных из формы
$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];

// Запрос на обновление записи в базе данных
$sql = "UPDATE workspaces SET title='$title'AND description='$description'AND created_at=NOW() WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "Запись успешно обновлена";
} else {
    echo "Ошибка при обновлении записи: " . $conn->error;
}

$conn->close();
?>