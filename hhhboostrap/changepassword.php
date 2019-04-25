<?php 
			include ('header.php');
			include ('connect.php');
			//print_r($_POST);
			//EXIT;
			$id = $_SESSION['id'];
			if (isset($_POST['submit']))
		{
			$old_pass = md5($_POST['password']);
			//echo $old_pass;exit;
			$newpassword = $_POST['newpassword'];
			$confirmnewpassword = $_POST['confirmnewpassword'];
			$res="select * from volunteers where id='".$id."'";
			
			$password_query = mysqli_query($con,$res);
			$password_row = mysqli_fetch_assoc($password_query);
			//print_r ($password_row);exit;
			$database_password = $password_row['password'];
			//echo $database_password;exit;
			if ($database_password == $old_pass)
			{
					if ($newpassword == $confirmnewpassword)
				{
					$sql1 ="update volunteers set password='".md5($newpassword)."' where id='".$id."'";
					$update_pwd = mysqli_query($con,$sql1);
					//echo "<script>alert('Update Sucessfully');</script>";
					<?php header('Location: login.php'); ?>
				}
				else
				{
					echo "<script>alert('Your new and confirm Password is not match'); </script>";
				}
			}
			else
			{
				echo "<script>alert('Your old password is wrong'); </script>";
			}
		}
 
?>