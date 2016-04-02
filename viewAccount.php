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
		echo "<table border='1'style='width:35%'>";
		echo "<tr>";
		echo "<td>"."Account name:   ".$row["acc_name"]. "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>"."Real name:   ".$row["real_name"]. "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>"."Country of Origin:   ".$row["country"]. "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>"."Date of Birth:   ".$row["birth_date"]. "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>"."Email:   ".$row["email"]. "</td>";
		echo "</tr>";	
		echo "</table>";
		//echo .$row["real_name"]. $row["country"] . $row["birth_date"] . $row["email"];
	}
	
}
?>

<form action="mainPage.php">
	<input type="submit" value="Back to Main" style="position:relative;left:0px;top:50px;">
</form>
<!--title will show up when you mouse over the text in that paragraph 
<p title ="Random stuff"> My first paragraph </p>
<p><b>Just another random sentence that's bolded</b></p>-->


</body>
</html>