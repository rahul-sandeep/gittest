<?php
	include ('connect.php');
	if (isset( $_POST) && !empty($_POST)) 
	{
		if($_FILES["fileToUpload"]["name"]==''){
				$filename = $_POST['hidden_image'];
		}else{
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			if(file_exists($target_file)){
				$i=0;
				list($name, $ext) = explode('.', $target_file);
				while(file_exists($target_file)) {
					$i++;
					$target_file = $name. $i . '.' . $ext;
					$name1=explode('uploads/',$target_file);
					$filename = $name1[1];
				}
			}else{
				$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
				$filename=basename($_FILES["fileToUpload"]["name"]);
			}
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			

			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 10000000) {
				$imgerror = "Sorry, your file is too large.";
				$uploadOk = 0;
			}
		// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$imgerror =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
		// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo json_encode(array('status'=>'0','output'=>$imgerror));exit;
				//print_r($imgerror);exit;
			}else{
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}
			//$upload=basename($_FILES["fileToUpload"]["name"]);
		}
		$id = $_POST['id'];
		$name=$_POST['fullname'];
		$email=$_POST['email'];
		$mobilenumber=$_POST['mobilenumber'];
		$country=$_POST['country'];
		$state=$_POST['state'];
		$address=$_POST['address'];
		$gender=$_POST['gender'];
		$role=$_POST['role']; 
		$sql = "UPDATE volunteers SET name='".$name."',email='".$email."',mobile='".$mobilenumber."',country='".$country."',state='".$state."',gender='".$gender."',role='".$role."',image='".$filename."' WHERE id =  '".$id."'" ;
		if($con->query($sql)==true){
			$query = "DELETE FROM mission WHERE user_mid = '$id'";
			mysqli_query($con,$query);
			foreach ($_POST['mission'] as $mis) {
				$sql1 = "INSERT INTO mission(user_mid,mission_name, started_at, updated_at)VALUES('".$id."','".$mis."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";
				$row=mysqli_query($con,$sql1);
			   
			}
					   
			$query1 = "DELETE FROM skills WHERE skill_userid = '$id'";
			mysqli_query($con,$query1);
			if(isset($_POST['skill_name'])){
				foreach ($_POST['skill_name'] as $array=>$skill_name) {
				  $name=$skill_name;
				  $prof=$_POST['skill_profiency'][$array];
				  $exp=$_POST['skill_exp'][$array];
				  
				  $qer2 = "INSERT INTO skills(skill_userid,skill_name, proficiency,experience,created, updated)VALUES('".$id."','".$name."','".$prof."','".$exp."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')"; 
				   $row1=mysqli_query($con,$qer2);
				}
			}
			echo json_encode(array('status'=>"1",'output'=>'success'));
		}
	}	
?>


		