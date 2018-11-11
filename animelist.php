<?	function connect() {
		$_POST['db'] = mysqli_connect("127.0.0.1", "root") or die("Не могу подключиться: " . mysqli_error($_POST['db']));
		mysqli_select_db($_POST['db'], "kurs") or die("Не могу выбрать базу данных: " . mysqli_error($_POST['db']));
	} $db = $_POST['db']; ?>
<html>
	<head>
		<title>Список аниме</title>
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
	<body background = "imgs/1.jpg" style = "background-attachment: fixed" onload = "startTime()">
		<form action = "animelist.php" method = "post">
			<style>
			.b-link_button { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; background-color: #eeeef1;
				border: 1px solid #e6e6ea; border: 0; color: #123; cursor: pointer; display: block; font-size: 15px;
				font-weight: bold; line-height: 1; margin-bottom: 10px; padding: 8px 10px; text-align: center; }
			</style>
<?			connect();
			if(isset($_POST['sign'])) {
				$sql = "SELECT * FROM(list LEFT JOIN genres ON list.GenreID = genres.GenreID) LEFT JOIN studios ON list.StudioID = studios.StudioID"; cont($sql);
			} elseif(isset($_POST['signup'])) { signup($_REQUEST['logn'], $_REQUEST['passwrd']);
			} elseif(isset($_POST['signin'])) { signin($_REQUEST['login'], $_REQUEST['password']);
			} elseif(isset($_POST['six'])) {
				$qu="UPDATE list SET Title='".$_POST['fir']."',SeriesNumber='".$_POST['sec']."',Type='".$_POST['thi']."',GenreID='".$_POST['sev']."',StudioID='".$_POST['eig']."'";
				$db = $_POST['db']; mysqli_query($db, $qu);
				$sql = "SELECT * FROM(list LEFT JOIN genres ON list.GenreID = genres.GenreID)LEFT JOIN studios ON list.StudioID = studios.StudioID"; cont($sql);
			} elseif(isset($_POST['edit'])) {
				$_POST['signin'] = "yes"; $sql = "SELECT * FROM users"; $r = mysqli_query($db, $sql);
?>				<table border = "1" cellpadding = "3">
					<tr><td><b>Логин</b></td><td><b>Пароль</b></td></tr>
<?					while($row = mysqli_fetch_array($r)) { printf("<tr><td>%s</td><td>%s</td></tr>\n", $row["Login"], $row["Password"]); }
?>				</table>
				<br><b>Логин: </b><input type = "text" name = "log" autofocus><br><b>Пароль: </b><input type = "text" name = "pass">
				<br><br><input type = "submit" name = "delet" value = "Удалить"><input type = "submit" name = "upd" value = "Изменить пароль">
<?			} elseif(isset($_POST['delet'])) {
				$sql = "DELETE FROM users WHERE Login = '".$_POST['log']."' AND Password = '".$_POST['pass']."'";
				if(!mysqli_query($db, $sql)) { print("<h2 style = \"color:#FF0000;\">Нельзя удалять админа!</h2>"); }
				$sql1 = "SELECT * FROM users"; $r = mysqli_query($db, $sql1);
?>				<table border = "1" cellpadding = "3">
					<tr><td><b>Логин</b></td><td><b>Пароль</b></td></tr>
<?					while($row = mysqli_fetch_array($r)) { printf("<tr><td>%s</td><td>%s</td></tr>\n", $row["Login"], $row["Password"]); }
?>				</table>
				<br><input type = "submit" name = "bac" value = "Вернуться" autofocus>
<?			} elseif(isset($_POST['upd'])) {
				$sql = "UPDATE users SET Password = '".$_POST['pass']."' WHERE Login = '".$_POST['log']."'"; mysqli_query($db, $sql);
				$sql1 = "SELECT * FROM `users`"; $r = mysqli_query($db, $sql1);
?>				<table border = "1" cellpadding = "3">
					<tr><td><b>Логин</b></td><td><b>Пароль</b></td></tr>
<?					while($row = mysqli_fetch_array($r)) { printf("<tr><td>%s</td><td>%s</td></tr>\n", $row["Login"], $row["Password"]); }
?>				</table>
				<br><input type = "submit" name = "bac" value = "Вернуться" autofocus>
<?			} elseif(isset($_POST['bac'])) { $_POST['signup'] = ""; signup($_REQUEST['logn'], $_REQUEST['passwrd']);
			} elseif(isset($_POST['stw'])) {
?>				<br><br><br><br><br><br><br><br><br><br><br><br><br>
				<table align = "center">
					<td><b>Логин: </b><td><input type = "text" name = "login"></td>
				</table>
				<table align = "center">
					<td><b>Пароль: </b><input type = "password" name = "password"></td>
					<tr><td align = "center"><input type = "submit" name = "signin" value = "Войти"></td></tr>
					<td align = "center"><input type = "submit" name = "signup" value = "Зарегистрироваться"></td>
				</table>
<?			} else {
?>				<br><br><br><br><br><br><br><br><br><br><br><br><br>
				<table align = "center">
					<td><b>Логин: </b><td><input type = "text" name = "login" autofocus></td>
				</table>
				<table align = "center">
					<td><b>Пароль: </b><input type = "password" name = "password"></td>
					<tr><td align = "center"><input type = "submit" name = "signin" value = "Войти"></td></tr>
					<tr><td align = "center"><input type = "submit" name = "signup" value = "Зарегистрироваться"></td></tr>
					<tr><td align = "center"><input type = "submit" name = "sign" value = "Войти как гость"></td></tr>
				</table>
<?			}
		function cont($sql) {
			connect(); $db = $_POST['db']; $result = mysqli_query($db, $sql) or die(mysqli_error($db));
			$sql1 = "SELECT PicID FROM pictures ORDER BY PicID DESC LIMIT 1"; $result1 = mysqli_query($db, $sql1); $row1 = mysqli_fetch_array($result1);
			for($i = 1; $i <= $row1['PicID']; $i++) {
				$sql2 = "SELECT PicName FROM pictures WHERE PicID = '$i'"; $result2 = mysqli_query($db, $sql2);
				$row2 = mysqli_fetch_array($result2); $pic[$i] = $row2['PicName'];
			}
			$sql3 = "SELECT CommentID FROM comments ORDER BY CommentID DESC LIMIT 1"; $result3 = mysqli_query($db, $sql3); $row3 = mysqli_fetch_array($result3);
			for($i = 1; $i <= $row3['CommentID']; $i++) {
				$sql4 = "SELECT Comment FROM comments WHERE CommentID = '$i'"; $result4 = mysqli_query($db, $sql4);
				$row4 = mysqli_fetch_array($result4); $com[$i] = $row4['Comment'];
			}
			$sql5 = "SELECT LinkID FROM links ORDER BY LinkID DESC LIMIT 1"; $result5 = mysqli_query($db, $sql5); $row5 = mysqli_fetch_array($result5);
			for($i = 1; $i <= $row5['LinkID']; $i++) {
				$sql6 = "SELECT Source FROM links WHERE LinkID = '$i'"; $result6 = mysqli_query($db, $sql6);
				$row6 = mysqli_fetch_array($result6); $lin[$i] = $row6['Source'];
			} $i = 1;
			$tm1 = date("w"); $tm2 = date("j "); $tm3 = date("n");
			if($tm1 == 0) { $tm1 = "Воскресенье, "; } elseif($tm1 == 1) { $tm1 = "Понедельник, "; } elseif($tm1 == 2) { $tm1 = "Вторник, "; } elseif($tm1 == 3) {
				$tm1 = "Среда, "; } elseif($tm1 == 4) { $tm1 = "Четверг, "; } elseif($tm1 == 5) { $tm1 = "Пятница, "; } elseif($tm1 == 6) { $tm1 = "Суббота, "; }
			if($tm3 == 1) { $tm3 = "января"; } elseif($tm3 == 2) { $tm3 = "февраля"; } elseif($tm3 == 3) { $tm3 = "марта"; } elseif($tm3 == 4) { $tm3 = "апреля"; }
			elseif($tm3 == 5) { $tm3 = "мая"; } elseif($tm3 == 6) { $tm3 = "июня"; } elseif($tm3 == 7) { $tm3 = "июля"; } elseif($tm3 == 8) { $tm3 = "августа"; }
			elseif($tm3 == 9) { $tm3 = "сентября"; } elseif($tm3 == 10) { $tm3 = "октября"; } elseif($tm3 == 11) { $tm3 = "ноября"; } elseif($tm3 == 12) { $tm3 = "декабря"; }
			if(isset($_POST['login'])) {
?>				<h1 align = "center" style = "color:#228B22;">Добро пожаловать на сайт, <? print($_POST['login']); ?>!</h1>
<?			} else {
?>				<table align = "right"><tr><td style = "color:#228B22;"><h1>Добро пожаловать на сайт!</h1></td><td align = "right" width = "457">
				<b><? print $tm1; print $tm2; print $tm3; ?></b><b><p align = "right" id = "txt"></p></b></td></tr></table><br><br><br><br>
<?			}
?>			<table align = "center"><td><b><input type = "search" id = "searc" placeholder = "Поиск по названию" autofocus></b></td></table><div id = "search_results">
<?			if(mysqli_num_rows($result) > 0) {
?>				<h3 align = "center" style = "color:#228B22;">Список аниме:</h3>
				<table align = "center" cellpadding = "4">
				<tr><td width = "23"><b>#</b></td><td width = "520"><b>Название</b></td><td width = "90"><b>Эпизоды</b></td><td width = "45"><b>Тип</b></td></tr>
				</table><hr color = "green" width = "710" size = "0.01">
				<table align = "center" cellpadding = "4">
<?					while($row = mysqli_fetch_array($result)) {
						$s = $row["Title"]; $s1 = $row["Type"]; $s2 = $row["SeriesNumber"]; $s3 = $row["GenreName"]; $s4 = $row["StudioName"];
?>						<tr><td width = "25" style = "color:#FF0000;"><? print $row["ID"] ?></td><td width = "545">
						<a href="info.php?c=imgs/<? print $pic[$i] ?>&t=<? print $s ?>&tp=<? print $s1 ?>&n=<? print $s2 ?>&ge=<? print $s3 ?>&st=<? print $s4 ?>&te=<? print $com[$i] ?>&l=<? print $lin[$i] ?>">
						<? print $s ?></a></td><td width = "60"><? print $s2 ?></td><td><? print $s1 ?></td></tr><? $i++;
					}
?>				</table></div>
<?			}
?>			<script src = "./dlc/jquery.js"></script><script type = 'text/javascript'>
				$(document).ready(function() { //$("#search_results").slideUp();
					$("#searc").keyup(function(e) { e.preventDefault(); ajax_search(); });
				});
				function ajax_search() {
					$("#search_results").show(); var search_val = $("#searc").val(); $.post("./find.php", { search : search_val }, function(data) {
						if(data.length > 0) { $("#search_results").html(data); }
					});
				}
			</script>
<?		}
		function signin($login, $password) {
			$tm1 = date("w"); $tm2 = date("j "); $tm3 = date("n");
			if($tm1 == 0) { $tm1 = "Воскресенье, "; } elseif($tm1 == 1) { $tm1 = "Понедельник, "; } elseif($tm1 == 2) { $tm1 = "Вторник, "; } elseif($tm1 == 3) {
				$tm1 = "Среда, "; } elseif($tm1 == 4) { $tm1 = "Четверг, "; } elseif($tm1 == 5) { $tm1 = "Пятница, "; } elseif($tm1 == 6) { $tm1 = "Суббота, "; }
			if($tm3 == 1) { $tm3 = "января"; } elseif($tm3 == 2) { $tm3 = "февраля"; } elseif($tm3 == 3) { $tm3 = "марта"; } elseif($tm3 == 4) { $tm3 = "апреля"; }
			elseif($tm3 == 5) { $tm3 = "мая"; } elseif($tm3 == 6) { $tm3 = "июня"; } elseif($tm3 == 7) { $tm3 = "июля"; } elseif($tm3 == 8) { $tm3 = "августа"; }
			elseif($tm3 == 9) { $tm3 = "сентября"; } elseif($tm3 == 10) { $tm3 = "октября"; } elseif($tm3 == 11) { $tm3 = "ноября"; } elseif($tm3 == 12) { $tm3 = "декабря"; }
			connect(); $db = $_POST['db']; $sql = "SELECT * FROM users WHERE Login = '$login'";
			$result = mysqli_query($db, $sql); $count = mysqli_num_rows($result);
			if($count == 0) {
?>				<h3 style = "color:#FF0000;">Неверное имя пользователя! Вернитесь на предыдущую страницу и попытайтесь снова.</h3>
<?			} else {
				$row = mysqli_fetch_array($result);
				if($password != $row["Password"]) {
?>					<h3 style = "color:#FF0000;">Неверный пароль! Вернитесь на предыдущую страницу и попытайтесь снова.</h3>
<?				} else {
?>					<table align = "right"><tr><td style = "color:#228B22;"><h2>Вы успешно вошли в систему!</h2></td><td align = "right" width = "457">
					<b><? print $tm1; print $tm2; print $tm3; ?></b><b><p align = "right" id = "txt"></p></b></td></tr></table><br><br><br><br>
<?					if($row["Level"] == 0) {
						$sql = "SELECT * FROM list"; cont($sql);
					} else {
						$sql = "SELECT * FROM list"; cont($sql);
?>						<form action = "addrec.php" method = "post">
							<table align = "center">
								<br><tr><td><input type = "submit" name = "add" value = "Добавить запись"></td>
						</form><form action = "change.php" method = "post">
								<td><input type = "submit" name = "cha" value = "Редактировать запись"></td>
						</form><form action = "delete.php" method = "post">
								<td><input type = "submit" name = "del" value = "Удалить запись"></td></tr>
							</table>
						</form>
<?					}
				}
			}
		}
		function signup($logn, $passwrd) {
			if($_POST['signup'] == "ok") {
				connect(); $db = $_POST['db'];
				if($logn == "" || $passwrd == "") {
					print("<h2 style = \"color:#FF0000;\">Заполните оба поля!</h2>"); ?><br><input type = "submit" name = "bac" value = "Вернуться">
<?				} else {
					$sql = "INSERT INTO users VALUES ('$logn', '$passwrd', '0')"; mysqli_query($db, $sql);
					print("<h2 align = \"center\" style = \"color:008000;\">Вы успешно зарегистрировались!</h2>");
?>					<br><div align = "center"><input type = "submit" name = "bak" value = "Вернуться"></div>
<?				}
			} else {
?>				<h3><b>Пожалуйста, заполните регистрационную форму:</b></h3>
				<form action = "animelist.php" method = "post">
					<table>
						<input type = "hidden" name = "signup" value = "ok"><tr><td align = "center"><b>Логин: </b><input type = "text" name = "logn">
						</td></tr><td><b>Пароль: </b><input type = "password" name = "passwrd" maxlength = "8"></td>
						<td><p><input type = "submit" name = "sgnp" value = "Зарегистрироваться"></td>
					</table>
				</form>
<?			}
		}
?>		</form>
	</body>
</html>
