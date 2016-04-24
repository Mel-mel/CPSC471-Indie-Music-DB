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
$accname = $realname = $countryname = $birth = $email = "";

viewContent($db);

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$accname = getInput($_POST["name"]);
	$realname = getInput($_POST["real"]);
	$countryname = getInput($_POST["origin"]);
	$birth = getInput($_POST["birth"]);
	$email = getInput($_POST["newEmail"]);
	
}
if(isset($_POST['name']))
{
	editAccountName($db, $accname);
	header("Refresh:0");//Refresh the page
}
if(isset($_POST['real']))
{
	editRealName($db, $realname);
	header("Refresh:0");//Refresh the page
}
if(isset($_POST['origin']))
{
	editCountry($db, $countryname);
	header("Refresh:0");//Refresh the page
}
if(isset($_POST['birth']))
{
	editBirth($db, $birth);
	header("Refresh:0");//Refresh the page
}
if(isset($_POST['newEmail']))
{
	editEmail($db, $email);
	header("Refresh:0");//Refresh the page
}
function viewContent($db)
{
	$inQuery = "SELECT `acc_name`, `real_name`, `country`, `birth_date`, `email` FROM `account` WHERE (`acc_name`='" .$_SESSION["username"]. "' AND `password`='" .$_SESSION["password"] ."' AND `acc_id`='".$_SESSION["accountID"]."')";
	$runQuery = mysqli_query($db, $inQuery);
	
	while($row = mysqli_fetch_assoc($runQuery))
	{
		echo "<table border='1'style='width:50%'>";
		echo "<tr>";
		echo "<th>Account name:</th>";
		echo "<td>".$row["acc_name"]. "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>"."Real name:"."</th>";
		echo "<td>".$row["real_name"]. "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>"."Country of Origin:"."</th>";
		echo "<td>".$row["country"]. "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>"."Date of Birth:"."</th>";
		echo "<td>".$row["birth_date"]. "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>"."Email:"."</th>";
		echo "<td>".$row["email"]. "</td>";
		echo "</tr>";	
		echo "</table>";
		//echo .$row["real_name"]. $row["country"] . $row["birth_date"] . $row["email"];
	}
	
}

function editAccountName($db, $accname)
{
	if($accname == "")
	{
		//Do nothing
	}
	else
	{
		$inQuery = "UPDATE `account` SET `acc_name`='".$accname."' WHERE `acc_id`='".$_SESSION['accountID']."'";
		$runQuery = mysqli_query($db, $inQuery, MYSQLI_STORE_RESULT);
	}
	
}
function editRealName($db, $realname)
{
	if($realname == "")
	{
		//Do nothing
	}
	else
	{
		$inQuery = "UPDATE `account` SET `real_name`='".$realname."' WHERE `acc_id`='".$_SESSION['accountID']."'";
		$runQuery = mysqli_query($db, $inQuery, MYSQLI_STORE_RESULT);
	}
	
}
function editCountry($db, $countryname)
{
	if($countryname == "")
	{
		//Do nothing
	}
	else
	{
		$inQuery = "UPDATE `account` SET `country`='".$countryname."' WHERE `acc_id`='".$_SESSION['accountID']."'";
		$runQuery = mysqli_query($db, $inQuery, MYSQLI_STORE_RESULT);
	}
	
}
function editBirth($db, $birth)
{
	if($birth == "")
	{
		//Do nothing
	}
	else
	{
		$inQuery = "UPDATE `account` SET `birth_date`='".$birth."' WHERE `acc_id`='".$_SESSION['accountID']."'";
		$runQuery = mysqli_query($db, $inQuery, MYSQLI_STORE_RESULT);
	}
	
}
function editEmail($db, $email)
{
	if($email == "")
	{
		//Do nothing
	}
	else
	{
		$inQuery = "UPDATE `account` SET `email`='".$email."' WHERE `acc_id`='".$_SESSION['accountID']."'";
		$runQuery = mysqli_query($db, $inQuery, MYSQLI_STORE_RESULT);
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



<form action="adminMainPage.php">
	<input type="submit" value="Cancel edits" style="position:relative;left:0px;top:240px;">
</form>

<form action="" method="post">
	Account name:<br>
	<input type="text" name="name"><br>
	Real name:<br>
	<input type="text" name="real"><br>
	Country of Origin:<br>
	<input type="text" name="origin"><br>
	Date of Birth:<br>
	<input type="text" name="birth"><br>
	Email:<br>
	<input type="text" name="newEmail"><br>
	<input type="submit" value="Save edits" style="position:relative;left:120px;top:25px;">
</form>

<!--title will show up when you mouse over the text in that paragraph 
<p title ="Random stuff"> My first paragraph </p>
<p><b>Just another random sentence that's bolded</b></p>-->


</body>
</html>