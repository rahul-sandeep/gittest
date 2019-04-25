<html>
<?php include('header.php');?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php if((isset($_SESSION['id']) && $_SESSION['id']!=="" )){?>

<div class="container">
	<div class="wrapper1 ">
		<section class="content-header">
			<h2>Volunteers List</h2>
		</section>
		<br>
<div id="mytable" class="table-responsive">
	<table id="volunteers" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="80%" >
		<thead>
		<tr style="background-color: #f3542d;">                    
			<td>S.NO</td>
			<td>Profile Pic</td>
			<td>Full name</td>
			<td>Mobile</td>
			<td>Country</td>
			<td>State</td>
			<td>Missions</td>
			<td>Role</td>
			<?php if(isset($_SESSION['role']) && $_SESSION['role']=='Admin'){?>
			<td>Actions</td>
			<?php }
			else { ?>
			<td>Gender</td>
			 <?php }?>
			
		</tr>
	</thead>

</table>

</div>
</div>




</div>
<?php }

else{
	header('Location:login.php');
}?>

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
				  window.location = baseUrl+'datatable.php';
		}
	   
	});

}


$(document).ready(function(){
	 $.ajax({
            type: 'GET',
            dataType:'json',
            url:baseUrl+'volunteers_data.php',
            success:function(data){
				  $('#volunteers').dataTable({
					"aaData"    : data.aaData,
					 "aoColumns"   : [
						{ "mData": "sno" },
						{ "mData": "image" },
						{ "mData": "fullname" },
						{ "mData": "Mobile Number" },
						{ "mData": "country" },
						{ "mData": "state" },
						{ "mData": "Missions" },
						{ "mData": "role" },
						{ "mData": "actions" },
						
						
				
					]  
				});  
				  
			}
	 });
	
});

</script>
<div class="icon_bar_eee">
		  <a href="#" class="facebook"><i class="fa fa-facebook"></i></a> 
		  <a href="#" class="twitter"><i class="fa fa-twitter"></i></a> 
		  <a href="#" class="google"><i class="fa fa-google"></i></a> 
		  <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
		  <a href="#" class="youtube"><i class="fa fa-youtube"></i></a> 
		</div>   
<div class="footer text-center navbar-bottom">
<?php
	include ('footer.php')
	?>
</div>
</html>



