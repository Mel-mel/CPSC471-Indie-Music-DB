<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<link href="css.css" type="text/css" rel="stylesheet" />
	<title>My Playlist</title>
<script type='text/javascript'>
		var currentRow=-1;
			
		function SelectRow(userid,listid,newRow,col)
		{	
			if(col==5){
		   		var ps="Do you want to delete current song( ";
		   		ps=ps.concat(newRow).concat(" )?");
		   		
		    	if (confirm( ps) == true) {
			     		//delete 
			    	  window.location.assign(getUrl( "deleteSongFromPlayList.php",userid,listid,newRow));
			    }
			}
			else 
		    	window.location.assign(getUrl("SongofList.php",userid,listid,newRow));
		   
		}
		function getUrl(urlStart,acc_id,listid,songid)
		{
			return urlStart.concat("?listid=").concat(listid).concat("&songid=").concat(songid);
		}
		
		function Savedata(userid,listid)
		{
			var listname = document.getElementById("text_name").value;
			var desc = document.getElementById("text_desc").value;
			var sort = document.getElementById("text_sort").value;
				
			var url="savePlaylist.php";
			url=url.concat("?listid=").concat(listid);
			url=url.concat("&name=").concat(listname);
			url=url.concat("&desc=").concat(desc)
			url=url.concat("&sort=").concat(sort);
			window.location.assign(url);			
		}
		</script>
<?php	include_once("./connect.php");
	
?>
<?php
	//Defining variables set to a default of null
	$listid=$_GET['listid'];
	$acc_id=$_SESSION["accountID"];
	$songid= $_GET['songid'];
	$listname="";
	
	$inQuery = "SELECT acc_name from account where acc_id=" .$acc_id;
	$result = mysqli_query($db, $inQuery);
	if(! $result ) {  echo "Could not get data: ";
						exit;}
	if ($row = mysqli_fetch_assoc($result))
		$username=$row['acc_name'];		

?>
</head>
<body>
<div id="page">
	<div style="height:30px;background:url(i/bg.gif);">	
	</div>
	<div id="search">
		<div style="background:url(i/logo1.gif) no-repeat 0px 0px; height:46px;">
		</div>
	</div>
	<div id="menu">
		<div style="background:url(i/mr.gif) no-repeat 100% 0px;">
			<img src="i/logo2 - 1.gif" width="271" height="41" border="0" alt="" style="float:left;"/>
			<div style="float:right;margin-right:0px;margin-top:19px;">
				<a href="MyPlaylist.php?<?php echo '?listid='.$listid ?>">My Playlist</a> 
				<a href="editAccount.php"><?php echo $username."'s Account" ?></a> 
			</div>
		</div>
	</div>
	<div style="background-color: #ffffff; height: 100%; width: 0px;">
	  <div id="l">
		  <p style="padding-left:0px;">	
		  	<button type="button" onclick="Savedata(<?php echo $acc_id.",".$listid  ?>)" style="float:right;margin-right:14px;margin-top:15px">Save</button>
			<div style="background-color: #E5E5E5; padding: 7px 0px 0px 0px; height: 23px; font-weight: bold;width: 756px;">Lists Detail   	
			</div>
			
			 <?php
		    	if ($listid=="") $listid="-1";
				
		    	$inQuery = "SELECT playlist_id, case when playlist_name is null then '' else playlist_name end as playlist_name,"
					     	."case when playlist_descrip is null then '' else playlist_descrip end as playlist_descrip, "
					     	."case when sort_by is null then '' else sort_by end as sort_by "
					     	."FROM playlist  WHERE (playlist_id=" .$listid. ")";
		
				$result = mysqli_query($db, $inQuery);
					
					// output data of each row
				$lname="";
				$desc="";
				$sortby="";	
			
					if ($row = mysqli_fetch_assoc($result))
					{
						$lname=$row['playlist_name'];
						$desc=$row['playlist_descrip'];
						$sortby=$row['sort_by'];
					}
				
	     	
	     		
	     		echo " <b><img src='i/arrows.gif' width='26 height='8' border='0' alt=''/>Name</b><br/><br/>";
	     		echo "<input type='text' id='text_name' name='text_name' value='" .$lname."' style='margin-left:100; width: 735px;' maxlength='255'><br/>";
						
				echo "<b><img src='i/arrows.gif' width='26' height='8' border='0' alt=''/>Description</b><br/><br/>";
				echo "<input type='text' id='text_desc' name='text_desc' value='" .$desc."' style='margin-left:100; width: 735px;' maxlength='255'><br/>";
						
				echo "<b><img src='i/arrows.gif' width='26' height='8' border='0' alt=''/>Sort By</b><br/><br/>";
				echo "<input type='text' id='text_sort' name='text_sort' value='" .$sortby."' style='margin-left:100; width: 735px;' maxlength='255'><br/>";
						
				echo "<b><img src='i/arrows.gif' width='26' height='8' border='0' alt=''/>Songs</b><br/><br/>";
					  		  		
		    	if($listid!=-1){
			    	echo "<div style='float:right;margin-right:25px;margin-top:0px;'>";
				   	echo "	<a href='SearchSong.php?listid=" .$listid."&insearch=0&name=&format=&genre=&desc=' >Find more songs</a> "	;	
					echo "</div>";
				}
							
			?>
				
			<table id = "table_ls" style="border: solid 1px black;float:left;margin-left:0px" width="737" align="center">
					<tr><th width="250">Song Name</th><th width="50">Format</th><th width="100">Genre</th>
						<th width="382">Description</th><th width="50">Delete</th></tr>
				<?php
					$inQuery = "SELECT playlist.playlist_id,case when playlist_name is null then '' else playlist_name end as playlist_name ,song.song_id,"
			    		."case when song_name is null then '' else song_name end as song_name, case when file_format is null then '' else file_format end as file_format,"
			    		."case when song_descrip is null then '' else song_descrip end as song_descrip,"
			    		."case when genre is null then '' else genre end as genre FROM playlist join createplaylist on playlist.playlist_id=createplaylist.playlist_id "
			    		."join song on song.song_id=createplaylist.song_id where playlist.playlist_id=" .$listid;
					$result = mysqli_query($db, $inQuery);
			     	
			     	// output data of each row
					if ($result->num_rows > 0) {
					
			     		while($row = mysqli_fetch_assoc($result)) {
			     			$color="white";
				     		if ($songid=="") 	{$songid=$row["song_id"]; }
							if ($songid==$row['song_id'])	 $color="#AAF";						
							echo "<tr>";
								//echo "<td onclick='SelectRow(".$listid.",".$row['song_id'] .",1)' id='cell_".$row['song_id'] .",1' bgcolor='".$color."'>" . $row["song_id"]. "</td>";
								echo "<td onclick='SelectRow(".$acc_id.",".$listid.",".$row['song_id'] .",1)' id='cell_".$row['song_id'] .",1' bgcolor='".$color."'>" . $row["song_name"]. "</td>";
								echo "<td onclick='SelectRow(".$acc_id.",".$listid.",".$row['song_id'] .",2)' id='cell_".$row['song_id'] .",2'bgcolor='".$color."'>" . $row["file_format"]. "</td>";
								echo "<td onclick='SelectRow(".$acc_id.",".$listid.",".$row['song_id'] .",3)' id='cell_".$row['song_id'] .",3'bgcolor='".$color."'>" . $row["genre"]. "</td>";
								echo "<td onclick='SelectRow(".$acc_id.",".$listid.",".$row['song_id'] .",4)' id='cell_".$row['song_id'] .",4'bgcolor='".$color."'>" . $row["song_descrip"]. "</td>";
			     	 			echo "<td onclick='SelectRow(".$acc_id.",".$listid.",".$row['song_id'] .",5)' id='cell_".$row['song_id'] .",5'> 
			     	 				<input name='Delete' type='submit' id='Delete' value='Del Song ".$row["song_id"]."'> </td>"	;	
					            echo "</tr>"	;	  
		        					
				     		}
			 		} 
					else {
			     					echo "0 results";
					}
				?>
			</table>
			
		  </p>
	  </div>
	  
        </div>
	<div id="foot">2016  Copyright </div>
</div>
</body>
</html>