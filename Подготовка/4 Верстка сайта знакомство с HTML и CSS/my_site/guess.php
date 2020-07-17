<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Личный сайт студента GeekBrains</title>
		<link rel="stylesheet" href="style.css"> 
		<script type="text/javascript">
			
		
			var lowerBoundOfRange;
			var upperBoundOfRange;
			var playersCount;
			var players;
			var correctAnswer;
			var currentPlayer;
			var currentPlayerResponse;

			function hideById(id)
			{
				hideElement(getElement(id));
			}
			function hideElement(element)
			{
				element.style.display = "none";
			}

			function setElementTextById(id, text)
			{
				setElementText(getElement(id), text);
			}
			function setElementText(element, text)
			{
				element.style.display = "block";
				element.innerHTML = text;
			}
			function showById(elementId)
			{
				showElement(getElement(elementId));
			}
			function showElement(element)
			{
				element.style.display = "block";
			}

			function readInputData(elementId, minValue)
			{
				let inputValue = parseInt(getElement(elementId).value);
				let error = getElement(elementId + "Error");
				if(isNaN(inputValue) || inputValue < minValue)
					setElementText(
						error,
						"Не корректное значение поля!!! Значение должно быть числом!!!" + 
						(isNaN(minValue) ? "" : " И быть не менее чем  "+ minValue + ".") +
						" Игра будет работать некорректно если не соблюдать это правило."
					);
                else
                	hideElement(error);
				return inputValue;
			}
			function checkInputData(elementIds)
			{
				for(let elementId of elementIds)
					if(getElement(elementId).style.display != "none")
						return false;
				
				return true;
			}
			function getElement(elementId)
			{
				return document.getElementById(elementId);
			}
			function cleanData()
			{
				lowerBoundOfRange = NaN;
				upperBoundOfRange = NaN;
				playersCount = NaN;
				players = NaN;
				correctAnswer = NaN;
				currentPlayer = NaN;
				currentPlayerResponse = NaN;
				hideById("condition");
				hideById("playInfo");
				hideById("playerAnswer");
				hideById("playButton");
				hideById("result");
			}
			function hideData()
			{
				hideById("condition");
				hideById("playerAnswer");
				hideById("playButton");
				hideById("playInfo");
			}
			function nextPlayer() 
			{
				let next;
				if(currentPlayer == null)
					next = players[0];
				else 
				{
					let currentIndex = players.indexOf(currentPlayer);
					if(currentIndex == -1 || (currentIndex + 1) == players.length)
						next = players[0];
					else
						next = players[currentIndex + 1];
				}
				setElementTextById("condition", next + ". Угадайте число от " + lowerBoundOfRange + " до " + upperBoundOfRange + ".");
				getElement("playerAnswer").value = "";
				return next;
			}
			function incorrectlyMessage(moreOrLess) 
			{
				return "Загаданное число " + moreOrLess + " чем " + currentPlayerResponse + 
						(players.length > 1 ? ", очередь следующего игрока." : ".");
			}
			function setup()
			{
				cleanData();
				lowerBoundOfRange = readInputData("lowerBoundOfRange", NaN);
				upperBoundOfRange = readInputData("upperBoundOfRange", lowerBoundOfRange + 1);
				playersCount = readInputData("playersCount", 1);
				let cannotPlay = getElement("cannotPlay");
				if(checkInputData(["lowerBoundOfRangeError", "upperBoundOfRangeError", "playersCountError"]))
				{
					hideElement(cannotPlay);
					showById("playerAnswer");
					showById("playButton");
					
					players = [];
					for(var i = 1; i <= playersCount; i++)
						players.push("Игрок №" + i)

					setElementTextById(
						"playInfo",
						(players.length > 1 ? "Игроки: " + players + " поочередно будут" : players[0] + " будет") +
						" пытаться угадать число загаданное случайным образом в диапозоне от " +
						 lowerBoundOfRange + " до " + upperBoundOfRange + " включительно. " +
						 "Для досточного завершения игры введите любой не числовой символ(например букву)."
					);

					correctAnswer = Math.trunc(lowerBoundOfRange + Math.random() * (upperBoundOfRange - lowerBoundOfRange));
					currentPlayer = nextPlayer();
					currentPlayerResponse;
					
				}
				else
				{
					setElementText(cannotPlay, "НЕВОЗМОЖНО НАЧАТЬ ИГРУ! ВВЕДИТЕ КОРРЕКТНЫЕ УСТАНОВКИ!");
				}
			
			}
			function play()
			{
				currentPlayerResponse = getElement("playerAnswer").value;
				
				if(isNaN(currentPlayerResponse))
				{
					setElementTextById("result", "Игрок \'" + currentPlayer + "\' завершил игру! Было загаданно число: " + correctAnswer + ".");
					hideData();
					return;
				}
				if(currentPlayerResponse < lowerBoundOfRange || currentPlayerResponse > upperBoundOfRange)
				{
					setElementTextById("result", "\'" + currentPlayer +"\' введите пожалуйста число не менее " + lowerBoundOfRange + " и не более " + upperBoundOfRange + "!");
					return;
				}

				if(currentPlayerResponse > correctAnswer)
					setElementTextById("result", incorrectlyMessage("меньше"));
				else if(currentPlayerResponse < correctAnswer)
					setElementTextById("result", incorrectlyMessage("больше"));
				else
				{
					setElementTextById("result", "Верно " + currentPlayerResponse +", поздравляем вы угадали! \nВыиграл игрок: \'" + currentPlayer + "\'!");
					hideData();
					return;
				}	

				currentPlayer = nextPlayer();
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
						<p>Вас приветствует игра угадай число. Для начала игры выбирите диапозон угадываемых чисел и кол-во игроков.</p>
				
						<p>Введите минимально возможное загаданное число:</p>
						<p style="color: red; size: 10px" id="lowerBoundOfRangeError"></p>
						<input type="int" id="lowerBoundOfRange">
			
						<p>Введите максимально возможное загаданное число:</p>
						<p style="color: red; size: 10px" id="upperBoundOfRangeError"></p>
						<input type="int" id="upperBoundOfRange">
	
						<p>Введите кол-во игроков:</p>
						<p style="color: red; size: 10px" id="playersCountError"></p>
						<input type="int" id="playersCount">

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
					   		Начать
						</button>
						
						<p style="color: red;" id="cannotPlay"></p>
						<p id="playInfo"></p>
						<p id="condition"></p>
						<input style="display: none" type="int" id="playerAnswer">
						<button id="playButton" style="background-color: #4CAF50;
									  border: none;
									  color: white;
									  padding: 15px 32px;
									  text-align: center;
									  text-decoration: none;
									  display: none;
									  font-size: 16px;
									  margin: 4px 2px;
									  cursor: pointer;"
						  		onclick="play();">
					   		Ответить
						</button>
						<p style="color: green" id="result"></p>
		        </div>
		    </div>
		</div>
		</div>
		<?php
			include "footer.php";
		?>
	</body>
</html>