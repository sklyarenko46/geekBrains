<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<title>Личный сайт студента GeekBrains</title>
		<link rel="stylesheet" href="style.css"> 
	</head>
	<body>
		<div class="content">
			<?php
				include "menu.php";
			?>

			<h1>Личный сайт студента GeekBrains</h1>

			<div class="center">
			<img src="img/photo.png">
				<div class="box_text">
					<p>
						<b>Добрый день</b>. Меня зовут <i>Скляренко Наталия</i>. 
						Я уже два с половиной года работаю програмистом java(backend).
					</p>
					<p>
						Теперь заинтересовалась frontend-ом и стала студенткой факультета web-программирования на IT-портале 
						<a href="https://geekbrains.ru" target="_blank">GeekBrains</a>.
					</p>
					<p>
						На моем первом сайте вы можете сыграть в различные игры, ссылки в панели меню с верху. 
					</p>
				</div>
			</div>
		</div>
		<?php
				include "footer.php";
		?>
	</body>
</html>