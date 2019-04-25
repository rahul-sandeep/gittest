<?php
include('connect.php');
$query="SELECT * FROM country";
$row=mysqli_query($con,$query);
$id=$_POST['id'];
//print_r($id);
//exit;
while($res=mysqli_fetch_assoc($row)){
?>
		
	<option value="<?php echo $res['cid'];?>"<?php if($res['cid']==$id){echo'selected';} ?>><?php echo $res['countryname'];?></option>
<?php
}
?>