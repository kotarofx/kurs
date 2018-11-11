<?	if(isset($_POST['chang'])) { ?><div align = "center"><input type = "submit" name = "back" value = "Вернуться"></div><?
	} elseif(isset($_POST['chan'])) {
?>		<form action = "animelist.php" method = "post">
<?			$db = mysqli_connect("127.0.0.1", "root") or die('Не могу подключиться к серверу'); mysqli_select_db($db, "kurs") or die('Не могу выбрать базу данных');
			$sq="SELECT * FROM(list LEFT JOIN genres ON list.GenreID=genres.GenreID)LEFT JOIN studios ON list.StudioID=studios.StudioID WHERE ID='".$_POST['id']."'";
			$red = mysqli_fetch_array(mysqli_query($db, $sq));
?>			<table align = "center">
				<td><input type = "text" name = "fir" value = "<? print $red['Title'] ?>"></td>
				<td><input type = "text" name = "sec" value = "<? print $red['SeriesNumber'] ?>"></td>
				<td><input type = "text" name = "thi" value = "<? print $red['Type'] ?>"></td>
				<td><input type = "text" name = "fou" value = "<? print $red['GenreName'] ?>"></td>
				<td><input type = "text" name = "fif" value = "<? print $red['StudioName'] ?>">
				</td><input type = "hidden" id = "login1" value = "<? print $_POST['login'] ?>">
<?				$sq1 = "SELECT GenreID FROM genres WHERE GenreName = '".$red['GenreName']."'";
				$_POST['sev'] = mysqli_fetch_array(mysqli_query($db, $sq1))['GenreID'];
				$sq2 = "SELECT StudioID FROM studios WHERE StudioName = '".$red['StudioName']."'";
				$_POST['eig'] = mysqli_fetch_array(mysqli_query($db, $sq2))['StudioID'];
?>				<td><input type = "submit" name = "chang" value = "Изменить"></td>
			</table>
		</form>
<?	} else {
?>		<form action = "change.php" method = "post">
			<table align = "center">
				<br><tr><td align = "center"><b>ID:</b></td></tr><tr><td><input type = "text" name = "id" autofocus></td>
				<tr><td align = "center"><br><input type = "submit" name = "chan" value = "Редактировать"></td></tr>
			</table>
		</form>
<?	} ?>