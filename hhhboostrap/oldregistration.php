<!DOCTYPE html>
<html>
	 <head>
  <style> .error{ color:red; } </style>
  </head>
	<body>
		<?php 
			include ('header.php');
		?>

<div class="container">				
	<div class="row">
		<div class="col-md-2"></div>
			<div class="col-md-8 reg_bg mar_t50">
				<h1>Registration</h1>
				<p>Please fill in this form to Register.</p>
				<form action ="volunteers.php" method = "post" 
					enctype="multipart/form-data" id="regform">
					<div class="form-group">
						<label><b>Full Name :</b></label>
						<input type ="text" name="fullname" id="fullname" class="form-control">
						<span id="nameerror" class="error" >
					</div>
					<div class="form-group">
						<label><b>Email :</b></label>
						<input type ="text" name="email" id="email" class="form-control">
						<span id="emailerror" class="error" >
					</div >
					<div class="form-group">
						<label><b>Mobile No :</b></label>
						<input type ="text" name="mobilenumber" id="mobilenumber" class="form-control">
						<span id="mobileerror" class="error" >
					</div>	
					<div class="form-group">
						<label><b>Country:</b></label>
							<select name="country" id="country" class="form-control"  onchange="countrySelected()">
								<option value="">Select Country</option>
							</select>
						<span id="countryerror" class="error" >
					</div>
					<div class="form-group">
					<label><b>State:</b></label>
						<select name="state" id="state" class="form-control">
						<option value="">Select State</option>
						</select>
						<span id="stateerror" class="error" >
					</div> 
					<div class="form-group">
						<label><b>Address:</b></label><textarea rows="5" cols="25" name="address" id="address" class="form-control"></textarea>
						<span id="addresserror" class="error" >
					</div>
							  
					<div class="form-group">
						<label><b>Gender:</b></label>
							<input type="radio" name="gender" id="male" value="male" > Male
							<input type="radio" name="gender" id="female" value="female"> Female
						<br><span id="gendererror" class="error" >
					</div>	
					
					<div class="form-group">
							
						<label for="skill" id="skk">Skills:</label>
							<a href="javascript:void(0);" class="pull-right" onclick="add_skill()">Add Skill</a>
						<!--<input class="pull-right" type="button" onclick="add_skill()" value="Add Skill">-->
						<table class="table table-borderless " id="skillset">
							<tr>
								<th>Name of Skill</th>
								<th>Proficiency</th>
								<th>Experiance</th>
							</tr>
							<tr  id="row1">
								<td ><input type="text" class="form-control" name="skill_name[]"  id="skillname1">
								<span id="skillerror1" class="error" >
								</td>

								<td>
									<select class="form-control" name="skill_profiency[]" id="skillprofiency1" >
										<option value="">Select Proficiency</option>
										<option>Beginner</option>
										<option>Intermediate</option>
										<option>Expert</option>
								</select>

								<span id="proferror1" class="error" >
								</td>

								<td>
									<select  class="form-control"id="skillexp1" name="skill_exp[]" >
										<option value="">Select Year</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
									<span id="experror1" class="error" >
								</td>
						</tr>
						</table>

					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<label><b>Password (alphnumeric-symbol) :</b></label>
						<input type ="password" name="password" id="password" class="form-control">
						<span id="passworderror" class="error" ></span>
					</div>
					
					<div class="form-group">
						<label>Confirm Password :</label>
							<input type ="password" name=" " id="cpassword" class="form-control">
							<span id="cpassworderror" class="error" >
					</div>

					<div class="form-group">
						<label><b>Role :</b></label>
							<select name="role" id="role" class="form-control">
							<option value="">select</option>
							<option value="Admin">Admin</option>
							<option value="volunteer">Volunteer</option>
							</select>
						<span id="roleerror" class="error" ></span>
					</div>
					
					<div class="custom-control custom-checkbox">
						<label class="custom-control-label" ><b>Missions:</b></label>
							<input type="checkbox" class="custom-control-input" name="mission[]" id="mission1" value="education"> Education mission
							<input class="custom-control-input" type="checkbox" name="mission[]" id= "mission2" value="sahaya"> Sahaya mission
							<input class="custom-control-input" type="checkbox" name="mission[]" id= "mission3" value="sevarth"> Sevarth mission
						<br><span id="missionerror" class="error" >

					</div><br>
					<div class=" custom-file">
						<input type="file" class="form-control custom-file-input" name="fileToUpload" id="fileToUpload"><a style="display:none;" id="removeImage" href="#">Remove</a>
						
					</div><br>
					<div class= "form-group">
						<input type= "button" class="btn btn-primary center-block" value= "Submit" id="sumbit" onclick= "validation();" >
					</div>
				</form>
				
			</div>
		</div>
	</div>

		<script>
			$(document).ready(function(){
				var baseUrl = 'http://localhost/tasks/boostrap/';
				$.ajax({
					url:baseUrl+'country.php',
					cache: false,
					contentType: false,
					processData: false,
					type:"GET",
					dataType:'html',
					success:function(result){
						$('#country').append(result);  
					}
				});
			});

			function countrySelected(){
				var id= document.getElementById("country").value;
				//alert(id);
				var baseUrl = 'http://localhost/tasks/boostrap/';
					$.ajax({
						url:baseUrl+'states.php',
						type:"POST",
						data:{id:id},
						dataType:'html',
						 success:function(result){
							$('#state').html(result);  
							}   
					});
			};
			// image removing
			 $("#fileToUpload").change(function() {
			   $("#removeImage").show(); // show remove link
			 });

			 $("#removeImage").click(function(e) {
			   e.preventDefault(); // prevent default action of link
			   $("#fileToUpload").val("");
			   $("#removeImage").hide(); // hide remove link.
			 });
					

			function validation() {
						
				var fullname = document.getElementById("fullname").value;			
				var email= document.getElementById("email").value;
				var mobileNo = document.getElementById("mobilenumber").value;
				var country = document.getElementById("country").value;
				var state = document.getElementById("state").value;
				var address = document.getElementById("address").value;
				var genders = document.getElementsByName("gender");
				var role = document.getElementById("role").value;
				var password = document.getElementById("password").value;
				var cpassword = document.getElementById("cpassword").value;
				var image = document.getElementById("fileToUpload").value;
			
				var usercheck  = /^[a-zA-Z. ]{3,30}$/;
				var emailcheck = /\S+@\S+\.\S+/;
				var mobilecheck = /^[0-9]{10}$/;
				var passwordcheck = /^(?=.*[0-9])(?=.*[@.#$*&^])[a-zA-Z0-9@.#$*&^]{8,16}$/;
				var valid=0;
				// Empty Checking...
				if(fullname==""){				
					document.getElementById("nameerror").innerHTML="please enter  Name";
					valid=1;
					// Checking RegularExp....
				}else if(fullname!=""){		
					if(usercheck.test(fullname)){
						document.getElementById("nameerror").innerHTML= "";
					}else{
						document.getElementById("nameerror").innerHTML="*Name should have min 3 letters";
						valid=1;
					}
					
				}
				// Empty Checking...
				if(email==""){				
					document.getElementById("emailerror").innerHTML="please enter valid email";
					valid=1;
					// Checking RegularExp....
				}else if(email!=""){		
					if(emailcheck.test(email)){
						document.getElementById("emailerror").innerHTML= "";
					}else{
						document.getElementById("emailerror").innerHTML="*email is invalid";
						valid=1;
					}
					
				}
				// Empty Checking...
				if(mobileNo==""){				
					document.getElementById("mobileerror").innerHTML="please enter valid mobile";
					valid=1;
					// Checking RegularExp....
				}else if(mobileNo!=""){		
					if(mobilecheck.test(mobileNo)){
						document.getElementById("mobileerror").innerHTML= "";
					}else{
						document.getElementById("mobileerror").innerHTML="*mobile is invalid";
						valid=1;
					}
					
				}
				// Empty Checking...
				if(country==""){				
					document.getElementById("countryerror").innerHTML="please select country";
					valid=1;
					// Checking RegularExp....
				}else {
					document.getElementById("countryerror").innerHTML= "";					
				}
				
				// Empty Checking...
				if(state==""){				
					document.getElementById("stateerror").innerHTML="please select state ";
					valid=1;
					// Checking RegularExp....
				}else {
					document.getElementById("stateerror").innerHTML= "";					
				 } 
				
				// Empty Checking...
				if(address==""){				
					document.getElementById("addresserror").innerHTML="please enter address";
					valid=1;
					// Checking RegularExp....
				}else {
					document.getElementById("addresserror").innerHTML= "";					
				}
				
				// Empty Checking...
                if (genders[0].checked == true) {
                    document.getElementById("gendererror").innerHTML= "";
                } else if (genders[1].checked == true) {
                   document.getElementById("gendererror").innerHTML= "";
                } else {
					document.getElementById('gendererror').innerHTML = "please select gender";
                    valid=1;
                }
				// skills validation
				var skill1 = document.getElementsByName("skill_name[]");
				var proficiency1 = document.getElementsByName("skill_profiency[]");			
				var experience1 = document.getElementsByName("skill_exp[]");
				$('[id^=skillname]').each(function() {
					var getid = this.id;
					intid = getid.replace(/[A-Za-z$-]/g, "");
					var sname=document.getElementById(this.id).value;

					document.getElementById("skillerror"+intid).innerHTML="";
					if(sname=="") 
					{
						document.getElementById("skillerror"+intid).innerHTML="please enter Skill";
						valid=1;
					} 
					
					
				});
                $('[id^=skillprofiency]').each(function() {
					var getid = this.id;
					//alert(getid);
					intid = getid.replace(/[A-Za-z$-]/g, "");
					var prof=document.getElementById(this.id).value;
					//alert(intid+'------'+prof);
					document.getElementById("proferror"+intid).innerHTML="";
					if(prof=="") 
					{
						document.getElementById("proferror"+intid).innerHTML="please select Proficiency";
						valid=1;
					} 
					
				});
						
					$('[id^=skillexp]').each(function() {
					var getid = this.id;
					intid = getid.replace(/[A-Za-z$-]/g, "");
					//alert (intid);
					var exp=document.getElementById(this.id).value;
					//alert(intid+'------'+exp);
					document.getElementById("experror"+intid).innerHTML="";
					if(exp=="") 
					{
						document.getElementById("experror"+intid).innerHTML="please select experience";
						valid=1;
					} 
					
				});	
				// Empty Checking...
				if(password==""){				
					document.getElementById("passworderror").innerHTML="please enter valid password";
					valid=1;
					// Checking RegularExp....
				}else if(password!=""){		
					if(passwordcheck.test(password)){
						document.getElementById("passworderror").innerHTML= "";
					}else{
						document.getElementById("passworderror").innerHTML="*password must have letters,number & special symbol";
						valid=1;
					}
					
				}
				
				if(cpassword==""){				
					document.getElementById("cpassworderror").innerHTML="please enter valid password";
					valid=1;
					// Checking RegularExp....
				}
				else if(cpassword.match(password)){
				document.getElementById("cpassworderror").innerHTML= " ";
					}
					else{
					document.getElementById("cpassworderror").innerHTML= "*password mismatch";
					valid=1;
				}
				
				// Empty Checking...
				if(role==""){				
					document.getElementById("roleerror").innerHTML="please select role";
					valid=1;
					// Checking RegularExp....
				}else {
					document.getElementById("roleerror").innerHTML= "";					
				}
				
					var chks = document.getElementsByName('mission[]');
					var checkCount = 0;
					for (var i = 0; i < chks.length; i++) {
						if (chks[i].checked) {
							checkCount++;
						}
					}
					if (checkCount < 1) {
					document.getElementById("missionerror").innerHTML="please select role";
					valid=1;
					}
					else {
					document.getElementById("missionerror").innerHTML= "";					
					}
					 
					/*  if(image==""){				
					document.getElementById("imageerror").innerHTML="please upload your image";
					return false;
				}else {
					document.getElementById("imageerror").innerHTML= "";					
				}  */
					 if (valid ==0){
						 alert(valid);
						$('#regform').submit();
					 }
					}
			
			var i=2;
			function add_skill(){
			
			   $('#skillset').append(
			   '<tr id="row'+i+'" ><td><input type="text" class="form-control" name="skill_name[]" id="skillname'+i+'"><span id="skillerror'+i+'" class="error"></td><td><select name="skill_profiency[]" class="form-control" id="skillprofiency'+i+'" ><option value="">Select Proficiency</option><option>Beginner</option><option>Intermediate</option><option>Expert</option></select><span id="proferror'+i+'" class="error" ></span></td><td><select class="form-control" name="skill_exp[]" id="skillexp'+i+'"><option value="">Select Year</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option></select><span id="experror'+i+'" class="error" ></span></td><td><a href="javascript:void(0);" id="'+i+'" class="remove" >Remove</a></td><input type="hidden" id="hidden_id" value="skill'+i+'"></tr>');  
				i++;  

			}
 
							$('#skillset').on('click', '.remove', function(){
							var id = $(this).attr("id");  
		
							$('#row'+id+'').remove();
							});
		</script>
		
	</div>
		<div class="footer text-center navbar-bottom">
		<?php include('footer.php');?>
		</div>
</body>
</html>
