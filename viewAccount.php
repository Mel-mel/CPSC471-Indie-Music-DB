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
if(isset($_POST['']))
{
	//echo "inside the if";
	viewContent($db);
}

function viewContent($db)
{
	$inQuery = "SELECT `acc_name`, `real_name`, `country`, `birth_date`, `email` FROM `account` WHERE (`acc_name`
	
	"SELECT `acc_name`, `password` FROM `account` WHERE (`acc_name`='" .$username. "' AND `password`='" .$password ."')";
}
?>




<form action="mainPage.php">
	<input type="submit" value="Back to Main" style="position:relative;left:15px;top:281px;">
</form>
<!--title will show up when you mouse over the text in that paragraph -->
<p title ="Random stuff"> My first paragraph </p>
<p><b>Just another random sentence that's bolded</b></p>


</body>
</html>