<?php
header('Content-Type: text/html; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
  if (!empty($_GET['save'])) {
    // Если есть параметр save, то выводим сообщение пользователю.
    print('Спасибо, результаты сохранены.');
  }
  include('index.php');
  exit();
}
$errors = FALSE;
if (empty($_POST['name'])) {
  print('Заполните имя.<br/>');
  $errors = TRUE;
}

if (empty($_POST['email']) or !(strpos($_POST['email'], '@'))) {
  print('Введите e-mail.<br/>');
  $errors = TRUE;
}

if (empty($_POST['year'])) {
  print('Выберите год рождения.<br/>');
  $errors = TRUE;
}

if (empty($_POST['gender'])) {
  print('Укажите ваш пол.<br/>');
  $errors = TRUE;
}


if (empty($_POST['kon'])){
    print ('Выберите количество конечностей.<br>');
    $errors = true;

}

if (empty($_POST['super'])){
    print ('Выберите одну или несколько сверхспособностей.<br>');
    $errors = true;

}
else {
  $super = serialize($_POST['super']);
}

if (empty($_POST['bio'])){
    print ('Расскажите о себе.<br>');
    $errors = true;
}

if (empty($_POST['contr_check'])){
    print ('Вы не можете отправить форму, не ознакомившись с контрактом.<br>');
    $errors = true;
}

if ($errors) {
  exit();
}
$user = 'u52925';
$pass = '3596996';
$db = new PDO('mysql:host=localhost;dbname=u52925', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
try {
  $stmt = $db->prepare("INSERT INTO person SET name = ?, email = ?, year = ?, gender = ?, limbs = ?, biography = ?, contract = ?");
  $stmt -> execute(array(
		$_POST['name'],
        $_POST['email'],
        $_POST['year'],
        $_POST['gender'],
        $_POST['kon'],
        $_POST['bio'],
	$_POST['contr_check']
	));
	
 foreach ($_POST['superpowers'] as $value) {
        $stmt = $db->prepare("INSERT INTO superpower SET name = ?, superpower = ?");
        $stmt -> execute(array(
            $_POST['name'], 
            $value,
        ));
    }
    unset($value);
}
catch(PDOException $e){
print('Error: ' . $e->getMessage());
exit();
}
// stmt - это "дескриптор состояния"
header('Location: ?save=1');
