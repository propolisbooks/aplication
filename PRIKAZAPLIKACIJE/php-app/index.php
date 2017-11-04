<?php 
 require_once "templates/header.php";
 ?>

<div class="container">
  <h2 class="text-center">Login</h2>
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-4">
	  <form class="form-horizontal" method="post" action="action_page.php">
	    <div class="form-group">
	      <label for="email"></label>
	      <input type="text" class="form-control" id="first_name" placeholder="Enter first_name" name="first_name">
	    </div>
	    <div class="form-group">
	      <label for="email"></label>
	      <input type="text" class="form-control" id="last_name" placeholder="Enter last name" name="last_name">
	    </div>
	    <div class="form-group">
	      <label for="pwd">Password:</label>
	      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
	    </div>
	    <div class="checkbox">
	      <label><input type="checkbox" name="remember"> Remember me</label>
	    </div>
	    <button type="submit" class="btn btn-default">Submit</button>
	  </form>
   
    </div>
  <div class="col-md-3"></div>
    </div>
</div><!-- container -->



<?php
include_once "templates/footer.php";