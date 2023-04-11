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
$name = $_POST['name'];
$email = $_POST['email'];
$birth_date = $_POST['year'];
$gender = $_POST['gender'];
$limbs = $_POST['kon'];
$superpowers = $_POST['super'];
$bio = $_POST['bio'];
$contract = $_POST['contr_check'];
$user = 'u52925';
$pass = '3596996';
$conn = new PDO('mysql:host=localhost;dbname=u52925', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
try {
   $stmt = $conn->prepare("INSERT INTO person(name, email, year , gender, limbs, biography , contract)
    VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiss", $name, $email, $birth_date, $gender, $limbs, $bio, $contract);
    $stmt->execute();
    $last_id = mysqli_insert_id($conn);
    foreach ($superpowers as $item) {
        $query = "INSERT INTO user_superpowers (person_id , ability_id ) VALUES ('$last_id', '$item')";
        mysqli_query($conn, $query);
    }
    $stmt->close();
    $conn->close();
}
	
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
// stmt - это "дескриптор состояния"
header('Location: ?save=1');
