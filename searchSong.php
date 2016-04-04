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
$search = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$search = getInput($_POST["search"]);
	
	$newSearchQuery = "SELECT `song_name`, `song_descrip`, `file_format`, `genre` FROM `song` WHERE (`song_name`='" .$search. "' OR `song_descrip`='" .$search. "' OR `file_format`='" .$search. "' OR `genre`='" .$search. "' )";
	$result = mysqli_query($db, $newSearchQuery, MYSQLI_STORE_RESULT);


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
<form action="mainPage.php">
	<input type="submit" value="Back to Main" style="position:relative;left:15px;top:281px;">
</form>

<form action="searchSong.php" method="post">
	<fieldset>
		<legend> Search Song </legend>
		Search:<br>
		<input type="text" name="search" required><br>
		<input type="submit" value="Search" style="position:relative;left:120px;top:2px;">
	</fieldset>
	
</form>

</body>
</html>