<?php
//print_r($_POST);
// print_r($_FILE;
//exit;
$con = mysqli_connect('localhost','root','','hhh');
if(isset($_POST) && !empty($_POST)){
	$email=$_POST['email'];
	$query="SELECT * FROM volunteers WHERE email='".$email."' ";
	$row = mysqli_query($con,$query);
	$res = mysqli_fetch_assoc($row);
	if($res>0){
		echo json_encode(array('status'=>TRUE,'output'=>'register'));
		exit;
	}
	else
	{
		if(!empty($_FILES["fileToUpload"]["name"])){
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			if(file_exists($target_file)){
				$i=0;
				list($name, $ext) = explode('.', $target_file);
				while(file_exists($target_file)) {
					$i++;
					$target_file = $name. $i . '.' . $ext;
					$name1=explode('uploads/', $target_file);
					$filename = $name1[1];
        
				}
			}
			else{
                $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
                $filename=basename($_FILES["fileToUpload"]["name"]);
            }
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		// Check file size
			if ($_FILES["fileToUpload"]["size"] > 5000000) {
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
				echo json_encode(array('status'=>0,'output'=>$imgerror));exit;
		// if everything is ok, try to upload file
			} else {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
					} else {
						echo "Sorry, there was an error uploading your file.";
					}

				}
		}
		else{
			$filename="";
		}
			//$upload =  basename($_FILES["fileToUpload"]["name"]);
		$name=$_POST['fullname'];
		$email=$_POST['email'];
		$mobilenumber=$_POST['mobilenumber'];
		$country=$_POST['country'];
		$state=$_POST['state'];
		$address=$_POST['address'];
		$gender=$_POST['gender'];
		$password=$_POST['password'];
		$role=$_POST['role'];

		$query="INSERT INTO volunteers (name,email,mobile,country,state,address,gender,password,role,image,registe_date,updated_date) VALUES ('".$name."','".$email."','".$mobilenumber."','".$country."','".$state."','".$address."','".$gender."','".md5($password)."','".$role."','".$filename."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."')";
		//echo $query; exit;
		$roww = mysqli_query($con,$query);
			
			$query1 = 'SELECT MAX(id)as last_id from volunteers';
				$row = mysqli_query($con,$query1);
				$res = mysqli_fetch_assoc($row);
				//print_r ($res);exit;
				foreach ($_POST['mission'] as $mis) {                    
					$qer1 = "INSERT INTO mission(user_mid,mission_name, started_at, updated_at)VALUES('".$res['last_id']."','".$mis."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";
					//print_r ($qer1);exit;
					$row = mysqli_query($con,$qer1);
				}
	
						foreach ($_POST['skill_name'] as $array=>$skill_name) {
							$name=$skill_name;
							$prof=$_POST['skill_profiency'][$array];
							$exp=$_POST['skill_exp'][$array];

							$qer2 = "INSERT INTO skills(skill_userid,skill_name, proficiency,experience,created, updated)VALUES('".$res['last_id']."','".$name."','".$prof."','".$exp."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')"; 
							$row1=mysqli_query($con,$qer2);
						//print_r($qer2);exit;
						}
	   
		echo json_encode(array('status'=>1,'output'=>'success'));
		exit; 
	}
	
		$con->close();
}

?>


		