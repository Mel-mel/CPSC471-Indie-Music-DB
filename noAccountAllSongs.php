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
	//Get list of all song ids
	$query = "SELECT `song_id`, `acc_id` FROM `upload`";
	$result = mysqli_query($db, $query);

	
	while($row = mysqli_fetch_assoc($result))
	{
		//Get the name of the artist for each song
		$accQuery = "SELECT `acc_name` FROM `account` WHERE `acc_id`='".$row['acc_id']."'";
		$accResult = mysqli_query($db, $accQuery);
		$accID = mysqli_fetch_assoc($accResult);
	
		$inQuery = "SELECT `song_name`, `song_descrip`, `file_format`, `genre` FROM `song` WHERE `song_id`='".$row['song_id']."'";
		$runQuery = mysqli_query($db, $inQuery);
	
		while($row2 = mysqli_fetch_assoc($runQuery))
		{
			echo "<table border='1'style='width:15%'>";
			echo "<tr>";
			echo "<td>"."Song name:   <b>".$row2["song_name"]. "</b></td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>"."Description:   ".$row2["song_descrip"]. "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>"."Genre:   ".$row2["genre"]. "</td>";
			echo "</tr>";	
			echo "<tr>";
			echo "<td>"."<b>Artist:   ".$accID["acc_name"]. "</b></td>";
			echo "</tr>";
			
			echo "</table>";
			echo "<a href='noAccountviewSong.php?songID=".$row["song_id"]."'style='position:relative;left:295px;top:-50px;font-size:26px;'>Listen</a>";
			echo "<br>";
		}
	}
	
	
}
?>

<form action="loginPage.php">
	<input type="submit" value="Back to the Login Page" style="position:relative;left:0px;top:50px;">
</form>


</body>
</html>