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
$songname = $song_descrip = $file_format = $genre = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$songname = getInput($_POST["song"]);
	$song_descrip = getInput($_POST["description"]);
	$file_format = getInput($_POST["file format"]);
	$genre = getInput($_POST["genre"]);
	
	//Adding new information for an account
	$newSongQuery = "INSERT INTO Song (song_name, song_descrip, file_format, genre) VALUES ('" .$songname ."', '" . $song_descrip ."', '" . $file_format . "', '" . $genre . "')";
	$result = mysqli_query($db, $newSongQuery, MYSQLI_STORE_RESULT);
	
	
	//echo "INSERT INTO Account (acc_name, password, real_name, country, birth_date, email) VALUES ('" .$username ."', '" . $password ."', 'Bob', '', '', 'some email')";

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
<form action="index.php">
	<input type="submit" value="Back to Main" style="position:relative;left:15px;top:281px;">
</form>

<form action="createSong.php" method="post">
	<fieldset>
		<legend> Add Your Song </legend>
		Song Name:<br>
		<input type="text" name="song" required><br>
		Song Description:<br>
		<input type="text" name="description" required><br>
		File Format:<br>
		<input type="text" name="file format" required><br>
		Genre:<br>
		<input type="text" name="genre"><br>
		<input type="submit" value="Submit" style="position:relative;left:120px;top:2px;">
	</fieldset>
	
</form>

</body>
</html>