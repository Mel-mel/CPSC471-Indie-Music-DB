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
$songname = $song_descrip = $file_format = $genre = $file_ext = "";

if(isset($_FILES['musicfile']))
{
	$error = array();
	$fileName = $_FILES['musicfile']['name'];
	$fileSize = $_FILES['musicfile']['size'];
	$tempName = $_FILES['musicfile']['tmp_name'];
	$type = $_FILES['musicfile']['type'];
	$file_ext = strtolower(end(explode('.', $_FILES['musicfile']['name'])));
	
	$format = array('wav', 'aif', 'mp3');
	
	//Check if the file is of the allowed format
	if(in_array($file_ext, $format) === false)
	{
		$error[]="File format not allowed. Please have either a WAVE, AIF, or MP3 file.";
	}
	
	//SIDE NOTE: CANNOT UPLOAD FILES THAT ARE GREATER THAN 2 MB.
	//Would need to change php memory limit >_>
	
	//Store the file into the folder location
	if(empty($error) == true)
	{
		$location = "".$_SESSION['username']."/";
		move_uploaded_file($tempName, $location.$fileName);
		echo "<font size='16'>Successfully upload a song! Add another one?</font>";
	}
	else
	{
		print_r($errors);
	}
}


if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$songname = getInput($_POST["song"]);
	$song_descrip = getInput($_POST["description"]);
	//$file_format = getInput($_POST["fileformat"]);
	$genre = getInput($_POST["genre"]);
	
	//Insert information into song table
	$newSongQuery = "INSERT INTO Song (song_name, song_descrip, file_format, genre) VALUES ('" .$songname ."', '" . $song_descrip ."', '" . $fileName . "', '" . $genre . "')";
	$result = mysqli_query($db, $newSongQuery, MYSQLI_STORE_RESULT);
	
	
	//Insert information into upload table
	//Get the most recent query information from above
	$query = "SELECT * FROM Song ORDER BY song_id DESC LIMIT 1";
	$array = mysqli_query($db, $query);
	$songResults = mysqli_fetch_assoc($array);
	
	//Use the session acc_id of the current user and the song_id from above
	$upQuery = "INSERT INTO Upload (song_id, acc_id) VALUES ('".$songResults["song_id"]."', '".$_SESSION["accountID"]."')";
	$result2 = mysqli_query($db, $upQuery, MYSQLI_STORE_RESULT);
	
	//Add account id and song id to the rate_out_of_five table for the rating system
	$query = "INSERT INTO rate_out_of_five (acc_id, song_id) VALUES('".$_SESSION['accountID']."', '".$songResults['song_id']."')";
	$result3 = mysqli_query($db, $query, MYSQLI_STORE_RESULT);
	
	if($result === false || $result2 === false || $result3 === false)
	{
		echo "There is an error with the query.";
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
	<input type="submit" value="Back to Main" style="position:relative;left:15px;top:281px;">
</form>

<form action="" method="post" enctype="multipart/form-data">
	<fieldset>
		<legend> Add Your Song </legend>
		Song Name:<br>
		<input type="text" name="song" required><br>
		Song Description:<br>
		<input type="text" name="description" required><br>
		File:<br>
		<input type="file" name="musicfile" required><br>
		Genre:<br>
		<input type="text" name="genre"><br>
		<input type="submit" value="Submit" style="position:relative;left:120px;top:2px;">
	</fieldset>
	
</form>

</body>
</html>