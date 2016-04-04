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
$songname = $sID = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$songname = getInput($_POST["song"]);
	$sID = getInput($_POST["ID"]);
	
	$newDeleteQuery = "DELETE FROM Song WHERE (`song_name`='" .$songname ."' AND `song_id`='".$sID."')";
	$result = mysqli_query($db, $newDeleteQuery, MYSQLI_STORE_RESULT);
	
	
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
	<input type="submit" value="Cancel" style="position:relative;left:15px;top:281px;">
</form>

<form action="deleteSong.php" method="post">
	<fieldset>
		<legend> Delete Song </legend>
		Song Name:<br>
		<input type="text" name="song" required><br>
		Song ID:<br>
		<input type="text" name="ID" required><br>
		<input type="submit" value="Delete" style="position:relative;left:120px;top:2px;">
	</fieldset>
	
</form>

</body>
</html>