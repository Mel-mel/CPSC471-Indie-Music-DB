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

$songrate = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$songrate = getInput($_POST["rate"]);
	rateSongs($db);
}

function rateSongs($db)
{
	$inQuery = "SELECT `song_name`, `song_descrip`, `file_format`, `genre` FROM `song` WHERE (`song_name`='" .$_SESSION["songname"]. "' AND `song_id`='".$_SESSION["songID"]."')";
	$runQuery = mysqli_query($db, $inQuery);
	
	$rateSongQuery = "INSERT INTO `rate` (song_id, acc_id, rating) VALUES ('" .$_SESSION["songID"]."', '" .$_SESSION["accountID"]."', '" . $songrate . "')";
	$result = mysqli_query($db, $rateSongQuery, MYSQLI_STORE_RESULT);
	
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
	<input type="submit" value="Back to Main" style="position:relative;left:0px;top:50px;">
</form>

<form action="rateSong.php" method="post">
	<fieldset>
		<legend> Rate Song </legend>
		Rating:<br>
		<input type="text" name="rate"><br>
		<input type="submit" value="Submit" style="position:relative;left:120px;top:2px;">
	</fieldset>
	
</form>

</body>
</html>