<?	$db = mysqli_connect("127.0.0.1", "root") or die('Не могу подключиться к серверу.');
	mysqli_select_db($db, "kurs") or die('Не могу выбрать базу данных.');
	$term = strip_tags(substr($_POST['search'], 0, 100)); $term = mysql_escape_string($term);
	$sql = "select * from list where Title like '%$term%'"; $result = mysqli_query($db, $sql);
	$sql1 = "SELECT PicID FROM pictures ORDER BY PicID DESC LIMIT 1"; $row1 = mysqli_fetch_array(mysqli_query($db, $sql1));
	for($i = 1; $i <= $row1['PicID']; $i++) {
		$sql2 = "SELECT PicName FROM pictures WHERE PicID = '$i'"; $row2 = mysqli_fetch_array(mysqli_query($db, $sql2)); $pic[$i] = $row2['PicName'];
	}
	$sql3 = "SELECT CommentID FROM comments ORDER BY CommentID DESC LIMIT 1"; $result3 = mysqli_query($db, $sql3); $row3 = mysqli_fetch_array($result3);
	for($i = 1; $i <= $row3['CommentID']; $i++) {
		$sql4 = "SELECT Comment FROM comments WHERE CommentID = '$i'"; $row4 = mysqli_fetch_array(mysqli_query($db, $sql4)); $com[$i] = $row4['Comment'];
	}
	$sql5 = "SELECT LinkID FROM links ORDER BY LinkID DESC LIMIT 1"; $result5 = mysqli_query($db, $sql5); $row5 = mysqli_fetch_array($result5);
	for($i = 1; $i <= $row5['LinkID']; $i++) {
		$sql6 = "SELECT Source FROM links WHERE LinkID = '$i'"; $row6 = mysqli_fetch_array(mysqli_query($db, $sql6)); $lin[$i] = $row6['Source'];
	} $i = 1; $string = '';
	if(mysqli_num_rows($result) > 0){
?>		<h3 align = "center" style = "color:#228B22;">Список аниме:</h3>
		<table align = "center" cellpadding = "4">
			<tr><td width = "23"><b>#</b></td><td width = "520"><b>Название</b></td><td width = "90"><b>Эпизоды</b></td><td width = "45"><b>Тип</b></td></tr>
		</table><hr color = "green" width = "710" size = "0.01">
		<table align = "center" cellpadding = "4">
<?			while($row = mysqli_fetch_array($result)) {
				$s = $row["Title"]; $s1 = $row["Type"]; $s2 = $row["SeriesNumber"]; $s3 = $row["GenreName"]; $s4 = $row["StudioName"];
?>				<tr><td width = "25" style = "color:#FF0000;"><? print $row["ID"] ?></td><td width = "545">
				<a href = "info.php?c=imgs/<?print$pic[$i]?>&t=<?print$s?>&tp=<?print$s1?>&n=<?print$s2?>&ge=<?print$s3?>&st=<?print$s4?>&te=<?print$com[$i]?>&l=<?print$lin[$i]?>">
				<? print $s ?></a></td><td width = "60"><? print $s2 ?></td><td><? print $s1 ?></td></tr><? $i++;
			}
?>		</table>
<?	} else { ?><br><h3 align = "center" style = "color:#808080">Ничего нет</h3><? } ?>