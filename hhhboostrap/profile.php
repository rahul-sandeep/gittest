<html>

	<?php
		include('header.php');
		include('connect.php');
		$id = $_SESSION['id'];
		$sql="SELECT * FROM volunteers where id ='".$id."'" ;
		$row=mysqli_query($con,$sql);
	?>
<div class="container well mar_t50 border"> 
	<div class="row-fluid">	
		
		<?php if((isset($_SESSION['id']) && $_SESSION['id']!=="" )){?>
		  <div class="col-md-4">
		  <div class="text-center"><h3>My Profile</h3>
		  <?php while($res=mysqli_fetch_assoc($row)){ ?><?php if(!$res['image']==""){?>
					 <span><img src="uploads/<?php echo $res['image'];?>" alt=" " style="width:150px;height:150px;" class="img-circle"></span>
					<?php }
					else{?>
						<input type="hidden" name="hidden_image" value="<?php echo $res['image'];?>">
					<?php }?>
		  
			</div>
			</div>
			
		  <div class="col-md-5">
		  <h3>&nbsp;</h3>
		   <div class="row">
				
			  <label for="name" class="col-sm-3 col-xs-3 control-label"> Name:</label>
				<div class="col-sm-7  col-xs-6 text-capitalize"><?php echo $res['name'] ?></div></div>
				<div class="row">
			 <label for="email" class="col-sm-3  col-xs-3 control-label"> Email:</label>
			   <div class="col-sm-7  col-xs-6 "><?php echo $res['email'];?></div></div>
			   <div class="row">
			   <label for="mobile" class="col-sm-3  col-xs-3 control-label"> Mobile:</label>
			   <div class="col-sm-7  col-xs-6 "><?php echo $res['mobile'];?></div></div>
			   <div class="row">
			 <label for="gender" class="col-sm-3  col-xs-3 control-label"> Gender:</label>
			   <div class="col-sm-7  col-xs-6 text-capitalize"><?php echo $res['gender'];?></div></div>
			    <div class="row">
			   <label for="missions" class="col-sm-3  col-xs-3 control-label"> Mission:</label>
			   <div class="col-sm-7  col-xs-6 text-capitalize"><?php
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
							</div>
				<div class="row">
			   <label for="missions" class="col-sm-3  col-xs-3 control-label"> skills:</label>
			   <div class="col-sm-7  col-xs-6 text-capitalize"><?php
						$sql2 = "SELECT * FROM skills WHERE skill_userid ='".$res['id']."' ORDER BY skill_id ASC" ;
                        $row2 = mysqli_query($con,$sql2);  
						  //echo '<pre>'; print_r($roww);
						 ?>
						<?php
                                $var = '';
                                while($res2 = mysqli_fetch_assoc($row2)){
                                    $var .= $res2['skill_name'].',';                            
                                }
                                echo rtrim($var,',');
                            ?>               
							</div>
							</div>
							<?php } ?>	
				<div class="clearfix"></div>
				<?php if(isset($_SESSION['role']) && $_SESSION['role']!=''){?>
				<a href="profileedit.php"><input type="button" class="btn btn-primary" value="Update Profile" ></a>
				<a href="password.php"><input type="button" class="btn btn-primary" value="ChangePassword" ></a>
		</div>
	
		<?php }?>							
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