<?php
include('connect.php');
	$id=$_GET['id'];
	$query="SELECT image FROM volunteers WHERE id='".$id."'";
	$row=mysqli_query($con,$query);
	$res=mysqli_fetch_assoc($row);
	unlink("uploads/".$res['image']);
	$sql=" UPDATE volunteers SET image =null WHERE id='".$id."'";
	$row=mysqli_query($con,$sql);
	header('Location: profileedit.php?id='.$id);

?>