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

displaySong($db);


function displaySong($db)
{

	//Get the name of the artist for each song
	$accQuery = "SELECT `acc_name` FROM `account` WHERE `acc_id`='".$_GET['accID']."'";
	$accResult = mysqli_query($db, $accQuery);
	$accID = mysqli_fetch_assoc($accResult);
	
	$inQuery = "SELECT `song_name`, `song_descrip`, `file_format`, `genre` FROM `song` WHERE `song_id`='".$_GET["songID"]."'";
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
		echo "<td>"."<b>Artist:   ".$accID["acc_name"]. "</b></td>";
		echo "</tr>";	
		echo "</table>";
	}
	
}
?>

<form action="showAllSongs.php">
	<input type="submit" value="Back to Main" style="position:relative;left:0px;top:50px;">
</form>


</body>
</html>