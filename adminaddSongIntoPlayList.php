
<?php
	include_once("./connect.php");
	
?>
<?php
	//$acc_id=$_GET['id'];
	$acc_id=$_SESSION["accountID"];
	$listid=$_GET['listid'];
	$songids = $_GET['songids'];
	$inQuery = "INSERT INTO createplaylist( playlist_id,song_id) select ".$listid.",song_id from song where song_id ".$songids.
		" and song_id not in (select song_id from createplaylist where playlist_id=".$listid.")";
	$rs=mysqli_query($db, $inQuery);
	
if($rs){
  //header('Location: SongofList.php?id='.$acc_id.'&listid='.$listid.'&songid=');
	header('Location: adminSongofList.php?listid='.$listid.'&songid=');
}
?>
