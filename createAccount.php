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
$username = $password = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = getInput($_POST["user"]);
	$password = getInput($_POST["pw"]);
	
	//Adding new information for an account
	$newAccountQuery = "INSERT INTO Account (acc_name, password, real_name, country, birth_date, email) VALUES ('" .$username ."', '" . $password ."', 'Bob', '', '', 'some email')";
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

<form action="createAccount.php" method="post">
	<fieldset>
		<legend> Create your account </legend>
		Username:<br>
		<input type="text" name="user" required><br>
		Password:<br>
		<input type="password" name="pw" required><br>
		<input type="submit" value="Submit">
	</fieldset>
</form>

</body>
</html>