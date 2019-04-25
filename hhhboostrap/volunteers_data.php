<?php
session_start();
if((isset($_SESSION['id']) && $_SESSION['id']!=="" )){
include('connect.php');
$sql="SELECT * FROM volunteers ORDER BY id ASC ";
$row=mysqli_query($con,$sql);
$count=0;
$count1=0;
while($res=mysqli_fetch_assoc($row)){ 

	$count++;
	$data[$count1]['sno']=$count;
	 if(!$res['image']=="")
		{
		$data[$count1]['image']='<span><img src="uploads/'.$res['image'].'" alt=" " height="50" width="50"></span>';
	 }
		else
		{
		$data[$count1]['image']='<input type="hidden" name="hidden_image" value="'. $res['image'].'">';
	 }
	$data[$count1]['fullname']=ucfirst($res['name']);
	$data[$count1]['Mobile Number']=ucfirst($res['mobile']);
	
	$id=$res['country'];
	$query="SELECT countryname FROM country LEFT JOIN volunteers ON country.cid ='".$id."' ";
		$row1=mysqli_query($con,$query);
		$res1=mysqli_fetch_assoc($row1);
		$data[$count1]['country']=$res1['countryname'];
	$state_id=$res['state'];
		$query="SELECT state_name FROM states LEFT JOIN volunteers ON states.state_id ='".$state_id."' ";
		$row1=mysqli_query($con,$query);
		$res1=mysqli_fetch_assoc($row1);
		$data[$count1]['state']=$res1['state_name']; 
	$var = '';
	$user_mid = $res['id'];
	$sql1 = "SELECT * FROM mission WHERE user_mid=".$res['id'];
	$roww = mysqli_query($con,$sql1);  
	while($res1 = mysqli_fetch_assoc($roww)){
			$var .= $res1['mission_name'].',';                            
		}
		 $data[$count1]['Missions']=rtrim($var,',');
	$data[$count1]['role']=$res['role'];
	if($_SESSION['role']=='Admin'){
			$data[$count1]['actions']='<a href="edit.php?id='.$res['id'].'">Edit</a> <a href="#" onclick="confirm('.$res['id'].')">Delete</a>';
            }
		else	 {
	$data[$count1]['actions']=$res['gender'];
		}	
			 
	$count1++;	 
 
 }
					$avdata['aaData']=$data;	
					echo json_encode($avdata);

}
	else{
		header('Location:login.php');
	}	
	
?>

		