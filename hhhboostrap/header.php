<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/icon.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<style>
	.active>a{
		background:#f3542d !important
	} 
</style>
</head>
<?php
	include('connect.php');
	session_start();
	function active($currect_page){
		$url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
		$url = end($url_array);
		if($currect_page == $url){
			echo 'active';
		}
	}
// echo "<pre>";print_r($_SESSION);exit;
?>
<body>

<nav class="navbar navbar-inverse" >
  <div class="container-fluid">
    <div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=	"#bs-example-navbar-collapse-1" aria-expanded="false">
		   <span class="sr-only">Toggle navigation</span>
		   <span class="icon-bar"></span>
		   <span class="icon-bar"></span>
		   <span class="icon-bar"></span>
		</button>
     <a class="navbar-brand" href="index.php"><img src= "image/logo3.png" style="width: 150px;"></a>
	</div>
	  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">	
    <ul class="nav navbar-nav">
		<li class="<?php active('index.php');?>"> <a   href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
		<li class="<?php active('about.php');?>"> <a  href="about.php"><span class="glyphicon glyphicon-info-sign"></span> About</a></li>
		<li class="<?php active('datatable.php');?>"><a   href="datatable.php"><i class="fa fa-users" aria-hidden="true"></i> Volunteers</a></li>
		<li class="<?php active('contact.php');?>"><a   href="contact.php"><i class="" aria-hidden="true"></i> Contact</a></li>	  
	 </ul>
	 <ul class="nav navbar-nav navbar-right">
    <?php
				if(isset($_SESSION['id']) && $_SESSION['id'] != ""){
				$id=$_SESSION['id'];
				$sql="SELECT * FROM volunteers WHERE id='".$id."'";
				$row=mysqli_query($con,$sql);
				 while($res=mysqli_fetch_assoc($row)){
				?>
				<li><?php if(!$res['image']==""){?>
					 <a href="#" style="color:white"><img src="uploads/<?php echo $res['image'];?>"  alt=" "class="img-rounded"  height="20" width="50">
					<?php }
					else{?>
						<input type="hidden" name="hidden_image" value="<?php echo $res['image'];?>">
				 <?php } }?>
					
					 </a></li>
				<li class="<?php active('profile.php');?>"> <a href="profile.php"> <?php if(isset($_SESSION['role'])){ echo $_SESSION['name']; } ?></a></li>
				<li> <a class="<?php active('login.php');?>"  href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
					
				<?php
				}else{
					?>
					<li class="<?php active('registration.php');?>" ><a href="registration.php"><span class="glyphicon glyphicon-pencil"></span> Register</a></li>
				<li class="<?php active('login.php');?>"> <a  href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>	
					<?php
				}
				?>
							
			</ul>
			</div>
			
  </div>
</nav>
  


</body>
</html>
