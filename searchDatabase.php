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

<div class="container">
<ul class="nav nav-pills nav-stacked navbar-right" >
	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">My Account
		<span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li><a target="" href="viewAccount.php">View Account</a></li>
			<li><a target="" href="editAccount.php">Edit Account</a></li>
			<li><a target="" href="createSong.php">Upload a Song</a></li>
			<li><a target="" href="editSong.php">Edit Songs</a></li>
			<li><a target="" href="viewDeleteSong.php">Remove a Song</a></li>
			<li><a target="" href="MyPlayList.php">Edit Playlists</a></li>
			<li><a target="" href="logout.php">Logout</a></li>
		</ul>
	</li>
</ul>
</div>

<form action="searchDatabase.php" method="post" style="position:relative;left:900px;">
	<input type="text" name="search">
	<input type="submit" value="Search">
</form>

<form action="mainPage.php" style="position:relative;top:-50px;">
	<input type="submit" value="Return to Main Page">
</form>

<?php
$searchInput = "%".$_POST['search']."%"; //Search input from the user
searchDB($db, $searchInput);



function searchAccount($db, $searchInput)
{
	//Check if the search matches an artists account name
	$query = "SELECT * FROM `account` WHERE `acc_name` LIKE '".$searchInput."'";
	$result = mysqli_query($db, $query);
	$result = mysqli_fetch_assoc($result);
	
	if($result['acc_name'] == '')
	{
		//Search in the real_name column of account table
		$query = "SELECT * FROM `account` WHERE `real_name` LIKE '".$searchInput."'";
		$result = mysqli_query($db, $query);
		$result = mysqli_fetch_assoc($result);
		
		if($result['real_name'] == '')
		{
			$query = "SELECT * FROM `account` WHERE `country` LIKE '".$searchInput."'";
			$result = mysqli_query($db, $query);
			$result = mysqli_fetch_assoc($result);
			
			if($result['country'] == '')
			{
				$query = "SELECT * FROM `account` WHERE `birth_date` LIKE '".$searchInput."'";
				$result = mysqli_query($db, $query);
				$result = mysqli_fetch_assoc($result);
				
				if($result['birth_date'] == '')
				{
					$query = "SELECT * FROM `account` WHERE `email` LIKE '".$searchInput."'";
					$result = mysqli_query($db, $query);
					$result = mysqli_fetch_assoc($result);
					
					if($result['email'] == '')
					{
						echo "Unable to find specified results. Enter in a different search key";
					}
					else
					{
						findResults($db, 'email', $result);
					}
				}
				else
				{
					findResults($db, 'birth_date', $result);
				}
			}
			else
			{
			
				findResults($db, 'country', $result);
			}
		}
		else
		{
			findResults($db, 'real_name', $result);
		}
	}
	else
	{
		findResults($db, 'acc_name', $result);
	}
}

function findResults($db, $input, $result2)
{
	$query = "SELECT `acc_id`, `acc_name` FROM `account` WHERE ".$input." LIKE '%".$result2["".$input.""]."%'";
	$runQuery = mysqli_query($db, $query);
	$result = mysqli_fetch_assoc($runQuery);
	
	$query = "SELECT `song_id` FROM `upload` WHERE `acc_id`='".$result['acc_id']."'";
	$nameResults = mysqli_query($db, $query); 
	
	while($row = mysqli_fetch_assoc($nameResults))
	{
		$query = "SELECT `song_id`, `song_name`, `song_descrip`, `genre` FROM `song` WHERE `song_id`='".$row['song_id']."'";
		$runQuery = mysqli_query($db, $query);
		
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
			echo "<td>"."<b>Artist:   ".$result['acc_name']. "</b></td>";
			echo "</tr>";
			
			echo "</table>";
			echo "<a href='viewSong.php?songID=".$row2["song_id"]."'style='position:relative;left:280px;top:-50px;font-size:26px;'>Listen</a>";
			echo "<br>";
		}
	}
}

function searchDB($db, $searchInput)
{
	echo "<p style='font-size:24px;color:blue;'>Search results</p>";

	//Check if the search input is empty or not
	if(!($searchInput == "%%"))
	{
		//First search for the song name then the account name
		//Use user input to search for a song name. If it's true, then return the results
		$query = "SELECT * FROM `song` WHERE `song_name` LIKE '".$searchInput."'";
		$result = mysqli_query($db, $query);
		$songResult = mysqli_fetch_assoc($result);
		
		if($songResult['song_name'] == '')
		{
			//Search user input in the genre column
			$query = "SELECT * FROM `song` WHERE `genre` LIKE '".$searchInput."'";
			$result1 = mysqli_query($db, $query);
			$genreresult = mysqli_fetch_assoc($result1);
			
			if($genreresult['genre'] == '')
			{
				searchAccount($db, $searchInput);
			}
			else
			{
				$query = "SELECT `song_id`, `song_name`, `song_descrip`, `genre` FROM `song` WHERE `genre` LIKE '%".$genreresult['genre']."%'";
				$runQuery = mysqli_query($db, $query);
				$result = mysqli_fetch_assoc($runQuery);
				
				//Get the account id from the song id
				$query2 = "SELECT `acc_id` FROM `upload` WHERE `song_id`=".$result['song_id']."";
				$result2 = mysqli_query($db, $query2);
				$accID = mysqli_fetch_assoc($result2);
				
				$query = "SELECT `acc_name` FROM `account` WHERE `acc_id`=".$accID['acc_id']."";
				$nameResults = mysqli_query($db, $query);
				$accName = mysqli_fetch_assoc($nameResults);
				
				$query = "SELECT `song_id`, `song_name`, `song_descrip`, `genre` FROM `song` WHERE `genre` LIKE '".$genreresult['genre']."'";
				$runQuery = mysqli_query($db, $query);
				
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
					echo "<td>"."<b>Artist:   ".$accName["acc_name"]. "</b></td>";
					echo "</tr>";
					
					echo "</table>";
					echo "<a href='viewSong.php?songID=".$row2["song_id"]."'style='position:relative;left:280px;top:-50px;font-size:26px;'>Listen</a>";
					echo "<br>";
				}
			}
			
		}
		else
		{
			
		
			$query = "SELECT `song_id`, `song_name`, `song_descrip`, `genre` FROM `song` WHERE `song_name` LIKE '".$songResult['song_name']."'";
			$runQuery = mysqli_query($db, $query);
			$result = $runQuery;
			
			//Get the account id from the song id
			$searchResult= mysqli_fetch_assoc($result);
			
			$query2 = "SELECT `acc_id` FROM `upload` WHERE `song_id`=".$searchResult['song_id']."";
			$result2 = mysqli_query($db, $query2);
			$accID = mysqli_fetch_assoc($result2);
			
			$query = "SELECT `acc_name` FROM `account` WHERE `acc_id`=".$accID['acc_id']."";
			$nameResults = mysqli_query($db, $query);
			$accName = mysqli_fetch_assoc($nameResults);
			
			$query = "SELECT `song_id`, `song_name`, `song_descrip`, `genre` FROM `song` WHERE `song_name` LIKE '".$songResult['song_name']."'";
			$runQuery = mysqli_query($db, $query);
			
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
				echo "<td>"."<b>Artist:   ".$accName["acc_name"]. "</b></td>";
				echo "</tr>";
				
				echo "</table>";
				echo "<a href='viewSong.php?songID=".$row2["song_id"]."'style='position:relative;left:280px;top:-50px;font-size:26px;'>Listen</a>";
				echo "<br>";
			}
		}
	}
	else
	{
		echo "Please type in something to search";
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
