<?	if(isset($_POST['add1'])) {
?>		<form action = "animelist.php" method = "post">
<?			$db = mysqli_connect("127.0.0.1", "root") or die('Не могу подключиться к серверу.'); mysqli_select_db($db, "kurs") or die('Не могу выбрать базу данных.');
			$q = "SELECT GenreID FROM genres WHERE GenreName = '".$_POST['gr']."'"; $w = "SELECT StudioID FROM studios WHERE StudioName = '".$_POST['st']."'";
			$ql = "SELECT ID FROM list ORDER BY ID DESC LIMIT 1"; $r = mysqli_fetch_array(mysqli_query($db, $ql));
			$gnr = mysqli_fetch_array(mysqli_query($db, $q)); $std = mysqli_fetch_array(mysqli_query($db, $w));
			if($gnr['GenreID'] == "" || $std['StudioID'] == "") {
				if($gnr['GenreID'] == "") {
					$q1 = "SELECT GenreID FROM genres ORDER BY GenreID DESC LIMIT 1"; $res = mysqli_query($db, $q1); $r1 = mysqli_fetch_array($res);
					$sql1 = "INSERT INTO genres VALUES ('".($r1['GenreID'] + 1)."', '".$_POST['gr']."')"; mysqli_query($db, $sql1);
					$sq="INSERT INTO list VALUES('".($r['ID']+1)."','".$_POST['tit']."','".$_POST['sn']."','".$_POST['tp']."','".$gnr['GenreID']."','".$std['StudioID']."')";
					mysqli_query($db, $sq);
				} else {
					$q1 = "SELECT StudioID FROM studios ORDER BY StudioID DESC LIMIT 1"; $res = mysqli_query($db, $q1); $r1 = mysqli_fetch_array($res);
					$sql1 = "INSERT INTO studios VALUES ('".($r1["StudioID"] + 1)."', '".$_POST['st']."')"; mysqli_query($db, $sql1);
					$sq="INSERT INTO list VALUES('".($r['ID']+1)."','".$_POST['tit']."','".$_POST['sn']."','".$_POST['tp']."','".$gnr['GenreID']."','".$std['StudioID']."')";
					mysqli_query($db, $sq);
				}
			} else {
				$sq="INSERT INTO list VALUES('".($r['ID']+1)."','".$_POST['tit']."','".$_POST['sn']."','".$_POST['tp']."','".$gnr['GenreID']."','".$std['StudioID']."')";
				mysqli_query($db, $sq);
			} $path = 'imgs/'; $ext = array_pop(explode('.', $_FILES['myfile']['name'])); $new_name = time().'.'.$ext; $full_path = $path.$new_name;
			if($_FILES['myfile']['error'] == 0){
				if(move_uploaded_file($_FILES['myfile']['tmp_name'], $full_path)) {
					print "<h3 align = \"center\" style = \"color:#228B22;\">Успешно добавлено</h3>";
					$q = "SELECT PicID FROM pictures ORDER BY PicID DESC LIMIT 1"; $r = mysqli_fetch_array(mysqli_query($db, $q));
					$q1 = "INSERT INTO pictures VALUES('".($r['PicID']+1)."', '$new_name')"; mysqli_query($db, $q1);
				}
			} else { print "Ne"; } $_POST['sign'] = "r";
?>		<div align = "center"><input type = "submit" name = "back" value = "Вернуться"></div></form>
<?	} else {
?>		<form action = "add.php" method = "post">
			<table align = "center">
				<tr><td align = "center"><b>Название</b></td><td align = "center"><b>Эпизоды</b></td><td align = "center">
				<b>Тип</b></td><td align = "center"><b>Жанр</b></td><td align = "center"><b>Студия</b></td></tr><td>
				<input type = "text" name = "tit" value = "" size = "50" autofocus></td><td><input type = "text" name = "sn" value = "" size = "5">
				</td><td><input type = "text" name = "tp" value = "" size = "15"></td><td><input type = "text" name = "gr" value = "" size = "15">
				</td><td><input type = "text" name = "st" value = "" size = "15"></td><input type = "hidden" id = "login" value = "<? print $login ?>">
			</table><br><div align = "center"><label><input type = "file" name = "myfile" id = "myfile"></label>
		<br><br><input class = "b-link_button" type = "submit" name = "add1" value = "Добавить"></div></form> <?
	} ?>