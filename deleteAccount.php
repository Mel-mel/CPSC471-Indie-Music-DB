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
		//Delete folder containing user's music filesize
		//First get the file name and append it to it's containing folder
		
		//Get list of songs from upload
		$list = "SELECT `song_id` FROM `upload` WHERE `acc_id`='".$_GET['userID']."'";
		$listresult = mysqli_query($db, $list);
		
		$user = "SELECT `acc_name` FROM `account` WHERE `acc_id`='".$_GET['userID']."'";
		$name = mysqli_query($db, $user);
		$username = mysqli_fetch_assoc($name);
		
		while($row = mysqli_fetch_assoc($listresult))
		{
			$query = "SELECT `file_format` FROM `song` WHERE `song_id`='".$row['song_id']."'";
			$result = mysqli_query($db, $query);
			$fileName = mysqli_fetch_assoc($result);
			$filePath = "".$username['acc_name']."/".$fileName['file_format'];
		
			//Next, remove the file from that file path
			if(unlink($filePath))
			{
				echo "Song successfully removed";
			}
			else
			{
				echo "Error, unable to remove song";
			}
			
		}
		$user = "SELECT `acc_name` FROM `account` WHERE `acc_id`='".$_GET['userID']."'";
		$name = mysqli_query($db, $user);
		$username = mysqli_fetch_assoc($name);
		//Remove the directory belonging to the user
		rmdir("'".$username['acc_name']."'");
		
		
	
		//Get all songs related to the deleted user
		$songquery = "SELECT `song_id` FROM `upload` WHERE `acc_id`='".$_GET['userID']."'";
		$songResult = mysqli_query($db, $songquery);
		
		$playquery = "SELECT `playlist_id` FROM `playlist` WHERE `acc_id`='".$_GET['userID']."'";
		$playResult = mysqli_query($db, $playquery);
		
		while($row = mysqli_fetch_assoc($playResult))
		{
			//Remove song_id reference in createplaylist so that the playlists related to user can be deleted
			while($row1 = mysqli_fetch_assoc($songResult))
			{
				//Delete all referenced songs from createplaylist
				$query = "DELETE FROM `createplaylist` WHERE `playlist_id`='".$row['playlist_id']."' AND `song_id`='".$row1['song_id']."'";
				$removedResult = mysqli_query($db, $query, MYSQLI_STORE_RESULT);
				
				$query = "DELETE FROM `playlist` WHERE `acc_id`='".$_GET['userID']."'";
				$removedResult = mysqli_query($db, $query, MYSQLI_STORE_RESULT);
				
				if($removedResult === false)
				{
					echo "nafga";
				}
			}
		}
		
		
		//Delete playlists related to deleted user
		$playquery = "DELETE FROM `playlist` WHERE `acc_id`='".$_GET['userID']."'";
		$playResult = mysqli_query($db, $playquery, MYSQLI_STORE_RESULT);
		echo "All playlists removed";
		
		$songquery = "SELECT `song_id` FROM `upload` WHERE `acc_id`='".$_GET['userID']."'";
		$songResult = mysqli_query($db, $songquery);
		while($row1 = mysqli_fetch_assoc($songResult))
		{
		echo $row1['song_id'];
			//Delete any ratings from songs from deleted user
			$ratequery = "DELETE FROM `rate_out_of_five` WHERE `acc_id`='".$_GET['userID']."'AND `song_id`='".$row1['song_id']."'";
			$rateResult = mysqli_query($db, $ratequery, MYSQLI_STORE_RESULT);
			echo "FGFDG";
		}
		echo "All ratings removed";
		
		//Delete all songs related to the delete user, starting with upload
		$query = "DELETE FROM `upload` WHERE `acc_id`='".$_GET['userID']."'";
		$removeQuery = mysqli_query($db, $query, MYSQLI_STORE_RESULT);
		
		while($row2 = mysqli_fetch_assoc($songResult))
		{
			//Next delete the songs themselves from the table song
			$songtable = "DELETE FROM `song` WHERE `song_id`='".$row2['song_id']."'";
			$result = mysqli_query($db, $songtable, MYSQLI_STORE_RESULT);
		}
		echo "All songs removed";
		
		//Finally, delete the user from the account table 
		$query = "DELETE FROM `account` WHERE `acc_id`='".$_GET['userID']."'" ;
		$removeQuery = mysqli_query($db, $query, MYSQLI_STORE_RESULT);
		echo "<br clear='left'/>";
		echo "<font size='20'><p>Account removed</p></font>";
		echo "<table border='1'style='width:40%'>";
		echo "<tr>";
		echo "<th>Account name</th>";
		echo "<th>"."Real name"."</th>";
		echo "<th>"."Country of Origin"."</th>";
		echo "<th>"."Date of Birth"."</th>";
		echo "<th>"."Email"."</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td> </td>";
		echo "<td> </td>";
		echo "<td> </td>";
		echo "<td> </td>";
		echo "<td> </td>";
		echo "</tr>";
		echo "</table>";
		
		
		
	}
	else
	{
		header("Location: viewDeleteAccount.php");
	}
	//$username = getInput($_POST["user"]);
	//$password = getInput($_POST["pw"]);
	

}


function viewList($db)
{
	//Display all accounts in database. Display their account name, real name and email.
	//$_GET['userID'] gets it from viewDeleteAccount.php 
	$inQuery = "SELECT `acc_id`, `acc_name`, `real_name`, `country`, `birth_date`,`email` FROM `account` WHERE `acc_id`='".$_GET['userID']."'" ;
	$runQuery = mysqli_query($db, $inQuery);
	
	
	while($row = mysqli_fetch_assoc($runQuery))
	{
		echo "<table border='1'style='width:40%'>";
		echo "<tr>";
		echo "<th>Account name</th>";
		echo "<th>"."Real name"."</th>";
		echo "<th>"."Country of Origin"."</th>";
		echo "<th>"."Date of Birth"."</th>";
		echo "<th>"."Email"."</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>".$row["acc_name"]. "</td>";
		echo "<td>".$row["real_name"]. "</td>";
		echo "<td>".$row["country"]. "</td>";
		echo "<td>".$row["birth_date"]. "</td>";
		echo "<td>".$row["email"]. "</td>";
		echo "</tr>";
		echo "</table>";
		//echo "<a href='deleteAccount.php'>Delete account</a>";
		echo "<br>";
		//echo .$row["real_name"]. $row["country"] . $row["birth_date"] . $row["email"];
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

<form action="viewDeleteAccount.php">
	<input type="submit" value="Go back" style="position:relative;left:0px;top:240px;font-size:20px">
</form>

<form action="" method="post">
	<p>Are you sure you want to remove this account?</p>
	<input type="submit" name="yes" value="Yes">
	<input type="submit" name="no" value="No">
</form>




</body>
</html>