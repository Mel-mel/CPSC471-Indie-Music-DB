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
	

}

function getInput($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>

<form action="loginPage.php" method="post">
	<fieldset>
		<legend> Login into your account </legend>
		Username:<br>
		<input type="test" name="user"><br>
		Password:<br>
		<input type="password" name="pw"><br>
		<input type="submit" value="Submit">
	</fieldset>
</form>

	

</body>
</html>