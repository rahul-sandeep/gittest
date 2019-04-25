<!DOCTYPE html>
<html>
	 <head>
  <style> .error{ color:red; } </style>
  </head>
	<body>
		<?php 
			include ('header.php');
		?>
		
					<div class="form-group">
					<label for="skill"><u>Add Skills</u></label><br>
					<div class ="row" id="row">					
						<div class="col-md-4">
						<label>Name of Skill:</label>
						<input type ="text" name="skill" id="skill" class="form-control">
						<span id="skillerror" class="error" >
						</div>
						<div class="col-md-4">
						<label>Proficiency :</label>
							<select name="proficiency" id="proficiency" class="form-control">
							<option value="">select</option>
							<option value="beginner">Beginner</option>
							<option value="intermediate">Intermediate</option>
							<option value="expert">Expert</option>
							<span id="proferror" class="error" >
							</select>
							</div>
							<div class="col-md-4">
						<label>Years of Experience :</label>
							<select name="experience" id="experience" class="form-control">
							<option value="">select</option>
							<option value="1">01</option>
							<option value="2">02</option>
							<option value="3">03</option>
							<option value="4">04</option>
							<option value="5">05</option>
							<span id="experror" class="error" >
							</select><br>
					</div>
					<input type="button" onclick="addlist()" value="Add" />
					</div>
					

				
				</div>
				<script>
				var i=1;

				function addlist() 
				{
				  var div1 = document.createElement('div');
				  var id=i;
					i++;
				  div1.innerHTML =  ' <input type ="text" name="skill" id="skill" class="form-control">' + ' <select name="proficiency" id="proficiency" class="form-control"><option value="">select</option<option value="beginner">Beginner</option><option value="intermediate">Intermediate</option><option value="expert">Expert</option><span id="proferror" class="error" ></select>' + '<select name="experience" id="experience" class="form-control"><option value="">select</option><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option></select>
					<input type="button"  onclick="rem(this)" value="remove" />';
				  
				  document.getElementById('row').appendChild(div1);
				}
				function rem(div1) {
					document.getElementById('row').removeChild(div1.parentNode);
					i--;
				}
			</script>
	</html>