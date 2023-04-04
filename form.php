<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> Задание 3) </title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="container" style= "background-color: #f8f8ff;">
			<div class="forma">
                <h2 id="Форма">Форма</h2>
                <form action="URL_отправки_данных" method="POST">
                    <label>
                        Имя:
                        <br />
                        <input name="name" placeholder="Введите имя" />
                    </label>
                    <br />
                    <label>
                        Почта:
							<br />
							<input name="email" placeholder="Введите вашу почту" type="email" />
						</label>
						<br />
						<label>
							Дата рождения:
							<br />
							<input name="date" placeholder="2022-09-01" type="date" />
						</label>
						<br />
						Пол:
						<br />
						<label>
							<input type="radio" checked="checked" name="sex" value="Значение1" />М
						</label>
						<label>
							<input type="radio" name="sex" value="Значение2" />Ж
						</label>
						<br />
						Кол-во конечностей:
						<br />
						<label>
							<input type="radio" checked="checked" name="legs" value="Значение1" />1
						</label>
						<label>
							<input type="radio" name="legs" value="Значение2" />2
						</label>
						<label>
							<input type="radio" name="legs" value="Значение3" />3
						</label>
						<label>
							<input type="radio" name="legs" value="Значение4" />4
						</label>
						<label>
							<input type="radio" name="legs" value="Значение5" />5
						</label>
						<br />
						<label>
                            Сверхспособности:
                            <br />
							<select name="powers[]" multiple="multiple">
								<option value="Значение1">Бессмертие</option>
								<option value="Значение2" selected="selected">Прохождение сквозь стены</option>
								<option value="Значение3" selected="selected">Левитация</option>
							</select>
						</label>
						<br />
						<label>
							Биография:
							<br />
							<textarea name="bio" placeholder="Придумайте свою биографию..."> </textarea>
						</label>
						<br />
						<br />
						<label>
							С контрактом ознакомлен(а)<input type="checkbox" name="check-1" />
						</label>
						<br />
                        <div class="button">
                            <input type="submit" value="Отправить" />
                        </div>
                    </form>
                </div>
            </div>
        </body>
        </html>
