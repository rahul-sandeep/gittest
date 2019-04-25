<?php
   include('connect.php');
    $id = $_POST['id'];
        $sql = "SELECT * from volunteers where id='".$id."'";
        $row = mysqli_query($con,$sql);
        $res = mysqli_fetch_assoc($row);
		$query1="DELETE FROM mission WHERE user_mid = '".$id."'";
		$row1 = mysqli_query($con,$query1);
		
		$query2="DELETE FROM skills WHERE skill_userid = '".$id."'";
		$row2 = mysqli_query($con,$query2);
		
        $query = "DELETE FROM volunteers WHERE id = '$id'";
		 unlink("uploads/"."/".$res['image']);
		
        if($con->query($query)==true) {
            header('Location: data.php');                
        }
?>