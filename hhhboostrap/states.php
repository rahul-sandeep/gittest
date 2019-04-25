<?php
	include('connect.php');
		$id=$_POST['id'];
		$query="SELECT * FROM states WHERE state_country_id='".$id."'";

	$userQuery="SELECT * FROM volunteers WHERE id='".$_POST['uid']."'";

		$row=mysqli_query($con,$query);
		

		$rowUser=mysqli_query($con,$userQuery);
		$user = mysqli_fetch_assoc($rowUser);
		?>
		<option value="">Select State</option>
		// print_r(mysqli_fetch_assoc($rowUser));exit;
		<?php
	while($res=mysqli_fetch_assoc($row)){
?>	
		<option value="<?php echo $res['state_id']; ?>"
         <?php if($res['state_id']==$user['state']){echo'selected';} ?>><?php echo $res['state_name'];?>
                    </option>
<?php
}

?>