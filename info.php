<html>
	<head>
		<title><? print($_GET['t']); ?></title>
		<script type = "text/javascript">
			function startTime() {
				var tm = new Date(); var h = tm.getHours(); var m = tm.getMinutes(); var s = tm.getSeconds(); m = checkTime(m); s = checkTime(s);
				document.getElementById('txt').innerHTML = h + ":" + m + ":" + s; t = setTimeout('startTime()', 500);
			}
			function checkTime(i) {
				if(i < 10) { i = "0" + i; } return i;
			}
		</script>
	</head>
	<body background = "imgs/1.jpg" style="background-attachment: fixed" onload="startTime()">
<?		$tm1 = date("w"); $tm2 = date("j "); $tm3 = date("n");
		if($tm1 = 0) {$tm1 = "Воскресенье, ";}elseif($tm1 = 1){$tm1 = "Понедельник, ";}elseif($tm1 = 2){$tm1 = "Вторник, ";}elseif($tm1 = 3){
			$tm1 = "Среда, ";}elseif($tm1 = 4){$tm1 = "Четверг, ";}elseif($tm1 = 5){$tm1 = "Пятница, ";}elseif($tm1 = 6){$tm1 = "Суббота, ";}
		if($tm3 = 1) {$tm3 = "января";}elseif($tm3 = 2){$tm3 = "февраля";}elseif($tm3 = 3){$tm3 = "марта";}elseif($tm3 = 4){$tm3 = "апреля";}
		elseif($tm3 = 5) {$tm3 = "мая";}elseif($tm3 = 6){$tm3 = "июня";}elseif($tm3 = 7){$tm3 = "июля";}elseif($tm3 = 8){$tm3 = "августа";}
		elseif($tm3 = 9){$tm3 = "сентября";}elseif($tm3 = 10){$tm3 = "октября";}elseif($tm3 = 11){$tm3 = "ноября";}elseif($tm3 = 12){$tm3 = "декабря";}
?>		<div align = "right"><b><? print $tm1; print $tm2; print $tm3; ?></b></div><b><p align = "right" id="txt"></p></b>
		<h1><? print $_GET['t'] ?></h1>
		<style>
			* { -webkit-box-sizing: border-box; box-sizing: border-box; margin: 0; padding: 1; border: none; outline: none; }
			a { color: #176093; -moz-outline-style: none; outline: none; text-decoration: none; }
			.b-link_button { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; background-color: #eeeef1;
				border: 1px solid #e6e6ea; border: 0; color: #123; cursor: pointer; display: block; font-size: 15px;
				font-weight: bold; line-height: 1; margin-bottom: 10px; padding: 8px 10px; text-align: center; }
			.b-link_button.dark { -webkit-transition: background-color 0.25s ease, border-color 0.25s ease;
				transition: background-color 0.25s ease, border-color 0.25s ease; background-color: #456; border-color: #3e4d5d; color: #fff; }
			.watch-online { max-width: 230px; margin: 0 auto; }
		</style>
		<table>
			<tr><td width = "200"><span class = "logo"><img src = "<? print($_GET['c']); ?>" height = "250"></span><p></td>
			<td><table cellpadding = "4"><tr><td><b>Информация</b></td></tr></table><hr color = "green" width = "100" size = "0.01">
			<table cellpadding = "4">
				<tr><td>Тип: <? print $_GET['tp'] ?></td></tr><tr><td>Эпизоды: <? print $_GET['n'] ?></td></tr>
				<tr><td>Жанр: <? print $_GET['ge'] ?></td></tr><tr><td>Студия: <? print $_GET['st'] ?></td></tr></td>
			</table><br><br><br><br><br><br><table>
				<tr><td><a class = "b-link_button dark watch-online" href = "<? print($_GET['l']); ?>">Смотреть онлайн</a></td></tr>
			</table></table><br><br>
		<h3>Описание:</h3><br><? print($_GET['te']); ?>
	</body>
</html>