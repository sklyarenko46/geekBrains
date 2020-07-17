<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Личный сайт студента GeekBrains</title>
		<link rel="stylesheet" href="style.css"> 
		<script type="text/javascript">
		
			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			function hideElement(element)
			{
				element.style.display = "none";
			}
			function setElementText(element, text)
			{
				element.style.display = "block";
				element.innerHTML = text;
			}
			function getElement(elementId)
			{
				return document.getElementById(elementId);
			}
			function readInputData(elementId)
			{
				let inputValue = parseInt(getElement(elementId).value);
				let error = getElement(elementId + "Error");
				if(isNaN(inputValue))
					setElementText(
						error,
						"Не корректное значение поля!!! Значение должно быть числом!!!" + 
						" Программа будет работать некорректно если не соблюдать это правило."
					);
                else
                	hideElement(error);
				return inputValue;
			}
			function generatePassword(length)
			{
				var text = "";
			  	for (var i = 0; i < length; i++)
    				text += possible.charAt(Math.floor(Math.random() * possible.length));
    			return "Ваш пароль: " + text;
			}

			function setup()
			{
				setElementText(
					getElement("result"), 
					generatePassword(readInputData("passwordLength"))
				);
			}
		
		</script>
	</head>
	<body>
		<div class="content">
			<?php
				include "menu.php";
			?>

		<div class="contentWrap">
		    <div class="content">
		        <div class="center">

					<h1>Угадайка</h1>

					<div class="box">
						<p>Вас приветствует генератор паролей. Пароль будет сгенерирован из случайный латинских букв и цыфр указанной длины.</p>
				
						<p>Введите длину желаемого пароля:</p>
						<p style="color: red; size: 10px" id="passwordLengthError"></p>
						<input type="int" id="passwordLength">
			
						<br>
						<button style="background-color: #4CAF50;
									  border: none;
									  color: white;
									  padding: 15px 32px;
									  text-align: center;
									  text-decoration: none;
									  display: inline-block;
									  font-size: 16px;
									  margin: 4px 2px;
									  cursor: pointer;"
						  		onclick="setup();">
					   		Сгенерировать
						</button>
						<p id="result"></p>
		        </div>
		    </div>
		</div>
		</div>
		<?php
			include "footer.php";
		?>
	</body>
</html>