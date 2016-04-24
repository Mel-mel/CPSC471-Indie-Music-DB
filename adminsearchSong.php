<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<link href="css.css" type="text/css" rel="stylesheet" />
	<title>My Playlist</title>
<script type='text/javascript'>
		var currentRow=-1;
			
		function SelectRow(userid,listid,newRow,insearch,col)
		{	
			
		}
		function check(newRow,col)
		{	
			
			//if (document.getElementById("Add"+newRow).checked = true)
				//				window.location.assign("test.html");
			
		}
		function clearall()
		{
			document.getElementById("text_name").value="";
			document.getElementById("text_format").value="";
			document.getElementById("text_genre").value="";
			document.getElementById("text_desc").value="";
		}
		function selectall()
		{
		 	var songid="";
			 var table = document.getElementById("table_ls");
			for (var j = 1, row; row = table.rows[j]; j++) {
				 songid=row.cells[0].innerHTML;
				 document.getElementById("Add"+songid).checked =true;
			}
		}
		function deselectall()
		{
			var songid="";
			var table = document.getElementById("table_ls");
			for (var j = 1, row; row = table.rows[j]; j++) {
				 songid=row.cells[0].innerHTML;
				 document.getElementById("Add"+songid).checked =false;
			}
		}
		function Search(userid,listid)
		{
			searchfunc(userid,listid,1)	;
		}
		function searchfunc(userid,listid,insearch){
			
			var name = document.getElementById("text_name").value;
			var format = document.getElementById("text_format").value;
			var genre = document.getElementById("text_genre").value;
			var desc = document.getElementById("text_desc").value;
				
			var url="adminsearchSong.php?id=".concat(userid);
			url=url.concat("&listid=").concat(listid);
			url=url.concat("&insearch=").concat(insearch);
			url=url.concat("&name=").concat(name);
			url=url.concat("&format=").concat(format);
			url=url.concat("&genre=").concat(genre)
			url=url.concat("&desc=").concat(desc);
			window.location.assign(url);
		}	
		function Update(userid,listid)
		{   
			var swhere="in (-100";
			var songid="";
			var table = document.getElementById("table_ls");
			for (var j = 1, row; row = table.rows[j]; j++) {
				 songid=row.cells[0].innerHTML;
				 var vchecked=document.getElementById("Add"+songid).checked ;
				 if(vchecked==true)
				 	swhere=swhere.concat(",").concat(songid);
            }
			
			swhere =swhere.concat(")");
			var url="adminaddSongIntoPlayList.php?id=".concat(userid);
			url=url.concat("&listid=").concat(listid);
			url=url.concat("&songids=").concat(swhere);
			window.location.assign(url);	
			
		}
		
		</script>
<?php	include_once("./connect.php");
	
?>
<?php
	//Defining variables set to a default of null
	$listid=$_GET['listid'];
	$acc_id=$_SESSION["accountID"];
	$insearch= $_GET['insearch'];
	$name=$_GET['name'];
	$format=$_GET['format'];
	$genre=$_GET['genre'];
	$desc=$_GET['desc'];
	
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
			<img src="i/logo2 - 2.gif" width="271" height="41" border="0" alt="" style="float:left;"/>
			<div style="float:right;margin-right:0px;margin-top:19px;">
				<a href="adminSongofList.php?<?php echo 'listid='.$listid.'&songid=' ?>">Song of List</a> 
				<a href="admineditAccount.php"><?php echo $username."'s Account" ?></a> 
			</div>
		</div>
	</div>
	<div style="background-color: #ffffff; height: 100%; width: 0px;">
	  <div id="l">
		  <p style="padding-left:0px;">	
		  	<button type="button" onclick="Search(<?php echo $acc_id.",".$listid  ?>)" style="float:right;margin-right:14px;margin-top:15px">Search</button>
			<button type="button" onclick="clearall()" style="float:right;margin-right:14px;margin-top:15px">Clear</button>

			<div style="background-color: #E5E5E5; padding: 7px 0px 0px 0px; height: 23px; font-weight: bold;width: 756px;">Search songs for Playlist <?php echo $listid ?>   	
			</div>
			
			 <b><img src="i/arrows.gif" width="26" height="8" border="0" alt=""/>Name</b><br/><br/>
		     		<input type="text" id="text_name" name="text_name" value="<?php echo $name ?>" style="margin-left:100; width: 735px;" maxlength="255"><br/>
					 
					 <b><img src="i/arrows.gif" width="26" height="8" border="0" alt=""/>Format</b><br/><br/>
		     		<input type="text" id="text_format" name="text_format" value="<?php echo $format ?>" style="margin-left:100; width: 735px;" maxlength="255"><br/>
					
					<b><img src="i/arrows.gif" width="26" height="8" border="0" alt=""/>Genre</b><br/><br/>
		     		<input type="text" id="text_genre" name="text_genre" value="<?php echo $genre ?>" style="margin-left:100; width: 735px;" maxlength="255"><br/>
						
					<b><img src="i/arrows.gif" width="26" height="8" border="0" alt=""/>Description</b><br/><br/>
					<input type="text" id="text_desc" name="text_desc" value="<?php echo $desc ?>" style="margin-left:100; width: 735px;" maxlength="255"><br/>
											
					<b style="color:blue"><img src="i/arrows.gif" width="26" height="8" border="0" alt=""/>Search Result</b>
		
					<button type="button" onclick="Update(<?php echo $acc_id.",".$listid  ?>)" style="float:right;margin-right:14px;margin-top:15px">Update</button>
					<button type="button" onclick="deselectall()" style="float:right;margin-right:14px;margin-top:15px">Deselect All</button>
					<button type="button" onclick="selectall()" style="float:right;margin-right:14px;margin-top:15px">Select All</button>
			
			<table id = "table_ls" style="border: solid 1px black;float:left;margin-left:0px" width="737" align="center">
					<tr><th width="50">Song ID</th><th width="250">Song Name</th><th width="50">Format</th><th width="100">Genre</th>
						<th width="382">Description</th><th width="30">Add</th></tr>
				<?php
					if($insearch!=0){
						$searchstring="";
						if ($name!="") $searchstring=$searchstring."song_name like '%".$name."%'";
						if ($format!="") {
							if($searchstring=="")
								$searchstring=$searchstring."file_format like '%".$format."%'";
							else
								$searchstring=$searchstring." and file_format like '%".$format."%'";
						}
						if ($genre!="") {
							if($searchstring=="")
								$searchstring=$searchstring."genre like '%".$genre."%'";
							else
								$searchstring=$searchstring." and genre like '%".$genre."%'";
						}
						if ($desc!="") {
							if($searchstring=="")
								$searchstring=$searchstring."song_descrip like '%".$desc."%'";
							else
								$searchstring=$searchstring." and song_descrip like '%".$desc."%'";
								
						}
	
						if ($searchstring!="") $searchstring=" where ".$searchstring;
						
						$inQuery = "SELECT * from song ".$searchstring;
						$result = mysqli_query($db, $inQuery);
					     	
				     	// output data of each row
						if ($result->num_rows > 0) {
							$tbRow=1;
				     		while($row = mysqli_fetch_assoc($result)) {
				     			$color="white";
					     		/*if ($songid=="") 	{$songid=$row["song_id"]; }
								if ($songid==$row['song_id'])	 $color="#AAF";	*/					
								echo "<tr>";
									//echo "<td onclick='SelectRow(".$listid.",".$row['song_id'] .",1)' id='cell_".$row['song_id'] .",1' bgcolor='".$color."'>" . $row["song_id"]. "</td>";
									echo "<td onclick='SelectRow(".$acc_id.",".$listid.",".$row['song_id'] .",".$insearch.",0)' id='cell_".$row['song_id'] .",0' bgcolor='".$color."'>" . $row["song_id"]. "</td>";
									echo "<td onclick='SelectRow(".$acc_id.",".$listid.",".$row['song_id'] .",".$insearch.",1)' id='cell_".$row['song_id'] .",1' bgcolor='".$color."'>" . $row["song_name"]. "</td>";
									echo "<td onclick='SelectRow(".$acc_id.",".$listid.",".$row['song_id'] .",".$insearch.",2)' id='cell_".$row['song_id'] .",2'bgcolor='".$color."'>" . $row["file_format"]. "</td>";
									echo "<td onclick='SelectRow(".$acc_id.",".$listid.",".$row['song_id'] .",".$insearch.",3)' id='cell_".$row['song_id'] .",3'bgcolor='".$color."'>" . $row["genre"]. "</td>";
									echo "<td onclick='SelectRow(".$acc_id.",".$listid.",".$row['song_id'] .",".$insearch.",4)' id='cell_".$row['song_id'] .",4'bgcolor='".$color."'>" . $row["song_descrip"]. "</td>";
				     	 			echo "<td onclick='SelectRow(".$acc_id.",".$listid.",".$row['song_id'] .",".$insearch.",5)' id='cell_".$row['song_id'] .",5' > 
				     	 				<input name='Add' type='checkbox' id='Add".$row["song_id"]."' onclick='check(".$row['song_id'] .",5)' > </td>"	;	
						            echo "</tr>"	;	  
			        					
					     		}
				 		} 
						else {
				     					echo "0 results";
						}
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