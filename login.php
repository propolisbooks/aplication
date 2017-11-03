<?php
include_once "templates/header.php";
?>

  <div class="jumbotron">
  <div class="text-center">
     <h2>Login</h2>
  </div>
  </div><!--.jumbotron -->

<div class="row">


   <div class="col-md-3"></div>
   <div class="col-md-4 col-md-offset-3">
      <form>
          <div class="form-group">
            <label for="user">User:</label>
            <input type="user" class="form-control" id="user">
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd">
          </div>
          <div class="checkbox">
            <label><input type="checkbox"> Remember me</label>
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
      </form>
  </div>
    <div class="col-md-3"></div>

</div><!-- .row -->


<?php
include_once "templates/footer.php";