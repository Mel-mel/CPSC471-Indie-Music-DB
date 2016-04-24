
<?php
	include_once("./connect.php");
	
?>
<?php
	$listid=$_GET['listid'];
	$acc_id=$_SESSION["accountID"];
	$nextlistid=$_GET['nextlistid'];
	$inQuery = "delete from `createplaylist` where `playlist_id`=".$listid;
	$rs=mysqli_query($db, $inQuery);
	$inQuery = "delete from `playlist` where `playlist_id`=".$listid;
	$rs=mysqli_query($db, $inQuery);
if($rs){
  //header('Location: MyPlayList.php?id='.$acc_id."&listid=".$nextlistid);
	header('Location: adminMyPlayList.php?&listid='.$nextlistid);
}
?>