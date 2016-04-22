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
$songname = "";
displaySong($db);


function displaySong($db)
{

	//Get acc_id from the given song_id
	$songQuery = "SELECT `acc_id` FROM `upload` WHERE `song_id`='".$_GET['songID']."'";
	$songResult = mysqli_query($db, $songQuery);
	$accID = mysqli_fetch_assoc($songResult);
	
	$query = "SELECT `acc_name` FROM `account` WHERE `acc_id`='".$accID['acc_id']."'";
	$result = mysqli_query($db, $query);
	$accName = mysqli_fetch_assoc($result);
	
	$inQuery = "SELECT `song_name`, `song_descrip`, `file_format`, `genre` FROM `song` WHERE `song_id`='".$_GET["songID"]."'";
	$runQuery = mysqli_query($db, $inQuery);
	
	
	while($row = mysqli_fetch_assoc($runQuery))
	{
		echo "<table style='width:15%;position:relative;top:150px'>";
		echo "<tr>";
		echo "<td>"."Song name:   <b>".$row["song_name"]. "</b></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>"."Artist:   <b>".$accName["acc_name"]. "</b></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>"."Description:   ".$row["song_descrip"]. "</td>";
		echo "</tr>";
		echo "</table>";
		$songname = $row['file_format'];
	}
	
	//Fetch the location of the song from the user file
	$path = "".$accName['acc_name']."/".$songname."";
	
	//Get the file extension for the audio to be able to play it
	$file_ext = substr($songname, -3);
	
	//Play the audio file
	echo "
	<form action='showAllSongs.php'>
	<input type='submit' value='Back to Main' style='position:relative;left:0px;top:200px;'>
	</form>
	";
	
	echo "<a href='downloadSong.php?songID=".$_GET['songID']."' style='position:relative;left:300px;top:80px;'>Download Song</a>";
	
	echo "<audio controls style='position:relative;top:-20px;'>";
	echo "<source src='".$path."' type='audio/".$file_ext."'>" ;
	echo "</audio>";
	
}


?>






</body>
</html>