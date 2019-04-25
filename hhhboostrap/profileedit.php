<!DOCTYPE html>
<html>
	<head>
	<style> .error{ color:red; } </style>
	</head>
	<body>
		<?php 
			include ('header.php');
			include ('connect.php');
				$id = $_SESSION['id'];
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
					<h1 class= "text-center">Welcome</h1>
					<h3>update your profile</h3>
				</div>
				
				<?php if((isset($_SESSION['id']) && $_SESSION['id']!=="" )){?>
				<form action ="up.php" method = "post" id="upform" enctype=	"multipart/form-data">
				<input type="hidden" name="id" id="userID" value="<?php echo $res['id'];?>" >
					<div class="container">
					<div class="col-md-8 reg_bg ">
					<div class="form-group">
						<label><b> Name :</b></label>
						<input type ="text" name="fullname" id="fullname" value="<?php echo $res['name']?>" class="form-control">
						<span id="nameerror" class="error" >
					</div>
					<div class="form-group">
						<label><b> Email :</b></label>
						<input type ="text" name="email" id="email" value="<?php echo $res['email']?>" class="form-control">
						<span id="emailerror" class="error" >
					</div>
					<div class="form-group">
						<label><b> Mobile No :</b></label>
						<input type ="text" name="mobilenumber" id="mobilenumber" value="<?php echo $res['mobile']?>"  class="form-control">
						<span id="mobileerror" class="error" >
					</div>
					<div class="form-group">
					<input type="file" name="fileToUpload" id="fileToUpload">
					<?php if(!$res['image']==""){?>
					 <span><img src="uploads/<?php echo $res['image'];?>" alt=" " height="50" width="50"><br><a href="#" onclick="confirm(<?php echo $res['id'];?>)">Remove image</a></span>
					<?php }
					else{?>
						<input type="hidden" name="hidden_image" value="<?php echo $res['image'];?>">
					<?php }?>
					 
					 <span id="imageerror" class="error" >
					 </div>
					<input type="hidden" name="hidden_image" value="<?php echo $res['image'];?>">
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


				
					<div class= "center-block">
				<input type= "button" class="btn btn-primary  " value= "Update" onclick="validation()" id="sumbit" >
					<input class="btn btn-primary" type="button" onclick="window.location.replace('profile.php')" value="Cancel" />
					</div>
			</form>
		
		</div>
		</div>
			<?php }
				else{
				header('Location:login.php');
				}
			?>
			<script>
			function validation() {
				var fullname = document.getElementById("fullname").value;			
				var email= document.getElementById("email").value;
				var mobileNo = document.getElementById("mobilenumber").value;
				var usercheck  = /^[a-zA-Z. ]{3,30}$/;
				var emailcheck = /\S+@\S+\.\S+/;
				var mobilecheck = /^[0-9]{10}$/;
				var valid=0;
				
				if(fullname==""){				
					document.getElementById("nameerror").innerHTML="please enter  full name";
					return false;
					// Checking RegularExp....
				}else if(fullname!=""){		
					if(usercheck.test(fullname)){
						document.getElementById("nameerror").innerHTML= "";
					}else{
						document.getElementById("nameerror").innerHTML="*username is invalid";
						return false;
					}
					
				}
				// Empty Checking...
				if(email==""){				
					document.getElementById("emailerror").innerHTML="please enter valid email";
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
				if(mobileNo==""){				
					document.getElementById("mobileerror").innerHTML="please enter valid mobile";
					return false;
					// Checking RegularExp....
				}else if(mobileNo!=""){		
					if(mobilecheck.test(mobileNo)){
						document.getElementById("mobileerror").innerHTML= "";
					}else{
						document.getElementById("mobileerror").innerHTML="*mobile is invalid";
						return false;
					}
					
				}
				
				
				//validation for dynamic skills...
				var skill1 = document.getElementsByName("skill_name[]");
				
				var proficiency1 = document.getElementsByName("skill_profiency[]");			
				var experience1 = document.getElementsByName("skill_exp[]");
				
				$('[id^=skillname]').each(function() {
					var getid = this.id;
					//alert(getid);
					intid = getid.replace(/[A-Za-z$-]/g, "");
					//alert (intid);
					var sname=document.getElementById(this.id).value;
					//alert(intid+'------'+sname);
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
		 
				if (valid ==0){
					var formData = new FormData($('#upform')[0]);
					var baseUrl = 'http://localhost/tasks/boostrap/';
					$.ajax({
						url:baseUrl+'up.php',
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
								window.location = baseUrl+'profile.php';
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
				   '<tr id="row'+i+'" ><td><input type="text" class="form-control" name="skill_name[]" id="skillname'+i+'" onchange="changed(this)" ><span id="skillerror'+i+'" class="error" ></td><td><select name="skill_profiency[]" class="form-control" id="skillprofiency'+i+'" ><option value="">Select Proficiency</option><option>Beginner</option><option>Intermediate</option><option>Expert</option></select><span id="proferror'+i+'" class="error" ></td><td><select class="form-control" name="skill_exp[]" id="skillexp'+i+'"><option value="">Select Year</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option></select><span id="experror'+i+'" class="error" ></td><td><a href="javascript:void(0);" id="'+i+'" class="remove" >Remove</a></td><input type="hidden" id="hidden_id" value="skill'+i+'"></tr>');  
					i++;  

				}
	
							$('#skill_set').on('click', '.remove', function(){
								status=1;
							var id = $(this).attr("id"); 
							$('#status').val(status);
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
								var status=$("#status").val();
								if(status==1){
					
								$('#row'+id+'').remove();
								}
								if(status==2){
										$.ajax({
										url:baseUrl+'remove_image.php',
										type:"GET",
										data:{id:id},
										dataType:'html',
									   success:function(result){ 
												  window.location = baseUrl+'profileedit.php';
									 }
									   
									});
								}
							}
							
							
							var baseUrl = 'http://localhost/tasks/boostrap/';
								function confirm(id){
									var userid=id;
									status=2;
									//alert(userid);
									$('#userid').val(userid);
									$('#status').val(status);
									$('#myModal').show();
									
								}
								function close_box(){
									$('#myModal').hide();
								}

								/* function del(id){
									$('#myModal').hide();
									var id = $("#userid").val();
									
									$.ajax({
										url:baseUrl+'remove_image.php',
										type:"GET",
										data:{id:id},
										dataType:'html',
									   success:function(result){ 
												  window.location = baseUrl+'profileedit.php';
									 }
									   
									});

								}
								 */
								
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

			
				