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
$songname = "";

//Setting variables to integers
settype($count, "integer");
settype($totalrating, "integer");
$count = 1;

displaySong($db);

//If the user selected a 1 star rating, calculate new value and store it
if(isset($_POST['1star']))
{
	//Get value of rating and update it
	$query = "SELECT sum(1star) as c1 FROM `rate_out_of_five` WHERE `song_id`='".$_GET['songID']."'";
	$result = mysqli_query($db, $query);
	$value = mysqli_fetch_assoc($result);
	
	$total = $value['c1'] + $count;
	echo $total;
	//Store updated value back into the rate out of five table
	$query = "UPDATE `rate_out_of_five` SET `1star`=".$total." WHERE `song_id`='".$_GET['songID']."'";
	$result = mysqli_query($db, $query, MYSQLI_STORE_RESULT);
	
	calcTotal($db);
}

//If the user selected a 2 star rating, calculate new value and store it
if(isset($_POST['2star']))
{
	//Get value of rating and update it
	$query = "SELECT sum(2star) as c2 FROM `rate_out_of_five` WHERE `song_id`='".$_GET['songID']."'";
	$result = mysqli_query($db, $query);
	$value = mysqli_fetch_assoc($result);
	
	$total = $value['c2'] + $count;
	
	//Store updated value back into the rate out of five table
	$query = "UPDATE `rate_out_of_five` SET `2star`=".$total." WHERE `song_id`='".$_GET['songID']."'";
	$result = mysqli_query($db, $query, MYSQLI_STORE_RESULT);
	
	calcTotal($db);
}

//If the user selected a 3 star rating, calculate new value and store it
if(isset($_POST['3star']))
{
	//Get value of rating and update it
	$query = "SELECT sum(3star) as c3 FROM `rate_out_of_five` WHERE `song_id`='".$_GET['songID']."'";
	$result = mysqli_query($db, $query);
	$value = mysqli_fetch_assoc($result);
	
	$total = $value['c3'] + $count;
	
	//Store updated value back into the rate out of five table
	$query = "UPDATE `rate_out_of_five` SET `3star`=".$total." WHERE `song_id`='".$_GET['songID']."'";
	$result = mysqli_query($db, $query, MYSQLI_STORE_RESULT);
	
	calcTotal($db);
}

//If the user selected a 4 star rating, calculate new value and store it
if(isset($_POST['4star']))
{
	//Get value of rating and update it
	$query = "SELECT sum(4star) as c4 FROM `rate_out_of_five` WHERE `song_id`='".$_GET['songID']."'";
	$result = mysqli_query($db, $query);
	$value = mysqli_fetch_assoc($result);
	
	$total = $value['c4'] + $count;
	
	//Store updated value back into the rate out of five table
	$query = "UPDATE `rate_out_of_five` SET `4star`=".$total." WHERE `song_id`='".$_GET['songID']."'";
	$result = mysqli_query($db, $query, MYSQLI_STORE_RESULT);
	
	calcTotal($db);
}

//If the user selected a 5 star rating, calculate new value and store it
if(isset($_POST['5star']))
{
	//Get value of rating and update it
	$query = "SELECT sum(5star) as c5 FROM `rate_out_of_five` WHERE `song_id`='".$_GET['songID']."'";
	$result = mysqli_query($db, $query);
	$value = mysqli_fetch_assoc($result);
	
	$total = $value['c5'] + $count;
	
	//Store updated value back into the rate out of five table
	$query = "UPDATE `rate_out_of_five` SET `5star`=".$total." WHERE `song_id`='".$_GET['songID']."'";
	$result = mysqli_query($db, $query, MYSQLI_STORE_RESULT);
	
	calcTotal($db);
}

function calcTotal($db)
{
	//Calculate total rating after updating the individual ratings from above
	$onestar = "SELECT sum(1star) as c1 FROM `rate_out_of_five` WHERE `song_id`='".$_GET['songID']."'";
	$twostar = "SELECT sum(2star) as c2 FROM `rate_out_of_five` WHERE `song_id`='".$_GET['songID']."'";
	$threestar = "SELECT sum(3star) as c3 FROM `rate_out_of_five` WHERE `song_id`='".$_GET['songID']."'";
	$fourstar = "SELECT sum(4star) as c4 FROM `rate_out_of_five` WHERE `song_id`='".$_GET['songID']."'";
	$fivestar = "SELECT sum(5star) as c5 FROM `rate_out_of_five` WHERE `song_id`='".$_GET['songID']."'";

	$r1 = mysqli_query($db, $onestar);
	$r2 = mysqli_query($db, $twostar);
	$r3 = mysqli_query($db, $threestar);
	$r4 = mysqli_query($db, $fourstar);
	$r5 = mysqli_query($db, $fivestar);

	$result1 = mysqli_fetch_assoc($r1);
	$result2 = mysqli_fetch_assoc($r2);
	$result3 = mysqli_fetch_assoc($r3);
	$result4 = mysqli_fetch_assoc($r4);
	$result5 = mysqli_fetch_assoc($r5);

	//Add up the total rating and store it
	$totalrating = $result1['c1'] + $result2['c2'] + $result3['c3'] + $result4['c4'] + $result5['c5'];
	
	$query = "UPDATE `rate_out_of_five` SET `totalRating`=".$totalrating." WHERE `song_id`='".$_GET['songID']."'";
	$result = mysqli_query($db, $query, MYSQLI_STORE_RESULT);
}


function displaySong($db)
{

	//Get acc_id from the given song_id
	$songQuery = "SELECT `acc_id` FROM `upload` WHERE `song_id`='".$_GET['songID']."'";
	$songResult = mysqli_query($db, $songQuery);
	$accID = mysqli_fetch_assoc($songResult);
	
	$query = "SELECT `acc_name` FROM `account` WHERE `acc_id`='".$accID['acc_id']."'";
	$result = mysqli_query($db, $query);
	$accName = mysqli_fetch_assoc($result);
	
	$inQuery = "SELECT `song_name`, `song_descrip`, `file_format`, `genre` FROM `song` WHERE `song_id`='".$_GET["songID"]."'";
	$runQuery = mysqli_query($db, $inQuery);
	
	
	while($row = mysqli_fetch_assoc($runQuery))
	{
		echo "<table style='width:15%;position:relative;top:150px'>";
		echo "<tr>";
		echo "<td>"."Song name:   <b>".$row["song_name"]. "</b></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>"."Artist:   <b>".$accName["acc_name"]. "</b></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>"."Description:   ".$row["song_descrip"]. "</td>";
		echo "</tr>";
		echo "</table>";
		$songname = $row['file_format'];
	}
	
	//Fetch the location of the song from the user file
	$path = "".$accName['acc_name']."/".$songname."";
	
	//Get the file extension for the audio to be able to play it
	$file_ext = substr($songname, -3);
	
	//Return button to the list of songs
	echo "
		<form action='adminshowAllSongs.php'>
		<input type='submit' value='Back to Main' style='position:relative;left:0px;top:200px;'>
		</form>
	";
	
	//Force download of the file
	echo "<a href='downloadSong.php?songID=".$_GET['songID']."' style='position:relative;left:300px;top:80px;'>Download Song</a>";
	
	//Play the audio file on website
	echo "<audio controls style='position:relative;top:-20px;'>";
	echo "<source src='".$path."' type='audio/".$file_ext."'>" ;
	echo "</audio>";
	
	//Show total ratings?
}


?>

<form action="" method='post' style='position:relative;left:300px;'>
	<input type='radio' name='1star' > 1 Star
	<input type='radio' name='2star' > 2 Star
	<input type='radio' name='3star' > 3 Star
	<input type='radio' name='4star' > 4 Star
	<input type='radio' name='5star' > 5 Star
	<input type='submit' value='Rate it!'> 
</form>




</body>
</html>