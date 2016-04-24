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

//Get the file name using the song id
$inQuery = "SELECT `file_format` FROM `song` WHERE `song_id`='".$_GET["songID"]."'";
$runQuery = mysqli_query($db, $inQuery);
$fileformat = mysqli_fetch_assoc($runQuery);

//Get the extension of the file
$file_ext = substr($fileformat['file_format'], -3);

//Get the account id to get the account name
$query = "SELECT `acc_id` FROM `upload` WHERE `song_id`='".$_GET['songID']."'";
$result = mysqli_query($db, $query);
$accID = mysqli_fetch_assoc($result);

$query = "SELECT `acc_name` FROM `account` WHERE `acc_id`='".$accID['acc_id']."'";
$result = mysqli_query($db, $query);
$accountname = mysqli_fetch_assoc($result);

//Path name to find the file location
$path = "".$accountname['acc_name']."/".$fileformat['file_format']."";

if(file_exists($path) && is_readable($path))
{
	//Used this site for making sure that the downloaded file plays after download
	//https://gist.github.com/debojitkakoti/9183653
	
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.basename($path));
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($path));
	ob_clean();
	flush();
	readfile($path);
	exit();
}
else
{
	echo "Unable to download file.";
}

?>

</body>
</html>