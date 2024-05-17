<?php
session_start();

require_once('db.php');

// Функция хеширования пароля
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Регистрация
// if (isset($_POST['register'])) {
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     // Проверка, существует ли пользователь с таким именем
//     $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
//     $stmt->bindParam(':username', $username);
//     $stmt->execute();

//     if ($stmt->rowCount() > 0) {
//         echo "Пользователь с таким именем уже существует.";
//     } else {
//         // Хеширование пароля
//         $hashedPassword = hashPassword($password);

//         // Вставка данных пользователя в базу данных
//         $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
//         $stmt->bindParam(':username', $username);
//         $stmt->bindParam(':password', $hashedPassword);

//         if ($stmt->execute()) {
//             echo "Регистрация успешна!";
//         } else {
//             echo "Ошибка при регистрации.";
//         }
//     }
// }

// Авторизация
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Проверка существования пользователя в базе данных
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Проверка пароля
        if (password_verify($password, $user['password'])) {
            // Успешная авторизация
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo "Авторизация успешна!";
            header("Location: main.php"); // Перенаправление на страницу приветствия
        } else {
            echo "Неправильный пароль.";
        }
    } else {
        echo "Пользователь не найден.";
    }
}


?>
