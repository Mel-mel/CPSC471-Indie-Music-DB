<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="styles.css">
	</head>
<body>

<?php
session_start();
session_destroy();
echo "<font size='16'>You have been logged out.<br></font>" ."<a href='loginPage.php'><font size='12'>Return to Login Page</font></a>";
?>

</body>
</html>