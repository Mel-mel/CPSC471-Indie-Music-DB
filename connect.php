
<?php
session_start();
?>

<?php
$user = 'musicuser';
$dbpassword = 'password';
$db = 'indiemusicdb';

//Creating connection to server
$db = mysqli_connect('localhost', $user, $dbpassword, $db);


?>

