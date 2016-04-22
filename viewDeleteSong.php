<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
	include_once("./connect.php");
?>
<?php
//Defining variables set to a default of null
$songname = $sID = "";

displaySongList($db);

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$songname = getInput($_POST["song"]);
	
	$newDeleteQuery = "DELETE FROM Song WHERE (`song_name`='" .$songname ."' AND `song_id`='".$sID."')";
	$result = mysqli_query($db, $newDeleteQuery, MYSQLI_STORE_RESULT);
	
	

	if($result === false)
	{
		echo "There is an error with the query.";
	}
}


function displaySongList($db)
{
	//Get account id so that it can be used to get all the songs that the current account id holds
	//in the "upload" table
	
	//Get list of songs that belong to the account id. Then use the list of songids to get the list of songs
	//belong to the account id
	
	
	//Get list of songs that belong to the current account id in a session
	$list = "SELECT `song_id` FROM `upload` WHERE `acc_id`='".$_SESSION["accountID"]."'";
	$listResult = mysqli_query($db, $list);
	
	//For each song_id, display information on each song
	while($row = mysqli_fetch_assoc($listResult))
	{
		$display = "SELECT `song_name`, `song_descrip`, `file_format`, `genre` FROM `song` WHERE `song_id`='".$row["song_id"]."'";
		$result = mysqli_query($db, $display);
		while($row2 = mysqli_fetch_assoc($result))
		{
			echo "<table border='1'style='width:40%'>";
			echo "<tr>";
			echo "<th>Song name</th>";
			echo "<th>Song Description</th>";
			echo "<th>File format</th>";
			echo "<th>Genre</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>".$row2["song_name"]. "</td>";
			echo "<td>".$row2["song_descrip"]. "</td>";
			echo "<td>".$row2["file_format"]. "</td>";
			echo "<td>".$row2["genre"]. "</td>";
			echo "</tr>";
			echo "</table>";
			echo "<a href='deleteSong.php?songID=".$row["song_id"]."'>Delete Song</a>";
			echo "<br>";
			echo "<br>";
		}
	}
	
}


function getInput($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
<form action="mainPage.php">
	<input type="submit" value="Cancel" style="position:relative;left:15px;top:281px;">
</form>

</body>
</html>