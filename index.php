<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>Cверхспособности</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="forma">
    <header>
        <div id="название">
            <h2>Cверхспособности</h2>
        </div>
    </header>
        <form action="form.php" method="POST">
            <label>
                <div class="names">Введите имя:</div>
                <input name="name" placeholder="Введите имя" />
            </label>
            <label>
				<div class="names">Адрес электронной почты:</div>
                <input name="email" type="email" placeholder="Введите email" /><br>
            </label>
            <label for="year" class="names">Год рождения</label>
            <select name="year">
      <?php 
    for ($i =  1960; $i <= 2023; $i++) {
      printf('<option value="%d">%d</option>', $i, $i);
    }
    ?>
  </select>
            <br>
            <div class="names">Выберите пол:</div>
            <label><input type="radio" checked="checked" name="gender" value="female" />
                Женский</label>
            <label><input type="radio" name="gender" value="male" />
                Мужской</label>
            <br>
            <div class="names">Количество конечностей:</div>
            <label><input type="radio" checked="checked" name="kon" value="1" />
                1</label>
            <label><input type="radio" name="kon" value="2" />
                2</label>
            <label><input type="radio" name="kon" value="3" />
                3</label>
            <label><input type="radio" name="kon" value="4" />
                4</label>
            <label>
                <br>
                <div class="names">Сверхспособности:</div>
                <select name="super[]" multiple="multiple">
                    <option value="deathless">Бессмертие</option>
                    <option value="walls" selected="selected">Прохождение сквозь стены</option>
                    <option value="levitation">Левитация</option>
                    <option value="timestop">Остановка времени</option>
                    <option value="tp">Телепортация</option>
                </select>
                <br>
				<div class="names">
                Биография: </div>
                <textarea name="bio" placeholder="Напишите о себе"></textarea><br>
                <label><input type="checkbox" checked="checked" name="contr_check" />
                    с контрактом ознакомлен(а)</label>
                <br>
                <input type="submit" class="submit" value="Отправить" />

        </form>
    </div>
	</div>

</body>

</html>
