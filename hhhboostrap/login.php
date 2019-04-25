<!DOCTYPE html>
<html>
	<head>
	<style> .error{ color:red; } </style>
	</head>
	<body>
		<?php 
		 include ('header.php');
		?>
	<section>
	<?php if((isset($_SESSION['id']) && $_SESSION['id']!=="" )){
     header('Location:index.php');
		}else { ?>
	<div class="container mar_t50">
	 <div class="col-md-4">

			<h1>Login Form</h1>
			<form id="ff" method="post" action="">
				<div class="form-group">
					<label><b>Email:</b></label><input type="email" name="email" id="email"  class="form-control" value= "<?php if(isset($_COOKIE['email'])) { echo $_COOKIE['email'];}?>" placeholder="enter email"><span id="emailerror" class="error"></span>		
				</div>
				<div class="form-group">
					<label><b>password:</b></label><input type="password" name="password" id="password"  class="form-control" value= "<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password'];}?>"  placeholder="enter password"><span id="passworderror" class="error"></span>
				</div>
				<input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE['email'])) { echo 'checked="checked"';}?> > Remember Me <br>
				 <p>Not a member yet ?
					<a href="registration.php" >Join us</a>
				</p>
				
				
				<input type="button" class="btn btn-primary center-block" value="Login" onclick="login();">
			</form>
		</div> 
		</div>
		<?php } ?>
	</section>
	
	 <script>
	 function login(){	
		var baseUrl = 'http://localhost/tasks/mywork';
		var email = $('#email').val();
		var password = $('#password').val();
		var remember=$('#remember').val();
		var form_data = new FormData();
		form_data.append('email', email);
		form_data.append('password', password);
		form_data.append('remember', remember);
		var emailcheck = /\S+@\S+\.\S+/;
		var passwordcheck = /^(?=.*[0-9])(?=.*[@.#$*&^])[a-zA-Z0-9@.#$*&^]{8,16}$/;
		// Empty Checking...
				if(email==""){				
					document.getElementById("emailerror").innerHTML="please enter email";
					return false;
					// Checking RegularExp....
				}else if(email!=""){		
					if(emailcheck.test(email)){
						document.getElementById("emailerror").innerHTML= "";
					}else{
						document.getElementById("emailerror").innerHTML="*email is invalid";
						return false;
					}
					
				}
				
				// Empty Checking...
				if(password==""){				
					document.getElementById("passworderror").innerHTML="please enter  password";
					return false;
					// Checking RegularExp....
				}else if(password!=""){		
					if(passwordcheck.test(password)){
						document.getElementById("passworderror").innerHTML= "";
					}else{
						document.getElementById("passworderror").innerHTML="*password is invalid";
						return false;
					}
					
				}
		$.ajax({
			url: baseUrl+'/setsess.php',
			data:$('#ff').serialize(),
			type: 'post',
			dataType:'json',
			success: function(res){
				if(res.output=='success'){
					if(res.role=='Admin'){
						window.location = 'datatable.php';
					}else{
						window.location = 'index.php';
					}
				}else{
					alert("Enter Valid email and password.")
				}
				
			}
		});
	 }
			
	 </script> 
		
	</div>
		<div class="footer text-center navbar-fixed-bottom">
		<?php include('footer.php');?>
		</div>
	</body>
</html>