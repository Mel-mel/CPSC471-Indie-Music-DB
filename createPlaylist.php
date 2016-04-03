<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
	include_once("./connect.php");
?>
<?php
//Defining variables set to a default of null
$playlist = $description = $sort = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$playlist = getInput($_POST["playlistName"]);
	$descrip = getInput($_POST["description"]);
	$sort = getInput($_POST["sort"]);
	
	//Adding new information for an account
	$newPlaylistQuery = "INSERT INTO Playlist (playlist_name, playlist_descrip, sort_by) VALUES ('" .$playlist ."', '" . $descrip ."', '" . $sort . "')";
	$result = mysqli_query($db, $newPlaylistQuery, MYSQLI_STORE_RESULT);

	if($result === false)
	{
		echo "You dun fawked up";
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
<form action="loginPage.php">
	<input type="submit" value="Back to Main" style="position:relative;left:15px;top:281px;">
</form>

<form action="createPlaylist.php" method="post">
	<fieldset>
		<legend> Create Playlist </legend>
		Playlist Name:<br>
		<input type="text" name="playlist" required><br>
		Playlist Description:<br>
		<input type="text" name="descrip" required><br>
		Sort By:<br>
		<input type="text" name="sort" required><br>
		<input type="submit" value="Submit" style="position:relative;left:120px;top:2px;">
	</fieldset>
	
</form>

</body>
</html>