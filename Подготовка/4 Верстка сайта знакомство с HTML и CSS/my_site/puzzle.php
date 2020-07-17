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
		<div class="contentWrap">
		    <div class="content">
		        <div class="center">
					<h1>Игра в загадки</h1>
					<div class="box">
						<form class="GET">

							<p>
								Вас приветствует игра в загадки. 
								В процессе игры вам нужно будет отгадать 3 загадки. 
								У вас будет только одна попытка правельно ответить на каждый вопрос.
							</p>

							<p>Загадка №1. Зимой и летом одним цветом?</p>
							<input type="text" name="userAnswer1">

							<p>Загадка №2. Сидит дед в сто шуб одет?</p>
							<input type="text" name="userAnswer2">

							<p>Загадка №3. Лучший друг кракадила гены?</p>
							<input type="text" name="userAnswer3">

							<br><br>
							<input type="submit" value="Ответить" name="">
						</form>

						<?php 
							if(isset($_GET["userAnswer1"]) && isset($_GET["userAnswer2"]) && isset($_GET["userAnswer3"]))
							{
								$score = 0;

								$answer =$_GET["userAnswer1"];
								$answers = ["елка", "ёлка", "ель", "еловые", "хвойные"];
								foreach ($answers as &$value) 
									if($value == $answer)
									{
										$score++;
										break;
									}

								$answer = $_GET["userAnswer2"];
								$answers = ["лук", "капуста", "луковица", "луковка", "качан"];
								foreach ($answers as &$value) 
									if($value == $answer)
									{
										$score++;
										break;
									}

								$answer = $_GET["userAnswer3"];
								$answers = ["чебуратор", "чебурашка", "чебурашечка", "чебуразойд"];
								foreach ($answers as &$value) 
									if($value == $answer)
									{
										$score++;
										break;
									}
							
								echo "Вы угадали " . $score . " загад(-ку/-ок/-ки).";
							}
						?>

					</div>
		        </div>
		    </div>
		</div>
	</div>
	<?php
		include "footer.php";
	?>
</body>
</html>