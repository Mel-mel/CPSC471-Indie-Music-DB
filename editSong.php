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
$songname = $song_descrip = $genre = $songID = "";

displaySongList($db);

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$songname = getInput($_POST["song"]);
	$song_descrip = getInput($_POST["description"]);
	$genre = getInput($_POST["genre"]);
	
	$query = "SELECT `song_id` FROM `song` WHERE `song_name`='";

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
			echo "<table border='1'style='width:90%'>";
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
			echo "<a href='doEdits.php?songID=".$row["song_id"]."'>Edit Song</a>";
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
	<input type="submit" value="Cancel edits" style="position:relative;left:0px;top:240px;">
</form>

</body>
</html>