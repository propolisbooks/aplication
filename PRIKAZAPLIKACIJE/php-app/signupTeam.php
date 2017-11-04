<?php
require_once "templates/header.php";
 ?>
 <div class="row">

   <form class="form-horizontal" method="post" action="action_page.php">
    <div class="form-group">
      <label class="control-label col-sm-2" for="first_name">First Name:</label>

      <h1></h1>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="users" placeholder="" name="email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Start :</label>
      <div class="col-sm-2">          
        <input type="date" class="form-control" id="start" name="start">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">End :</label>
      <div class="col-sm-2">          
        <input type="date" class="form-control" id="end" name="end">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox" name="remember"> Remember me</label>
        </div>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>

</div><!-- row -->

 <?php
 require_once "templates/footer.php";