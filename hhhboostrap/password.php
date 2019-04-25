<!DOCTYPE html>
<html>
  <head>
  <style> .error{ color:red; } </style>
  </head>
		<?php 
			include ('header.php');
			include ('connect.php');
			//print_r($_POST);
			//EXIT;
			$id = $_SESSION['id'];
			if (isset($_POST['password']))
		{
			$old_pass = md5($_POST['password']);
			//echo $old_pass;exit;
			$newpassword = $_POST['newpassword'];
			$confirmnewpassword = $_POST['confirmnewpassword'];
			$res="select * from volunteers where id='".$id."'";
			
			$password_query = mysqli_query($con,$res);
			$password_row = mysqli_fetch_assoc($password_query);
			// print_r ($password_row);exit;
			$database_password = $password_row['password'];
			//echo $database_password;exit;
			if ($database_password == $old_pass)
			{
					if ($newpassword == $confirmnewpassword)
				{
					$sql1 ="update volunteers set password='".md5($newpassword)."' where id='".$id."'";
					$update_pwd = mysqli_query($con,$sql1);
					header('Location:logout.php');
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
<script>
function validation() {
		var newpassword = document.getElementById("newpassword").value;
		var password = document.getElementById("password").value;
		//alert (password);
		var confirmnewpassword = document.getElementById("confirmnewpassword").value;
		var passwordcheck = /^(?=.*[0-9])(?=.*[@.#$*&^])[a-zA-Z0-9@.#$*&^]{8,16}$/;
		valid=0;
		
		if(password==""){				
							document.getElementById("passworderror").innerHTML="please enter valid password";
							valid=1;
						}
						
						else {
							document.getElementById("passworderror").innerHTML= "";
						
						} 
						
						 if(newpassword==""){
							//alert();
							document.getElementById("passworderror1").innerHTML="please enter valid password";
							 valid=1;
							// Checking RegularExp....
						}else if(newpassword!=""){		
							if(passwordcheck.test(password)){
								document.getElementById("passworderror1").innerHTML= "";
							}else{
								document.getElementById("passworderror1").innerHTML="*password is invalid";
								valid=1;
							}
							
						}
						if(confirmnewpassword==""){				
							document.getElementById("passworderror2").innerHTML="please enter valid password";
							valid=1;
							// Checking RegularExp....
						}else if(confirmnewpassword!=""){		
							if(passwordcheck.test(password)){
								document.getElementById("passworderror2").innerHTML= "";
							}else{
								document.getElementById("passworderror2").innerHTML="*password is invalid";
								valid=1;
							}
							
						}
						//alert(valid);
					if(valid==0){
						$('#updatepwd').submit();
					}
									
}

</script>

		<body>
		<div class="container">
		<h1> Update Password </h1>
	
	<div class="col-md-5">
		<form  method='POST' id="updatepwd">
		<div class="form-group">
        Current Password: <input type='password' name='password' id='password' class="form-control"><span id="passworderror" class="error" >
		</div>
		<div class="form-group">
        New Password: <input type='password' name='newpassword' id='newpassword'  class="form-control"><span id="passworderror1" class="error" ><br>
		</div>
		<div class="form-group">
        Confirm New Password: <input type='password' name='confirmnewpassword' id='confirmnewpassword'  class="form-control"><span id="passworderror2" class="error" >
		</div>
		<div class="form-group ">
		<div class="center-block">
        <input type="button" class="btn btn-primary " value="Update " onclick="validation();">
		<input class="btn btn-primary" type="button" onclick="window.location.replace('profile.php')" value="Cancel" />
		</div>
		</div>
		</form>
	</div>
</html>
</div>
		<div class="footer text-center navbar-fixed-bottom">
		<?php include('footer.php');?>
		</div>
		
		