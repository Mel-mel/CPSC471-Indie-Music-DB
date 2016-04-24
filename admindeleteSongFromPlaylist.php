
<?php
	include_once("./connect.php");
	
?>
<?php
	$acc_id=$_SESSION["accountID"];
	$listid=$_GET['listid'];
	$songid = $_GET['songid'];
	$inQuery = "delete from `createplaylist` where `playlist_id`=".$listid." and song_id=".$songid;
	$rs=mysqli_query($db, $inQuery);
	
if($rs){
  //header('Location: SongofList.php?id='.$acc_id.'&listid='.$listid.'&songid=');
	header('Location: adminSongofList.php?&listid='.$listid.'&songid=');
}
?>