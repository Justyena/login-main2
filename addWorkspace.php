<?php
session_start();
require_once('db.php');

if (isset($_POST['submit'])) {
        $username = $_SESSION['username'];
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $created_at = date("Y-m-d H:i:s");

        if (empty($title) || empty($description)) {
            echo "Заполните все поля";
        } else {
            $stmt = $db->prepare("SELECT * FROM workspaces WHERE title = :title");
            $stmt->bindParam(':title', $title);
            $stmt->execute();
        
            if ($stmt->rowCount() > 0) {
                echo "Рабочее место с таким именем уже существует.";
            } else {
        
                // Вставка данных пользователя в базу данных
                $stmt = $db->prepare("INSERT INTO workspaces (title, description, created_at, username) VALUES (:title, :description, :created_at, :username )");
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':created_at', $created_at);
                $stmt->bindParam(':username', $username);
        
                if ($stmt->execute()) {
                    header("Location: main.php");
                    // echo "Регистрация успешна!";
                } else {
                    echo "Ошибка при регистрации.";
                }
            }
        }
    }
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
        <form action="addWorkspace.php" method="post">
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