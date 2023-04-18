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
 
// Получение выбранной таблицы
$table = $_POST["table"];
 
// Получение и вывод данных из выбранной таблицы
try {
    $stmt = $db->prepare("SELECT * FROM {$table}");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
    echo "<h2>Данные из таблицы {$table}:</h2>";
    echo "<pre>";
    print_r($results);
    echo "</pre>";
} catch (PDOException $e) {
    print('Error : ' . $e->getMessage());
}
