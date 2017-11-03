<?php



require_once 'core/init.php';
// u form tag-u action="" ostavljeno prazno da bi se kod izvrsio na istoj strani

$output = "";

if(Input::exists()) {
  if(Token::check (Input::get('token'))) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'username'  => array ('required' => true),
      'password'  => array ('required' => true)
      ));

    if($validation->passed()) {
      // log in

        $user = new User();

        $remember = (Input::get('remember') === 'on') ? true : false;
        $login = $user->login(Input::get('username'), Input::get('password'), $remember);

          if ($login) {
            Session::flash('message', 'You logged in successfully!');
            Redirect::to('');
          } else {
            Session::flash('message', 'Sorry, log in failed!');
            Redirect::to('');
            
          } 



    } else {          // end if($validation->passed... pa else
      
      foreach ($validation->errors() as $error){
        $output .= $error . "<br />";

      }
    }

  }


}







include_once "templates/header.php";
?>

  <div class="jumbotron">
  <div class="text-center">
     <h2>Login</h2>
  </div>
  </div><!--.jumbotron -->

<div class="row">


   <div class="col-md-3">
        <?php
              if(Session::exists('message')) {
                echo "<div>";
                echo "<p>" . Session::flash('message') . "</p>";
                echo "</div>";
              }
        ?>
        

   </div>
   <div class="col-md-4 col-md-offset-3">
       <form action="" method="post">

        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" value="" autocomplete="off"> 
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" autocomplete="off">
        </div>


          <div class="checkbox">
            <label><input type="checkbox"> Remember me</label>
          </div>


        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" >
          <button type="submit" class="btn btn-default">Submit</button>
      </form>


      <?php echo $output; ?>


        
       
  </div>
    <div class="col-md-3"></div>

</div><!-- .row -->


<?php
include_once "templates/footer.php";