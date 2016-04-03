<?php
	include_once("./connect.php");
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="styles.css">
	<style>
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
	}
	th, td {
		padding: 5px;
		text-align: left;
	}
	</style>
	</head>
<body>

<?php
$songname = $song_descrip = $genre = "";
viewSong($db);
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$songname = getInput($_POST["song"]);
	$song_descrip = getInput($_POST["description"]);
	$genre = getInput($_POST["genre"]);

}
if(isset($_POST['song']))
{
	if($songname == "")
	{
		//Do nothing
	}
	else
	{
		$inQuery = "UPDATE `song` SET `song_name`='".$songname."' WHERE `song_id`='".$_SESSION['songID']."'";
		$runQuery = mysqli_query($db, $inQuery, MYSQLI_STORE_RESULT);
	}
	header("Refresh:0");//Refresh the page
}
if(isset($_POST['description']))
{
	if($song_descrip == "")
	{
		//Do nothing
	}
	else
	{
		$inQuery = "UPDATE `song` SET `song_descrip`='".$song_descrip."' WHERE `song_id`='".$_SESSION['songID']."'";
		$runQuery = mysqli_query($db, $inQuery, MYSQLI_STORE_RESULT);
	}
	header("Refresh:0");//Refresh the page
}
if(isset($_POST['genre']))
{
	if($genre == "")
	{
		//Do nothing
	}
	else
	{
		$inQuery = "UPDATE `song` SET `genre`='".$genre."' WHERE `song_id`='".$_SESSION['songID']."'";
		$runQuery = mysqli_query($db, $inQuery, MYSQLI_STORE_RESULT);
	}
	header("Refresh:0");//Refresh the page
}
function viewSongs($db)
{
	$inQuery = "SELECT `song_name`, `song_descrip`, `file_format`, `genre` FROM `song` WHERE (`song_name`='" .$_SESSION["songname"]. "' AND `song_id`='".$_SESSION["songID"]."')";
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
		echo "<td>"."Genre:   ".$row["genre"]. "</td>";
		echo "</tr>";	
		echo "</table>";
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
	<input type="submit" value="Cancel edits" style="position:relative;left:0px;top:240px;">
</form>

<form action="" method="post">
	Song name:<br>
	<input type="text" name="song"><br>
	Description:<br>
	<input type="text" name="description"><br>
	Genre:<br>
	<input type="text" name="genre"><br>
	<input type="submit" value="Save edits" style="position:relative;left:120px;top:25px;">
</form>

</body>
</html>