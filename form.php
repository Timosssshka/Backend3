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
    $stmt = $conn->prepare("INSERT INTO person(name, email, year, gender, limbs, biography) VALUES (:name, :email, :year, :gender, :limbs, :biography)");
    $rez=$stmt->execute(['name'=>"$name",'email'=>"$email", 'year'=>"$year", 'gender'=>"$gender", 'limbs'=>"$kol", 'biography'=>"$bio"]);
    $id_form=$conn->lastInsertId();
    $stmt2=$conn->prepare("INSERT INTO superpower(immortality, passing_through_walls,levitation) VALUES (:immortality, :passing_through_walls, :levitation)");
    $rez2=$stmt2->execute(['immortality'=>"$immortality", 'passing_through_walls'=>"$passing_through_walls", 'levitation'=>"$levitation"]);
    $id_super=$conn->lastInsertId();
    $stmt3=$conn->prepare("INSERT INTO form_superpower(id_DATA_FORM, id_DATA_superpower) VALUES (:id_DATA_FORM, :id_DATA_superpower)");
    $rez3=$stmt3->execute(['id_DATA_FORM'=>"$id_form", 'id_DATA_superpower'=>"$id_super"]);
// // Подготовленный запрос. Не именованные метки.

// try {
//   $stmt = $db->prepare("INSERT INTO person SET name = ?, email = ?, year = ?, gender = ?, limbs = ?, biography = ?");
//   $stmt -> execute(array(
// 		$_POST['name'],
//         $_POST['email'],
//         $_POST['year'],
//         $_POST['gender'],
//         $_POST['kon'],
//         $_POST['bio'],
// 	));
	
//  foreach ($_POST['superpowers'] as $value) {
//         $stmt = $db->prepare("INSERT INTO superpower SET name = ?, superpower = ?");
//         $stmt -> execute(array(
//             $_POST['name'], 
//             $value,
//         ));
//     }
//     unset($value);
// }

catch(PDOException $e){
  print('Error: ' . $e->getMessage());
  exit();
}
header('Location: ?save=1');
