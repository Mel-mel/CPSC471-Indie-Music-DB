<?php
	include_once("./connect.php");
?>
<!DOCTYPE html>
<html>
	<head>
	<!--This is to have that pill design-->
	<title>Bootstrap Case</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="pageMainStyles.css">
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
//This is to insert an admin 
//INSERT INTO `administrator`(`acc_id`, `acc_name`, `password`, `real_name`, `country`, `birth_date`, `email`) VALUES (12,'admin', 111,'administrator','unknown','unknown','admin@music.com')
?>

<font size="16"><p><b>Administrator</b></p></font>

<div class="container">
<ul class="nav nav-pills nav-stacked navbar-right" >
	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">My Account
		<span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li><a target="" href="adminviewAccount.php">View Account</a></li>
			<li><a target="" href="admineditAccount.php">Edit Account</a></li>
			<li><a target="" href="adminCreateSong.php">Upload a Song</a></li>
			<li><a target="" href="admineditSong.php">Edit Songs</a></li>
			<li><a target="" href="adminviewDeleteSong.php">Remove a Song</a></li>
			<li><a target="" href="adminMyPlayList.php">Edit Playlists</a></li>
			<li><a target="" href="viewDeleteAccount.php">Remove an account</a></li>
			<li><a target="" href="logout.php">Logout</a></li>
		</ul>
	</li>
</ul>
</div>

<a href="adminshowAllSongs.php" style="font-size: 30px;position:relative;left:280px;top:-50px;">View All Songs</a>

<?php
displayBestSongs($db);
displayNewestSongs($db);

function displayNewestSongs($db)
{
	echo "<p id='p2' >Newest Songs</p>";
	
	
	//Get the order of the songs based on totalrating
	$query = "SELECT `totalRating`, `song_id` FROM `rate_out_of_five` ORDER BY totalRating ASC";
	$result = mysqli_query($db, $query);
	
	while($row = mysqli_fetch_assoc($result))
	{
		if($row['totalRating'] < 5)
		{
			//Get list of all song ids
			$query1 = "SELECT `song_id`, `acc_id` FROM `upload` WHERE `song_id`='".$row['song_id']."'";
			$result1 = mysqli_query($db, $query1);
			
			while($row1 = mysqli_fetch_assoc($result1))
			{
				//Get the name of the artist for each song
				$accQuery = "SELECT `acc_name` FROM `account` WHERE `acc_id`='".$row1['acc_id']."'";
				$accResult = mysqli_query($db, $accQuery);
				$accID = mysqli_fetch_assoc($accResult);
			
				//Display the song information based on descending order
				$inQuery = "SELECT `song_name`, `song_descrip`, `file_format`, `genre` FROM `song` WHERE `song_id`='".$row['song_id']."'";
				$runQuery = mysqli_query($db, $inQuery);
			
				while($row2 = mysqli_fetch_assoc($runQuery))
				{
					echo "<table id='t2' border='1'>";
					echo "<tr>";
					echo "<td>"."Song name:   <b>".$row2["song_name"]. "</b></td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>"."Genre:   ".$row2["genre"]. "</td>";
					echo "</tr>";	
					echo "<tr>";
					echo "<td>"."<b>Artist:   ".$accID["acc_name"]. "</b></td>";
					echo "</tr>";
					
					echo "</table>";
					echo "<a href='viewSong.php?songID=".$row["song_id"]."' id='listen2'>Listen</a>";
					echo "<br>";
				}
			}
		}
		
		else
		{
			//Don't display current song since it's not the newest anymore
		}
	}
	
}


function displayBestSongs($db)
{
	echo "<p style='font-size:24px;color:purple;'>Best rated songs</p>";

	//Get the order of the songs based on highest 5 star rating
	$query = "SELECT `5star`, `song_id` FROM `rate_out_of_five` ORDER BY 5star DESC";
	$result = mysqli_query($db, $query);
	
	while($row = mysqli_fetch_assoc($result))
	{
		//Get list of all song ids
		$query = "SELECT `song_id`, `acc_id` FROM `upload`";
		$result = mysqli_query($db, $query);
		
		while($row1 = mysqli_fetch_assoc($result))
		{
			//Get the name of the artist for each song
			$accQuery = "SELECT `acc_name` FROM `account` WHERE `acc_id`='".$row1['acc_id']."'";
			$accResult = mysqli_query($db, $accQuery);
			$accID = mysqli_fetch_assoc($accResult);
		
			//Display the song information based on descending order
			$inQuery = "SELECT `song_name`, `song_descrip`, `file_format`, `genre` FROM `song` WHERE `song_id`='".$row1['song_id']."'";
			$runQuery = mysqli_query($db, $inQuery);
		
			while($row2 = mysqli_fetch_assoc($runQuery))
			{
				echo "<table border='1'style='width:15%'>";
				echo "<tr>";
				echo "<td>"."Song name:   <b>".$row2["song_name"]. "</b></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>"."Genre:   ".$row2["genre"]. "</td>";
				echo "</tr>";	
				echo "<tr>";
				echo "<td>"."<b>Artist:   ".$accID["acc_name"]. "</b></td>";
				echo "</tr>";
				
				echo "</table>";
				echo "<a href='viewSong.php?songID=".$row["song_id"]."'style='position:relative;left:280px;top:-50px;font-size:26px;'>Listen</a>";
				echo "<br>";
			}
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
</body>
</html>
