<!DOCTYPE html>
<html>
<?php 
	 include ('header.php');
?>
<div class="row">
    <div class="col-md-4 col-md-offset-3">
        <h2>Contact Us</h2> Got a question ? Feedback? Awesome!
        <p>
            Send your message in the form below and we will get back to you as early as possible.
        </p>
        <form role="form" method="post" id="reused_form"   >
            <div class="form-group">
                <label for="name"> Name:</label>  
                <input type="text" class="form-control" id="name" name="name" >

            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" >
            </div>
            <div class="form-group">
                <label for="name"> Message:</label>  
                <textarea class="form-control" type="textarea" name="message" id="message"
				placeholder="Your Message Here" maxlength="6000" rows="7"></textarea>
            </div>

			<div class="row" style="margin-bottom:30px;">
			  <div class="col-sm-5">
				<img src="captcha.php" id="captcha_image"/><br/> <a id="captcha_reload" href="#">reload</a>
			  </div>
			  <div class="col-sm-6">
				<label for="email">Enter the code from the image here:</label>
				<input type="text" class="form-control"  name="captcha" >
			  </div>
            </div>
            <button type="submit" class="btn btn-lg btn-success pull-right" id="btnContactUs">Post It! →</button>
        </form>
        <div id="success_message" style="width:100%; height:100%; display:none; ">
            <h3>Sent your message successfully!</h3>
        </div>
       
    </div>
	<div class="col-md-4 ">
		<h3 class="orange">Address</h3>
		
		<p>HHH Organisation, Moti Nagar,&nbsp;<br />Hyderabad - 500072, India.</p>

		<p>+91-9966123456<br>040-4444444 
		</p>

		<p>info@yourdomain.com</p>
		</div>

</div>

		
<script>

</script>
</html>