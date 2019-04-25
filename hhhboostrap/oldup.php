
		<?php 
			
			include ('connect.php');
			//print_r($_POST);
			//EXIT;
		?>
		<?php
		if(isset($_POST))
		{
			if($_FILES["fileToUpload"]["name"]==''){
					   $upload = $_POST['hidden_image'];

				}
			   else{
					$target_dir = "uploads/";
					$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if($check !== false) {
						echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						echo "File is not an image.";
						$uploadOk = 0;
					}

				// Check file size
					if ($_FILES["fileToUpload"]["size"] > 10000000) {
						echo "Sorry, your file is too large.";
						$uploadOk = 0;
					}
				// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
						echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						$uploadOk = 0;
					}
				// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
							echo "Sorry, your file was not uploaded.";exit;
						// if everything is ok, try to upload file
						} else {
							if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
								echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
							} else {
								echo "Sorry, there was an error uploading your file.";
							}
						
						}
						$upload=basename($_FILES["fileToUpload"]["name"]);
				}
		
				//echo $upload;exit;
				$id = $_POST['id'];
				$name=$_POST['fullname'];
				$email=$_POST['email'];
				$mobilenumber=$_POST['mobilenumber'];
				
				if(isset($_POST)){
			
		$sql = "UPDATE volunteers SET name='".$name."',email='".$email."',mobile='".$mobilenumber."' ,image='".$upload."' WHERE id =  '".$id."'" ;
		$row=mysqli_query($con,$sql);
		//if($con->query($sql)==true){
			 $query1 = "DELETE FROM skills WHERE skill_userid = '$id'";
					   mysqli_query($con,$query1);
						if(isset($_POST['skill_name'])){
						 foreach ($_POST['skill_name'] as $array=>$skill_name) {
							  $name=$skill_name;
							  $prof=$_POST['skill_profiency'][$array];
							  $exp=$_POST['skill_exp'][$array];
							  
							  $qer2 = "INSERT INTO skills(skill_userid,skill_name, proficiency,experience,created, updated)VALUES('".$id."','".$name."','".$prof."','".$exp."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')"; 
							   $row1=mysqli_query($con,$qer2);
						//print_r($qer2);exit;
						}
			
							
			header('Location:profile.php');
		}
	}	
	}

$con->close();
			
?>
