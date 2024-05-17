<?php
require_once('db.php');

$id = $_GET['id']; // Получаем ID из запроса

// Подключаемся к базе данных
$connection = mysqli_connect('localhost', 'root', 'root', 'login_main');

// Обновляем данные в базе данных
$sql = "UPDATE workspaces SET title = 'title', description = 'description', created_at = NOW() WHERE id = $id";

if ($connection->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}


// Закрываем соединение с базой данных
mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .container {
            width: 300px;
            margin-top: 300px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="add.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Enter title</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title" name="title" id="title">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <input type="text" class="form-control"  placeholder="Description" name="description" id="description">
        </div>
        <button type="submit" class="btn btn-primary" name="submit" id="submit">Create </button>
        </form>
    </div>

</body>
</html>
