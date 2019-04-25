	<footer>
		<div class="footer">
			<h6>*****</h6>
			<span><strong>Copyright 20xx - <a href="#">Rahul Sandeep</a></strong></span>
			</div>	
	
	</footer>
	<html>
	<div class="modal" tabindex="-1" id="myModal" role="dialog">
	<div class="modal-dialog modal-sm " role="document">
    <div class="modal-content">
      <div class="modal-header">	
        <h4 class="modal-title">Confirm Delete?</h4>
       <button type="button" class="close" onclick="close_box()"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
	  
	   <form class="form-horizontal">
          <div class="box-body">
            <p id="message">Do you really want to delete ?</p>
            <input type="hidden" name="userid" id="userid">
			<input type="hidden" name="status" id="status">
           
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="close_box()">Close</button>
        <button type="button" class="btn btn-danger" onclick="del();">Delete</button>
      </div>
    </div>
  </div>
</div>

	
</html>