
<?php
	include_once("./connect.php");
	
?>
<?php
	$acc_id=$_SESSION["accountID"];
	$listid= $_GET['listid'];
	$listname=$_GET['name'];
	$desc=$_GET['desc'];
	$sort=$_GET['sort'];
	/*header('Location:test_tb.html?id='.$listid);*/
	if ($listid==-1)
	{
		header('Location:test.html');
			
		$inQuery = "INSERT INTO playlist( playlist_name, playlist_descrip, sort_by, acc_id) VALUES 
			('".$listname."','".$desc."','".$sort."',".$acc_id.")";
		$rs=mysqli_query($db, $inQuery);
		$inQuery = "SELECT max(playlist_id) as playlist_id FROM playlist WHERE acc_id=".$acc_id;
		$rs=mysqli_query($db, $inQuery);
		if ($row = mysqli_fetch_assoc($rs))
				$listid=$row['playlist_id'];
	}
	else{
		//header('Location:test_tb.html');
		$inQuery = "update playlist set playlist_name='".$listname."',playlist_descrip='".$desc."',sort_by='".$sort."' where playlist_id=".$listid;
		$rs=mysqli_query($db, $inQuery);
	}

  //header('Location: SongofList.php?id='.$acc_id.'&listid='.$listid);
  header('Location: adminSongofList.php?listid='.$listid.'&songid=');

?>