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
//Defining variables set to a default of null
$username = $password = "";

viewList($db);
	
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	
	if(isset($_POST["yes"]))
	{
		//DELETE FROM `upload` WHERE `song_id`=13 AND `acc_id`=31
		
		//Remove the song from the localhost location. aka in musicFiles
		//First get the file name and append it to it's containing folder
		$query = "SELECT `file_format` FROM `song` WHERE `song_id`='".$_GET['songID']."'";
		$result = mysqli_query($db, $query);
		$fileName = mysqli_fetch_assoc($result);
		$filePath = "".$_SESSION['username']."/".$fileName['file_format'];
		
		//Next, remove the file from that file path
		if(unlink($filePath))
		{
			echo "Song successfully removed";
		}
		else
		{
			echo "Error, unable to remove song";
		}
		
		//Remove the song from the "upload" table so that it won't be used in the future
		$query = "DELETE FROM `upload` WHERE `song_id`='".$_GET['songID']."' AND `acc_id`='".$_SESSION["accountID"]."'";
		$result = mysqli_query($db, $query, MYSQLI_STORE_RESULT);
		
		//Remove the song id and acc id from rate out of five
		$query = "DELETE FROM `rate_out_of_five` WHERE `song_id`='".$_GET['songID']."' AND `acc_id`='".$_SESSION["accountID"]."'";
		$result = mysqli_query($db, $query, MYSQLI_STORE_RESULT);
		
		//After removing the song id and account id from upload, can now remove the song from the song table
		//(Since the upload table prevents songs from being delete before it. It's the foreign acc_id)
		$query = "DELETE FROM `song` WHERE `song_id`='".$_GET['songID']."'" ;
		$removeQuery = mysqli_query($db, $query, MYSQLI_STORE_RESULT);
		echo "<br clear='left'/>";
		echo "<font size='20'><p>Song removed</p></font>";
		echo "<table border='1'style='width:90%'>";
		echo "<tr>";
		echo "<th>Song name</th>";
		echo "<th>Song Description</th>";
		echo "<th>File format</th>";
		echo "<th>Genre</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td> </td>";
		echo "<td> </td>";
		echo "<td> </td>";
		echo "<td> </td>";
		echo "</tr>";
		echo "</table>";
		
		
		
		
		if($result === false)
		{
			echo "deleting part of upload went wrong";
		}
		if($removeQuery === false)
		{
			echo "delete song went wrong";
		}	
		//Might have to do this in the "download" table as well...
	}
	else
	{
		header("Location: adminviewDeleteSong.php");
	}
}


function viewList($db)
{
	//Get the song information and display them
	$inQuery = "SELECT `song_name`, `song_descrip`, `file_format`, `genre` FROM `song` WHERE `song_id`='".$_GET['songID']."'" ;
	$runQuery = mysqli_query($db, $inQuery);

	while($row = mysqli_fetch_assoc($runQuery))
	{
		echo "<table border='1'style='width:90%'>";
		echo "<tr>";
		echo "<th>Song name</th>";
		echo "<th>Song Description</th>";
		echo "<th>File format</th>";
		echo "<th>Genre</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>".$row["song_name"]. "</td>";
		echo "<td>".$row["song_descrip"]. "</td>";
		echo "<td>".$row["file_format"]. "</td>";
		echo "<td>".$row["genre"]. "</td>";
		echo "</tr>";
		echo "</table>";
		echo "<br>";
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

<form action="adminviewDeleteSong.php">
	<input type="submit" value="Go back" style="position:relative;left:0px;top:240px;font-size:20px">
</form>

<form action="" method="post">
	<p>Are you sure you want to remove this song?</p>
	<input type="submit" name="yes" value="Yes">
	<input type="submit" name="no" value="No">
</form>




</body>
</html>