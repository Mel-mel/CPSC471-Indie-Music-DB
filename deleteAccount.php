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
		$query = "DELETE FROM `account` WHERE `acc_id`='".$_GET['userID']."'" ;
		$removeQuery = mysqli_query($db, $query, MYSQLI_STORE_RESULT);
		echo "<br clear='left'/>";
		echo "<font size='20'><p>Account removed</p></font>";
		echo "<table border='1'style='width:90%'>";
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
		echo "<table border='1'style='width:90%'>";
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
	<input type="submit" value="Go back to main" style="position:relative;left:0px;top:240px;font-size:20px">
</form>

<form action="" method="post">
	<p>Are you sure you want to remove this account?</p>
	<input type="submit" name="yes" value="Yes">
	<input type="submit" name="no" value="No">
</form>




</body>
</html>