<?php
 session_start();
if(isset($_POST['remember'])){
	$email_cookie='email';
	$email_value=$_POST['email'];
	$password_cookie='password';
	$password_value=$_POST['password'];
	setcookie($email_cookie,$email_value,time() + (86400 * 30), "/");
	setcookie($password_cookie,$password_value,time() + (86400 * 30), "/");
}

	else {
       if(isset($_COOKIE["email"])) {
           setcookie ("email","",time()-60, "/");
              }
               if(isset($_COOKIE["password"])) {
               setcookie ("password","",time()-60, "/");
              }
          }
$con = mysqli_connect('localhost','root','','hhh');
$sql = 'SELECT * FROM volunteers WHERE email = "'.$_POST['email'].'" AND password="'.md5($_POST['password']).'"';
$row = mysqli_query($con,$sql);
$res = mysqli_fetch_assoc($row);
// echo '<pre>';print_r($res);exit;
 
	if($res){
		$_SESSION['id'] = $res['id'];
		$_SESSION['name'] = $res['name'];
		$_SESSION['email'] = $res['email'];
		$_SESSION['password'] = $res['password'];
		$_SESSION['role'] = $res['role'];
		$_SESSION['image'] = $res['image'];
			echo json_encode(array('status'=>TRUE,'output'=>'success','role'=>$res['role'],'id'=>$res['id']));
		}
		else{
			echo json_encode(array('status'=>FALSE,'output'=>'fail'));
		}
$con->close();
?>