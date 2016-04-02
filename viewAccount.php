<?php
	include_once("./connect.php");
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="styles.css">
	</head>
<body>

<?php

viewContent($db);

function viewContent($db)
{
	$inQuery = "SELECT `acc_name`, `real_name`, `country`, `birth_date`, `email` FROM `account` WHERE (`acc_name`='" .$_SESSION["username"]. "' AND `password`='" .$_SESSION["password"] ."' AND `acc_id`='".$_SESSION["accountID"]."')";
	$runQuery = mysqli_query($db, $inQuery);
	
	while($row = mysqli_fetch_assoc($runQuery))
	{
		echo $row["acc_name"].$row["real_name"]. $row["country"] . $row["birth_date"] . $row["email"];
	}
	
}
?>

<form action="" method="post">
	<input type="text" value="View stuff">
</form>


<form action="mainPage.php">
	<input type="submit" value="Back to Main" style="position:relative;left:15px;top:281px;">
</form>
<!--title will show up when you mouse over the text in that paragraph -->
<p title ="Random stuff"> My first paragraph </p>
<p><b>Just another random sentence that's bolded</b></p>


</body>
</html>