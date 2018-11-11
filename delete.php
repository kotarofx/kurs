<?	if(isset($_POST['dele'])) {
?>		<form action = "animelist.php" method = "post">
<?			$db = mysqli_connect("127.0.0.1", "root") or die('Не могу подключиться к серверу'); mysqli_select_db($db, "kurs") or die('Не могу выбрать базу данных');
			$id = $_POST['id']; $sq = "DELETE FROM list WHERE ID = '".$_POST['id']."'"; mysqli_query($db, $sq);
?>			<div align = "center"><input type = "submit" name = "back" value = "Вернуться"></div>
		</form>
<?	} else {
?>		<form action = "delete.php" method = "post">
			<table align = "center">
				<br><tr><td align = "center"><b>ID:</b></td></tr><tr><td><input type = "text" name = "id" autofocus></td>
				<tr><td align = "center"><br><input type = "submit" name = "dele" value = "Удалить"></td></tr>
			</table>
		</form>
<?	} ?>