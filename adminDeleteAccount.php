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

viewContent($db);

function viewContent($db)
{
	$inQuery = "DELETE `acc_name`, `real_name`, `country`, `birth_date`, `email` FROM `account` WHERE (`acc_name`='" .$_SESSION["username"]. "' AND `password`='" .$_SESSION["password"] ."' AND `acc_id`='".$_SESSION["accountID"]."')";
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
?>

<form action="adminMainPage.php">
	<input type="submit" value="Back to Main" style="position:relative;left:0px;top:50px;">
</form>
<!--title will show up when you mouse over the text in that paragraph 
<p title ="Random stuff"> My first paragraph </p>
<p><b>Just another random sentence that's bolded</b></p>-->


</body>
</html>