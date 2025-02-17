<?php
$mysqli = new mysqli("localhost", "ct69809_host", "123", "ct69809_host");

// Проверка подключения
if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

// Проверка, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $consultation_date = $_POST['consultation_date'];

    // Подготовка и выполнение SQL-запроса
    $stmt = $mysqli->prepare("INSERT INTO consultations (consultation_date) VALUES (?)");
    $stmt->bind_param("s", $consultation_date);
    
    if ($stmt->execute()) {
        // Успешная запись, перенаправление обратно на страницу консультации
        header("Location: consultation.html?success=1");
        exit();
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    $stmt->close();
}

$mysqli->close();
?>