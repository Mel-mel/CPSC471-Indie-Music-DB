<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="styles.css">
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

<h1> WELCOME TO THE INDIE MUSIC DATABASE! </h1>

<form action="mainPage.php" method="post">
	<fieldset>
		<font size="6"><legend> Login into your account </legend></font>
		Username:<br>
		<input type="test" name="user"><br>
		Password:<br>
		<input type="password" name="pw"><br>
		<input type="submit" value="SOMETHING DIFFERENT ON THE MAIN PAGE" style="position:relative;left:120px;top:2px;">
	</fieldset>
</form>

<h2> OR </h2>

<form action="http://localhost/indiemusicdb/createAccount.php">
	<input type="submit" value="Create an account" style="position:relative;left:5px;top:-5px;font-size:20px">
</form>



<!--title will show up when you mouse over the text in that paragraph -->
<p title ="Random stuff"> My first paragraph </p>
<p><b>Just another random sentence that's bolded</b></p>




</body>
</html>
<!--Search up website layout for html for some basic layouts -->