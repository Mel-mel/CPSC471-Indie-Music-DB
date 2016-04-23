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
//Defining variables set to a default of null
$username = $password = "";
	
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	
	$username = getInput($_POST["user"]);
	$password = getInput($_POST["pw"]);
	

	
	
}
function getInput($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

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
			<li><a target="" href="viewDeleteAccount.php">Remove an account</a></li>
			<li><a target="" href="logout.php">Logout</a></li>
		</ul>
	</li>
</ul>
</div>

<a href="adminshowAllSongs.php" style="font-size: 30px;">View All Songs</a>




<!--
<table style="width:100%">
  <caption>Monthly savings</caption>
  <tr>
    <th>Month</th>
    <th>Savings</th>
  </tr>
  <tr>
    <td>January</td>
    <td>$100</td>
  </tr>
  <tr>
    <td>February</td>
    <td>$50</td>
  </tr>
</table>

<!--title will show up when you mouse over the text in that paragraph -->
<p title ="Random stuff"> My first paragraph </p>
<p><b>Just another random sentence that's bolded</b></p>




</body>
</html>

<!--Search up website layout for html for some basic layouts -->