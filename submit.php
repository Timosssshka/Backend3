<?php
 
// Настройки подключения к базе данных
$servername = "localhost";
$username = "u52925";
$password = "3596996";
$dbname = "u52925";
 
// Создание подключения
try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
 
// Получение данных из формы
$name = $_POST["name"];
$email = $_POST["email"];
$birth_year = $_POST["birth_year"];
$gender = $_POST["gender"];
$limbs = $_POST["limbs"];
$abilities = $_POST["abilities"];
$bio = $_POST["bio"];
$contract = $_POST["contract"] == "accepted";
 
// Валидация данных
$errors = [];
 
if (!preg_match("/^[a-zA-Zа-яА-ЯёЁ\s]+$/u", $name)) {
    $errors[] = "Имя содержит недопустимые символы.";
}
 
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Неверный формат e-mail.";
}
 
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    die();
}
 
// Сохранение данных в базе данных
try {
    $stmt = $db->prepare("INSERT INTO users (name, email, birth_year, gender, limbs, bio, contract) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $birth_year, $gender, $limbs, $bio, $contract]);
 
    $user_id = $db->lastInsertId();
 
    // Создание JSON-массива со списком способностей пользователя
    $abilities_json = json_encode($abilities, JSON_UNESCAPED_UNICODE);
 
    // Сохранение списка способностей пользователя в таблице user_superpowers
    $stmt = $db->prepare("INSERT INTO user_abilities  (user_id, superpowers) VALUES (?, ?)");
    $stmt->execute([$user_id, $abilities_json]);
 
    echo "Данные успешно сохранены.";
 
} catch (PDOException $e) {
    print('Error : ' . $e->getMessage());
    exit();
}
