<!DOCTYPE html>
<html>
	<head>
		<style> .error{ color:red; } </style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body>
		<?php 
			include ('header.php');
			include ('connect.php');
				$id = $_GET['id'];
					//echo 'hello'.($id);exit;
				$sql = "SELECT * from volunteers where id='".$id."'";
				$row = mysqli_query($con,$sql); 
				$res = mysqli_fetch_assoc($row);
				$query1="SELECT * FROM mission WHERE user_mid='".$id."'";
				$row1=mysqli_query($con,$query1);
				
				$query2="SELECT * FROM skills WHERE skill_userid='".$id."' ORDER BY skill_id ASC";
				$row2=mysqli_query($con,$query2);

		?>

<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
			<div class="col-md-8 reg_bg mar_t50">
				<h1>Edit Form</h1>
			
					<input type="hidden" value="<?php echo $res['country'];?>" id="cid">
					<input type="hidden" value="<?php echo $res['state'];?>" id="state_id">
				<?php if((isset($_SESSION['id']) && $_SESSION['id']!=="" ))
				{?>
					<form action ="update.php" method = "post"  enctype="multipart/form-data" id="updateform">
						<input type="hidden" name="id" id="userID" value="<?php echo $res['id'];?>" >
						<div class="form-group">
							<label><b>Full Name :</b></label>
							<input type ="text" name="fullname" id="fullname" value="<?php echo $res['name']?>" class="form-control">
							<span id="nameerror" class="error" >
						</div>
						<div class="form-group">
							<label><b>Email :</b></label>
							<input type ="text" name="email" id="email" value="<?php echo $res['email']?>" class="form-control">
							<span id="emailerror" class="error" >
						</div>
						<div class="form-group">
							<label><b>Mobile No :</b></label>
							<input type ="text" name="mobilenumber" id="mobilenumber" value="<?php echo $res['mobile']?>"  class="form-control">
							<span id="mobileerror" class="error" >
						</div>	
						<div class="form-group">
							<label><b>Country:</b></label>
							<select name="country" id="country" value="<?php echo $res['country']?>" class="form-control" 	onchange="countrySelected()">
								<option value="">Select Country</option>
							</select>
							<span id="countryerror" class="error" >
						</div>
						<div class="form-group">
						<label><b>State:</b></label>
							<select name="state" id="state" value="<?php echo $res['state']?>" class="form-control">
							<option value="">Select State</option>
							</select>
							<span id="stateerror" class="error" >
						</div> 
						<div class="form-group">
							<label><b>Address:</b></label><textarea rows="5" cols="25" name="address" id="address"  class="form-control"><?php echo $res['address']?></textarea>
							<span id="addresserror" class="error" >
						</div>

						<div class="form-group">
							<label><b>Gender:</b></label>
							<input type="radio" name="gender" id="male" value="male" <?php if( $res['gender']=="male"){?> checked="true" <?php } ?> > Male
							<input type="radio" name="gender" id="female" value="female" <?php if( $res['gender']=="female"){?> checked="true" <?php } ?>> Female
							<span id="gendererror" class="error" >
							</div>
							<div class="form-group">	  
							<label for="skill">Skills:</label>
							<input type="button" class=" btn-info  pull-right " onclick="add_skill()" value="Add Skill">

							<table class="table table-borderless" id="skill_set">
							<tr>
							<th>Skill Name</th>
							<th>Proficiency</th>
							<th>Experience</th>
							</tr>

							<?php 
												$i=0;	
													while( $res2=mysqli_fetch_assoc($row2)) {		
													$i++;
												?> 

							<tr id="row<?php echo $i?>">
							<td ><input class="form-control" type="text" name="skill_name[]" id="skillname<?php echo $i;?>" value="<?php echo $res2['skill_name'];?>"><br>
							<span id="skillerror<?php echo $i?>" class="error" >
							</td>
							<td>
							<select class="form-control" id="skillprofiency<?php echo $i;?>" name="skill_profiency[]">
							<option <?php  if($res2['proficiency']=='Beginner'){echo'selected';} ?>>Beginner
							</option>
							<option <?php  if($res2['proficiency']=='Intermediate'){echo'selected';} ?>>Intermediate
							</option>
							<option <?php  if($res2['proficiency']=='Expert'){echo'selected';} ?>>Expert
							</option ></select>
							<span id="proferror<?php echo $i?>" class="error" >

							</td>
							<td >
							<select class="form-control" id="skillexp<?php echo $i;?>" name="skill_exp[]">

							<option <?php  if($res2['experience']==1){echo'selected';} ?>>1
							</option>
							<option <?php  if($res2['experience']==2){echo'selected';} ?>>2
							</option>
							<option <?php  if($res2['experience']==3){echo'selected';} ?>>3
							</option >
							<option <?php  if($res2['experience']==4){echo'selected';} ?>>4
							</option>
							<option <?php  if($res2['experience']==5){echo'selected';} ?>>5
							</option>
							</select>

							<span id="experror<?php echo $i?>" class="error" ></span></font>
							</td>
								<td><a href="javascript:void(0);" id="<?php echo $i?>" class="remove" >Remove</a></td>
							</tr>
							<?php }?>					
							</table>
							
							</div>

						
						<div class="clearfix"></div>
						<div class="form-group">
							<label><b>Role :</b></label>
							<select name="role" id="role" class="form-control">
							<option value="" >select</option>
							<option value="Admin" <?php if($res['role']=="Admin") echo 'selected="selected"'; ?>>Admin</option>
							<option value="volunteer" <?php if($res['role']=="volunteer") echo 'selected="selected"'; ?>>volunteer</option>
							</select>
							<span id="roleerror" class="error" >
						</div>
						<div class="custom-control custom-checkbox">
							<label><b>Missions :</b></label>
							<?php 
								$misar = array();
								 while($res1 = mysqli_fetch_assoc($row1))
								   {
									  array_push($misar,$res1['mission_name']); 
								   
								   }
								   
							?>  
							<input type="checkbox" name="mission[]" id="mission1" value="education" <?php if(in_array("education", $misar)) echo 'checked="checked"'; ?>>   education mission
							<input type="checkbox" name="mission[]" id= "mission2" value="sahaya"  <?php if(in_array("sahaya", $misar)) echo 'checked="checked"'; ?>>sahaya mission
							<input type="checkbox" name="mission[]" id= "mission3" value="sevarth"  <?php if(in_array("sevarth", $misar)) echo 'checked="checked"'; ?>>sevarth mission
							<span id="missionerror" class="error" >
						</div><br>
						<div class="form-group">
							<input type="file" name="fileToUpload" id="fileToUpload">
							<?php if(!$res['image']==""){?>
					 <span><img src="uploads/<?php echo $res['image'];?>" alt=" " height="50" width="50"></span>
					<?php }?>
					
						<input type="hidden" name="hidden_image" value="<?php echo $res['image'];?>"><span id="imageerror" class="error">

						</div>

						<div class= "form-group">
							<input type= "button" class="btn btn-primary center-block" onclick="validation()" value= "update" id="sumbit" >
						</div>
					</form>
			</div>
		</div>
	</div>

		<?php }
		else{
			header('Location:login.php');
			}
		?>
		<script>
		
			$(document).ready(function(){
				var baseUrl = 'http://localhost/tasks/mywork/';
				var id=$("#cid").val();
				//return false;
				$.ajax({
					url:baseUrl+'country.php',
					//cache: false,
					//contentType: false,
					//processData: false,
					type:"POST",
					data:{id:id},
					dataType:'html',
				   success:function(result){
					$('#country').append(result); 
					countrySelected();
					}
		   
				});

			});

			function countrySelected(){
				var id= document.getElementById("country").value;
				var userID= document.getElementById("userID").value;
				//alert(id);
				var baseUrl = 'http://localhost/tasks/boostrap/';
				$.ajax({
					url:baseUrl+'states.php',
					type:"POST",
					data:{id:id,
						uid:userID},
					dataType:'html',
					 success:function(result){
						$('#state').html(result);  
						}
					   
					});
			};
			
			function validation() {
				var fullname = document.getElementById("fullname").value;			
				var email= document.getElementById("email").value;
				var mobileNo = document.getElementById("mobilenumber").value;
				//var country = document.getElementById("country").value;
				//var state = document.getElementById("state").value;
				var address = document.getElementById("address").value;
				//var genders = document.getElementsByName("gender");
				var role = document.getElementById("role").value;
				//var image = document.getElementById("fileToUpload").value;
				
				var usercheck  = /^[a-zA-Z. ]{3,30}$/;
				var emailcheck = /\S+@\S+\.\S+/;
				var mobilecheck = /^[0-9]{10}$/;
				var valid=0;
				
				// Empty Checking...
				if(fullname==""){				
					document.getElementById("nameerror").innerHTML="please enter  full name";
					valid=1;
					// Checking RegularExp....
				}else if(fullname!=""){		
					if(usercheck.test(fullname)){
						document.getElementById("nameerror").innerHTML= "";
					}else{
						document.getElementById("nameerror").innerHTML="*username is invalid";
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
				if(address==""){				
					document.getElementById("addresserror").innerHTML="please enter address";
					valid=1;
					// Checking RegularExp....
				}else {
					document.getElementById("addresserror").innerHTML= "";					
				}
				
				//validation for dynamic skills...
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
				if(role==""){				
					document.getElementById("roleerror").innerHTML="please select role";
					valid=1;
					// Checking RegularExp....
				}else {
					document.getElementById("roleerror").innerHTML= "";					
				}
				
				//check box validation
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
				if (valid ==0){
					var formData = new FormData($('#updateform')[0]);
					var baseUrl = 'http://localhost/tasks/boostrap/';
					$.ajax({
						url:baseUrl+'update.php',
						type:"POST",
						cache: false,
						contentType: false,
						processData: false,
						data: formData,
						dataType:'json',
						success:function(result){
							if(result.status == '0'){
								$('#imageerror').html(result.output);
							}else if(result.output=='success'){
								window.location = baseUrl+'data.php';
							} 
					   },
					   error:function(){
						   alert("error");
					   }
					});
				}
			}
	
			var i = $('#skill_set >tbody >tr').length;

				
				function add_skill(){
					
				   $('#skill_set').append(
				   '<tr id="row'+i+'" ><td><input type="text" class="form-control" name="skill_name[]" id="skillname'+i+'" onchange="changed(this)"  ><span id="skillerror'+i+'" class="error" ></td><td><select name="skill_profiency[]" class="form-control" id="skillprofiency'+i+'" ><option value="">Select Proficiency</option><option>Beginner</option><option>Intermediate</option><option>Expert</option></select><span id="proferror'+i+'" class="error" ></td><td><select class="form-control" name="skill_exp[]" id="skillexp'+i+'"><option value="">Select Year</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option></select><span id="experror'+i+'" class="error" ></td><td><a href="javascript:void(0);" id="'+i+'" class="remove" >Remove</a></td><input type="hidden" id="hidden_id" value="skill'+i+'"></tr>');  
					i++;  

				}
	
							$('#skill_set').on('click', '.remove', function(){
							var id = $(this).attr("id"); 
							$('#userid').val(id);
									$('#myModal').show();
									$('.modal-title').html("Remove Confirmation");
	
							});
												
							function close_box(id){
								$('#myModal').hide();
							}

							function del(id){
								$('#myModal').hide();
								var id = $("#userid").val();
								//alert(id);
								$('#row'+id+'').remove();
							};
							
							
							
							function changed(i){
				
                        var skill_name = $('input[name="skill_name[]"]').map(function () {
                        return this.value.toUpperCase();
                            }).get();
						var	sname = jQuery.grep(skill_name, function(n){ return (n); });							
							console.log(sname);
							
                        sname.splice(-1, sname.length);
                         var id= $(i).attr('id').split('skillname');
                            var skills=[];
                        var skill_id=$('#skillname'+id[1]+'').val().toUpperCase();
                        
                          var item1=jQuery.inArray(skill_id,sname);
                            if(item1!=-1){
                                alert("This skill is already exist");
                                $('#row'+id[1]+'').remove();
                                
                            } 

                    }
		</script>
		
	</div>
		<div class="footer text-center navbar-bottom">
		<?php include('footer.php');?>
		</div>
</body>
</html>
