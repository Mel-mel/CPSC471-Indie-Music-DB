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

displaySong($db);

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$songname = getInput($_POST["song"]);
	$song_descrip = getInput($_POST["description"]);
	$genre = getInput($_POST["genre"]);

}

if(isset($_FILES['musicfile']))
{
	$fileName = $_FILES['musicfile']['name'];
	if(empty($fileName) == true)
	{
		//Do nothing
	}
	else
	{
		//Remove the song from the localhost location. aka in their account name folder
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

		//Then add the new file
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
			sleep(5);
		}
		
		//SIDE NOTE: CANNOT UPLOAD FILES THAT ARE GREATER THAN 2 MB.
		//Would need to change php memory limit >_>
		
		//Store the file into the folder location
		if(empty($error) == true)
		{
			$location = "".$_SESSION['username']."/";
			move_uploaded_file($tempName, $location.$fileName);
		}
		else
		{
			print_r($errors);
		}
		
		//Replace the info in file_format with the new file name
		$inQuery = "UPDATE `song` SET `file_format`='".$fileName."' WHERE `song_id`='".$_GET['songID']."'";
		$runQuery = mysqli_query($db, $inQuery, MYSQLI_STORE_RESULT);
	}

	
}

if(isset($_POST['song']))
{
	if($songname == "")
	{
		//Do nothing
	}
	else
	{
		$inQuery = "UPDATE `song` SET `song_name`='".$songname."' WHERE `song_id`='".$_GET['songID']."'";
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
		$inQuery = "UPDATE `song` SET `song_descrip`='".$song_descrip."' WHERE `song_id`='".$_GET['songID']."'";
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
		$inQuery = "UPDATE `song` SET `genre`='".$genre."' WHERE `song_id`='".$_GET['songID']."'";
		$runQuery = mysqli_query($db, $inQuery, MYSQLI_STORE_RESULT);
	}
	header("Refresh:0");//Refresh the page
}
function displaySong($db)
{
	
	$display = "SELECT `song_name`, `song_descrip`, `file_format`, `genre` FROM `song` WHERE `song_id`='".$_GET['songID']."'";
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
		echo "<br>";
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

<form action="admineditSong.php">
	<input type="submit" value="Cancel edits" style="position:relative;left:0px;top:250px;">
</form>

<form action="" method="post" enctype="multipart/form-data">
	<fieldset>
		Song Name:<br>
		<input type="text" name="song"><br>
		Song Description:<br>
		<input type="text" name="description"><br>
		File:<br>
		<input type="file" name="musicfile"><br>
		Genre:<br>
		<input type="text" name="genre"><br>
		<input type="submit" value="Submit" style="position:relative;left:120px;top:2px;">
	</fieldset>
	
</form>

</body>
</html>