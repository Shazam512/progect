<?php
$mysqli = new mysqli("localhost", "ct69809_host", "123", "ct69809_host");

if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);
    
    if ($stmt->execute()) {
        header("Location: consultation.html");
    } else {
        echo "Ошибка: " . $stmt->error;
    }
    $stmt->close();
}
$mysqli->close();
?>
