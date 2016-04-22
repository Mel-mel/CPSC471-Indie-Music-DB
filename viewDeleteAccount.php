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

//Display all accounts in database. Display their account name, real name and email.
$inQuery = "SELECT `acc_id`, `acc_name`, `real_name`, `country`, `birth_date`,`email` FROM `account`";
	$runQuery = mysqli_query($db, $inQuery);
	
	$adminTable = "SELECT `acc_id` FROM `administrator`";
	$result = mysqli_query($db, $adminTable);
	$adminID = mysqli_fetch_assoc($result);
	while($row = mysqli_fetch_assoc($runQuery))
	{
		//Remove the admin from being displayed in the delete list.
		if($row["acc_id"] == $adminID["acc_id"])
		{
			continue;
		}
		else
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
			echo "<a href='deleteAccount.php?userID=".$row["acc_id"]."'>Delete account</a>";
			echo "<br>";
			echo "<br>";
		}
		
	}
	
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

?>

<form action="adminMainPage.php">
	<input type="submit" value="Go back to main" style="position:relative;left:0px;top:240px;font-size:20px">
</form>

</body>
</html>