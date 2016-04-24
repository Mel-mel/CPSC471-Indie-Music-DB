<?php
	include_once("./connect.php");
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="styles.css">
	</head>
<body>

<script>
function goMainPage()
{
	window.location.assign("mainPage.php");
}
</script>

<?php
//Defining variables set to a default of null
$username = $password = "";



if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = getInput($_POST["user"]);
	$password = getInput($_POST["pw"]);
	
}

if(isset($_POST['loginAttempt']))
{
	//echo "inside the if";
	if($username == "admin")
	{
		checkAdminInfo($db, $username, $password);
	}
	else
	{
		checkUserLoginInfo($db, $username, $password);
	}
	
}

//Check if the user who isn't the admin has the right username and password
function checkUserLoginInfo($db, $username, $password)
{
	//Fetch the account ID for the user in the current session
	$userID = "SELECT `acc_id` FROM `account` WHERE(`acc_name`='" .$username. "')";
	$id = mysqli_query($db, $userID);
	$accID = mysqli_fetch_assoc($id);
	
	// Set session variables
	$_SESSION["accountID"] = $accID["acc_id"];
	$_SESSION["username"] = "".$username."";
	$_SESSION["password"] = "".$password."";
	
	//Check if the entered info is correct
	$inQuery = "SELECT `acc_name`, `password` FROM `account` WHERE (`acc_name`='" .$username. "' AND `password`='" .$password ."')";
	
	$runQuery = mysqli_query($db, $inQuery);
	
	if(mysqli_num_rows($runQuery) == false)
	{
		//Window.alert("<p style="."position:relative;left:250px;top:250px;"."> Invalid username or password</p>");
		echo "<p style="."position:relative;left:250px;top:250px;"."> Invalid username or password</p>";
		
	}
	else
	{
		//Goes to the next page.
		header("Location: mainPage.php");
		
	}
}

//Check if the user is an admin
function checkAdminInfo($db, $username, $password)
{
	//Fetch the account ID for the user in the current session
	$userID = "SELECT `acc_id` FROM `administrator` WHERE(`acc_name`='" .$username. "')";
	$id = mysqli_query($db, $userID);
	$accID = mysqli_fetch_assoc($id);
	
	// Set session variables
	$_SESSION["accountID"] = $accID["acc_id"];
	$_SESSION["username"] = "".$username."";
	$_SESSION["password"] = "".$password."";
	
	//Check if the entered info is correct
	$inQuery = "SELECT `acc_name`, `password` FROM `administrator` WHERE (`acc_name`='" .$username. "' AND `password`='" .$password ."')";
	
	$runQuery = mysqli_query($db, $inQuery);
	
	if(mysqli_num_rows($runQuery) == false)
	{
		//Window.alert("<p style="."position:relative;left:250px;top:250px;"."> Invalid username or password</p>");
		echo "<p style="."position:relative;left:250px;top:250px;"."> Invalid username or password</p>";
		
	}
	else
	{
		//Goes to the next page.
		header("Location: adminMainPage.php");
		
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

<h1> WELCOME TO THE INDIE MUSIC DATABASE! </h1>

<form action="" method="post">
	<fieldset>
		<font size="6"><legend> Login into your account </legend></font>
		Username:<br>
		<input type="text" name="user"><br>
		Password:<br>
		<input type="password" name="pw"><br>
		<input type="submit" name="loginAttempt" value="Login" style="position:relative;left:120px;top:2px;">
	</fieldset>
</form>

<h2> OR </h2>

<form action="http://localhost/indiemusicdb/createAccount.php">
	<input type="submit" value="Create an account" style="position:relative;left:5px;top:-5px;font-size:20px">
</form>

<h3> OR </h3>

<a href="noAccountAllSongs.php" style="font-size:30px"> View all Songs without an account </a><br>

<img src="images/cool treble clef.jpg" style="width:236px;height:333px;">


</body>
</html>
<!--Search up website layout for html for some basic layouts -->