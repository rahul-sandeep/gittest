<html>
	<?php
		include('header.php');
		include('connect.php');
		$sql="SELECT * FROM volunteers ORDER BY id ASC ";
		$row=mysqli_query($con,$sql);
	?>
	<div align="center" style="min-height:600px" >
		<h1>Volunteer portal</h1>
		<?php if((isset($_SESSION['id']) && $_SESSION['id']!=="" )){?>
		<div class="container">
			<div class="table-responsive">
				<table  class="table table-hover table-bordered " >
					<tr>
						<th>Picture</th>
						<th>Name</th>
						<?php if(isset($_SESSION['role']) && $_SESSION['role']=='Admin'){?>
						<th>Mobile Number</th>
						<?php }?>
						<th>Email</th>
						<th>Gender</th>
						<th>Country</th>
						<th>state</th>
						<th>Missions</th>				
						<th>Role</th>
						<?php if(isset($_SESSION['role']) && $_SESSION['role']=='Admin'){?>
							<th>Actions</th>
						<?php }?>
						
					</tr>
						<?php while($res=mysqli_fetch_assoc($row))
						{ ?>
					<tr>
						<td><?php if(!$res['image']=="")
							{?>
								<span><img src="uploads/<?php echo $res['image'];?>" alt=" " height="50" width="50"></span>
							<?php }
							else
							{?>
								<input type="hidden" name="hidden_image" value="<?php echo $res['image'];?>">
							<?php }	?>
						</td>
						<td class="text-capitalize"><?php echo $res['name'];?></td>
							<?php 
							if(isset($_SESSION['role']) && $_SESSION['role']=='Admin')
							{?>
						<td><?php echo $res['mobile'];?></td><?php 
							}?>
						<td ><?php echo $res['email'];?></td>
						<td class="text-capitalize"><?php echo $res['gender'];?></td>
						<?php
						$id=$res['country'];
						$query="SELECT countryname FROM country LEFT JOIN volunteers ON country.cid ='".$id."' ";
						$row1=mysqli_query($con,$query);
						$res1=mysqli_fetch_assoc($row1);
						?>
						<td class="text-capitalize"><?php echo $res1['countryname'];?></td>
						<?php
						$id=$res['state'];
						$query="SELECT state_name FROM states LEFT JOIN volunteers ON states.state_id ='".$id."' ";
						$row1=mysqli_query($con,$query);
						$res1=mysqli_fetch_assoc($row1);
						?>
						<td class="text-capitalize"><?php echo $res1['state_name'];?></td>
						<?php
							$sql1 = "SELECT * FROM mission WHERE user_mid=".$res['id'];
							$roww = mysqli_query($con,$sql1);  
							  //echo '<pre>'; print_r($roww);
						?>
						<td class="text-capitalize"><?php
								$var = '';
								while($res1 = mysqli_fetch_assoc($roww)){
									$var .= $res1['mission_name'].',';                            
								}
								echo rtrim($var,',');
							?>                         
								
						</td>
						<td class="text-capitalize"><?php echo $res['role'];?></td>
							<?php if(isset($_SESSION['role']) && $_SESSION['role']=='Admin'){?>
								<td><a href="edit.php?id=<?php echo $res['id'];?> ">Edit</a>  <a href="#"  onclick="confirm(<?php echo $res['id'];?>)">Delete</a></td>
							<?php }?>
					</tr>
					<?php } ?>		
				</table>
			</div>
	
		</div>
	</div>
		<div class="icon_bar_eee">
		  <a href="#" class="facebook"><i class="fa fa-facebook"></i></a> 
		  <a href="#" class="twitter"><i class="fa fa-twitter"></i></a> 
		  <a href="#" class="google"><i class="fa fa-google"></i></a> 
		  <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
		  <a href="#" class="youtube"><i class="fa fa-youtube"></i></a> 
		</div>   
<?php	}
		else{
			header('Location:login.php');
		}?>

<!-- boostrap delete modal -->
<script>
	var baseUrl = 'http://localhost/tasks/boostrap/';
	function confirm(id){
		var userid=id;
		//alert(userid);
		$('#userid').val(userid);
		$('#myModal').show();
	
	}
	function close_box(){
		$('#myModal').hide();
	}

function del(id){
	$('#myModal').hide();
	var id = $("#userid").val();
	
	$.ajax({
        url:baseUrl+'delete.php',
        type:"POST",
		data:{id:id},
		dataType:'html',
       success:function(result){ 
				  window.location = baseUrl+'data.php';
		}
	   
	});

}



</script>
<!-- footer -->
		<div class="footer text-center navbar-bottom">
		<?php include('footer.php');?>
		</div>
</html>