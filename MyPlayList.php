<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<link href="css.css" type="text/css" rel="stylesheet" />
	<title>My Playlist</title>
<script type='text/javascript'>
		var currentRow=-1;
		
		function SelectRow(userid,newRow,col)
		{		 
		   var table = document.getElementById("table_list");
		   for(var i=2;i<=3;++i)
		   {
		       var cell=document.getElementById('cell_'+newRow+','+i);
		       cell.style.background='#AAF';
		       if(currentRow!=-1)
		       {
		           var cell=document.getElementById('cell_'+currentRow+','+i);
		           cell.style.background='#FFF';
		       }
		       else{
			       	for (var j = 1, row; row = table.rows[j]; j++) {
			       		if (findListid(row.cells[0].innerHTML,"Edit ","\"")!=newRow){		       			
			       			row.cells[i-1].style.background='#FFF';
			       		}
			       	}
		       }
		   }
		 
		   if (col==1)
		   		window.location.assign(getUrl("SongofList.php",userid, newRow)+"&songid=");
		   else if(col==4){
		   		var ps="Do you want to delete current list( ";
		   		ps=ps.concat(newRow).concat(" )?");
		   		
		    	if (confirm( ps) == true) {
		     		var nextListid=findNextListid(newRow);
		     		
		     		//delete 
			    	window.location.assign(getUrl("deletePlayList.php",userid,newRow,nextListid));
			    }
			}
		   else 
		    	window.location.assign(getUrl("MyPlayList.php",userid,newRow));

     		 currentRow=newRow;
		}
		function findNextListid(listid)
		{
			 var table = document.getElementById("table_list");
			 var rowCount = table.rows.length;
			 var rowindex=-1;
			
			 for (var j = 1, row; row = table.rows[j]; j++) {
			 	
			       if (findListid(row.cells[0].innerHTML,"Edit ","\"")==listid){		       			
			       		rowindex=j;
			       		break;
			       		}
			 }
			  if(rowCount>2){
				 if (rowindex<rowCount-1) rowindex=rowindex+1;
			 		else rowindex=1;
			 
			 	return findListid(table.rows[rowindex].cells[0].innerHTML,"Edit ","\"");
			 }
			 else return -1;
		}
		function findListid(s,prefix,surfix){
			var n1 = s.indexOf(prefix);
			var subS=s.substr(n1+prefix.length,s.length-n1+prefix.length);
			var n2 = subS.indexOf(surfix);
			
			subS=subS.substr(0,n2);
			return subS;
		}
		function getUrl(urlStart,acc_id,newRow)
		{
			if (newRow<0)
				return urlStart.concat("?listid=");
			else
				return urlStart.concat("?listid=").concat(newRow);
		}
		function IsSelected()
		{
		   return currentRow==-1?false:true;
		}
		
		function GetSelectedRow()
		{
		   return currentRow;
		}
		</script>
<?php
	include_once("./connect.php");
	
?>
<?php
	//Defining variables set to a default of null
	$listid=$_GET['listid'];
	//$acc_id = $_GET['id'];
	$acc_id=$_SESSION["accountID"];
	$listname="";
	
	$inQuery = "SELECT acc_name from account where acc_id=" .$acc_id;
	$result = mysqli_query($db, $inQuery);
	if(! $result ) {  echo "Could not get data: ";
						exit;}
	if ($row = mysqli_fetch_assoc($result))
		$username=$row['acc_name'];	

	if(isset($_POST['AddButton']))
	{
		//Goes to the next page.
		header("Location: SongofList.php?&listid=-1&songid=");
	}
	/*if(isset($_POST['viewSongs']))
	{
		//Goes to the next page.
		header("Location: AddNewList.php?id=".$acc_id."&listid=".$listid);
		
	}
	if(isset($_POST['Delete']))
	{
		//Goes to the next page.
		header("Location: AddNewList.php?id=".$acc_id."&listid=".$listid);
		
	}*/

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
			<img src="i/logo2.gif" width="271" height="41" border="0" alt="" style="float:left;"/>
			<div style="float:right;margin-right:0px;margin-top:19px;">
				<a href="editAccount.php"><?php echo $username."'s Account" ?></a> 
			</div>
		</div>
	</div>
	<div style="background-color: #ffffff; height: 100%; width: 0px;">
	  <div id="l">
		  <p style="padding-left:0px;">	
		  	<form action="" method="post">
		  		<input type="submit" name="AddButton" value="Add New Playlist" style="position:relative;left:0px;top:2px;">
		  	 	</form>
			<div style="background-color: #E5E5E5; padding: 7px 0px 0px 0px; height: 23px; font-weight: bold;width: 756px;">Lists   	
			</div>
			<table id = "table_list"   style="border: solid 1px black" width="732" align="center">
				<tr><th width="50">list ID</th><th width="250">list Name</th><th width="450">Description</th><th width="50">Delete</th></tr>
				<?php
					$inQuery = "SELECT playlist_id, case when playlist_name is null then '' else playlist_name end as playlist_name,"
					     	."case when playlist_descrip is null then '' else playlist_descrip end as playlist_descrip "
					     	."FROM playlist  WHERE (acc_id=" .$acc_id. ")";
		
					$result = mysqli_query($db, $inQuery);
					$rowindex=0;
					// output data of each row					
	     			while($row = mysqli_fetch_assoc($result)) {
	     				$color="white";
						
	     				if ($listid=="") 	{$listid=$row["playlist_id"]; $listname=$row["playlist_name"];}
						if ($listid==$row['playlist_id'])	 $color="#AAF";						
						echo "<tr>";
							echo "<td onclick='SelectRow(".$acc_id."," .$row['playlist_id'] .",1)' id='cell_".$row['playlist_id'] .",1'> 
								<input name='viewSongs' type='submit' id='viewSongs' value='Edit ". $row["playlist_id"]."' class='btn btn-xs btn-danger'/>";
							echo "<td onclick='SelectRow(".$acc_id.",".$row['playlist_id'] .",2)' id='cell_".$row['playlist_id'] .",2' bgcolor='".$color."'>" . $row["playlist_name"]. "</td>";
							echo "<td onclick='SelectRow(".$acc_id.",".$row['playlist_id'] .",3)' id='cell_".$row['playlist_id'] .",3'bgcolor='".$color."'>" . $row["playlist_descrip"]. "</td>";
		     	 			echo "<td onclick='SelectRow(".$acc_id.",".$row['playlist_id'] .",4)' id='cell_".$row['playlist_id'] .",4'> 
		     	 				<input name='Delete' type='submit' id='Delete' value='Del List ".$row["playlist_id"]."'> </td>"	;	
							/*echo "<td><input type='hidden' id='cell_".$row['playlist_id'] .",5' value='" .$acc_id ."'/></td>";
							echo "<td><input type='hidden' id='cell_".$row['playlist_id'] .",6' value='" .$row['playlist_id'] ."'/></td>";   */  	 					     	 							
						echo "</tr>";
					}
					  
					?>
			</table>
	  	<!--</form>-->
		  </p>
	  </div>
	  <div id="rcol">
		  <div style="padding-left:19px;">
		    <div style="background-color: #E5E5E5; padding: 7px 0px 0px 0px; height: 23px; font-weight: bold; width: 758px;">
		    	<?php echo $listname ?>
		    </div>	    
		    
			<table id = "table_song" style="border: solid 1px black;float:left;margin-left:12px" width="732" align="center">
				<tr><th width="250">Song Name</th><th width="50">Format</th><th width="100">Genre</th><th width="332">Description</th></tr>
			<?php
			if ($listid!="") 
			{
		    	$inQuery = "SELECT playlist.playlist_id,case when playlist_name is null then '' else playlist_name end as playlist_name ,"
		    		."case when song_name is null then '' else song_name end as song_name, case when file_format is null then '' else file_format end as file_format,"
		    		."case when song_descrip is null then '' else song_descrip end as song_descrip,"
		    		."case when genre is null then '' else genre end as genre FROM playlist join createplaylist on playlist.playlist_id=createplaylist.playlist_id "
		    		."join song on song.song_id=createplaylist.song_id where playlist.playlist_id=" .$listid;
				$result = mysqli_query($db, $inQuery);
		     // output data of each row
				if ($result->num_rows > 0) {
					    
		     		while($row = mysqli_fetch_assoc($result)) {
		 					echo "<tr><td>" . $row["song_name"]. "</td><td>" . $row["file_format"]. "</td><td>" . $row["genre"]. 
		     	 			"</td><td>". $row["song_descrip"]."</td></tr>";
		     			}
	 			} 
				else {
	     					echo "0 results";
				}
			}
		    ?>
			</table>
			<br/><br/><br/>	<br/>
	    </div>
	  </div> 
        </div>
	<div id="foot">2016  Copyright </div>
</div>
</body>
</html>