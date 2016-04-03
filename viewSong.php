<?php
	include_once("./connect.php");
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="styles.css">
	</head>
<body>

<?php
viewSongs($db);
function viewSongs($db)
{
	$inQuery = "SELECT `song_name`, `song_descrip`, `file_format`, `genre` FROM `song` WHERE (`song_name`='" .$_SESSION["songname"]. "' AND `song_id`='".$_SESSION["songID"]."')";
	$runQuery = mysqli_query($db, $inQuery);
	
	while($row = mysqli_fetch_assoc($runQuery))
	{
		echo "<table border='1'style='width:35%'>";
		echo "<tr>";
		echo "<td>"."Song name:   ".$row["song_name"]. "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>"."Description:   ".$row["song_descrip"]. "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>"."File Format:   ".$row["file_format"]. "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>"."Genre:   ".$row["genre"]. "</td>";
		echo "</tr>";	
		echo "</table>";
	}
	
}
?>

<form action="mainPage.php">
	<input type="submit" value="Back to Main" style="position:relative;left:0px;top:50px;">
</form>


</body>
</html>