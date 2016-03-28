<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
	include_once("./connect.php");
?>
<?php
//Defining variables set to a default of null
$username = $password = $realname = $country = $birth_date = $userEmail = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = getInput($_POST["user"]);
	$password = getInput($_POST["pw"]);
	$realname = getInput($_POST["realname"]);
	$country = getInput($_POST["country"]);
	$birth_date = getInput($_POST["birthdate"]);
	$userEmail = getInput($_POST["userEmail"]);
	
	//Adding new information for an account
	$newAccountQuery = "INSERT INTO Account (acc_name, password, real_name, country, birth_date, email) VALUES ('" .$username ."', '" . $password ."', '" . $realname . "', '" . $country . "', '" . $birth_date. "', '" . $userEmail . "')";
	$result = mysqli_query($db, $newAccountQuery, MYSQLI_STORE_RESULT);
	
	
	//echo "INSERT INTO Account (acc_name, password, real_name, country, birth_date, email) VALUES ('" .$username ."', '" . $password ."', 'Bob', '', '', 'some email')";

	if($result === false)
	{
		echo "You dun fawked up";
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
<form action="index.php">
	<input type="submit" value="Back to Main" style="position:relative;left:15px;top:281px;">
</form>

<form action="createAccount.php" method="post">
	<fieldset>
		<legend> Create your account </legend>
		Username:<br>
		<input type="text" name="user" required><br>
		Password:<br>
		<input type="password" name="pw" required><br>
		Real name:<br>
		<input type="text" name="realname" required><br>
		Country:<br>
		<input type="text" name="country"><br>
		Date of birth:(day/month/year):<br>
		<input type="text" name="birthdate"><br>
		Email:<br>
		<input type="text" name="userEmail" required><br>
		<input type="submit" value="Submit" style="position:relative;left:120px;top:2px;">
	</fieldset>
	
</form>

</body>
</html>