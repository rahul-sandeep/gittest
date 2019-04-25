<html>

	<?php
		include('header.php');
		include('connect.php');
		$id = $_SESSION['id'];
		$sql="SELECT * FROM volunteers where id ='".$id."'" ;
		$row=mysqli_query($con,$sql);
	?>
<div class="container well">
	<div class="row-fluid">	
		<h3>My Profile</h3>
		<?php if((isset($_SESSION['id']) && $_SESSION['id']!=="" )){?>
		  <div class="col-md-2">
		  <?php while($res=mysqli_fetch_assoc($row)){ ?>
		  <img src="uploads/<?php echo $res['image'];?>" alt=" " style="width:150px;height:150px;" class="img-circle">
			</div>
			
		  <div class="col-md-5">
		   <div class="row">
				
			  <label for="name" class="col-sm-3 control-label">Full Name:</label>
				<?php echo $res['name'] ?></div>
				<div class="row">
			 <label for="email" class="col-sm-3 control-label">Email:</label>
			   <?php echo $res['email'];?></div>
			   <div class="row">
			 <label for="gender" class="col-sm-3 control-label">Gender:</label>
			   <?php echo $res['gender'];?></div>
			    <div class="row">
			   <label for="missions" class="col-sm-3 control-label">Mission:</label>
			   <?php
						$sql1 = "SELECT * FROM mission WHERE user_mid=".$res['id'];
                        $roww = mysqli_query($con,$sql1);  
						  //echo '<pre>'; print_r($roww);
						 ?>
						<?php
                                $var = '';
                                while($res1 = mysqli_fetch_assoc($roww)){
                                    $var .= $res1['mission_name'].',';                            
                                }
                                echo rtrim($var,',');
                            ?>               
							</div>
							<?php } ?>	
				
				
		</div>
	
		<?php }?>							
		 </div>
		 
		 <div class="col-sm-3">
		 <?php if(isset($_SESSION['role']) && $_SESSION['role']=='volunteer'){?>
				<a href="profileedit.php"><input type="button" class="btn btn-primary" value="update profile" ></a>
				<a href="password.php"><input type="button" class="btn btn-primary" value="update password" ></a>
		 </div>
</div>
		<?php }
					else{
						header('Location:login.php');
					}?>	
		<div class="footer text-center navbar-fixed-bottom">
		<?php include('footer.php');?>
		</div>
</html>					