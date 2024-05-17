<?php
session_start();
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_main";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .d-flex {
            margin-left: auto;
        }
        .dropbtn {
            width: 100px;
margin-left: 10px;
  padding: 7px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  /* border-radius: 5px; */
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
.main {
    margin-top: 30px;
}
.editBtn {
    margin-left: auto 0;
}
.card {
    display: flex;
}
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid container">
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <img src="https://ikkm.uz/wp-content/uploads/2019/06/ofd2.png"width="40px">
                <a class="navbar-brand" href="#">WS Kassa</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="addWorkspace.php">Cоздать рабочее пространство</a>
                </li>
                <!-- <li class="nav-item">
                <a class="nav-link" href="edit.php">Изменить рабочее пространство</a>
                </li> -->
                <!-- <li class="nav-item">
                <a class="nav-link" href="#">История чеков</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="addcheck.php">Добавить чек</a>
                </li> -->
            </ul>
            <form class="d-flex">
                <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <a class="btn btn-outline-success" type="submit">Поиск</a> -->
                <div class="dropdown">
                    <a class="dropbtn btn"> <?php echo $_SESSION['username'];?> &#9660;</a>
                    <div class="dropdown-content">
                        <a href="index.php">Log Out</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </nav>
        <div class="main">
            <div class="container-fluid container flex-row">
    <?php

    $sql = "SELECT title, description, created_at FROM workspaces WHERE username = '$username'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Вывод данных каждой строки результата
        while($row = $result->fetch_assoc()) {
            ?>
    

                    <div class="card d-flex flex-row" >
                        <div class="card-body">
                            <p name="id" id="id"><?php echo $row["id"]?></p>
                            <h5 class="card-title"><?php echo $row["title"] . "<br>";?></h5>
                            <p class="card-text"><?php echo $row["description"] . "<br>";?></p>
                            <span><?php echo $row['created_at'] . "<br>";?></span>
                            
                            <div>
                                <button type="button" class="btn btn-outline-success" id="editBtn">Edit</button>
                                <button type="submit" class="btn btn-outline-danger" type="" name="delete_btn">Delete</button>
                            </div>

                        </div>
                    </div>
             <?php
            // echo "Название: " . $row["title"]. " - Описание: " . $row["description"]. " - Время создания: " . $row["created_at"]. "<br>";
        }
    } else {
        echo "Нет данных для отображения";
    }

// Получение идентификатора записи для удаления
$id = $_POST['id'];

// SQL запрос для удаления записи
$sql = "DELETE FROM workspaces WHERE username = '$username' AND id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Запись успешно удалена";
} else {
    echo "Ошибка при удалении записи: " . $conn->error;
}
    ?>
                    </div>
            </div>
    <!-- <div class="main">
        <div class="container-fluid container">
            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <div class="card-body">
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
        </div>
    </div> -->
</body>
</html>