<?php
	require_once 'core/init.php';

	$output = "";


	if (Input::exists()) {

		// ovde fali dodatak za slucaj da je user vec registrovan ili da postoji mejl adresa u bazi

		if (Token::check(Input::get('token'))) {

			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'username' => array(

					'required' 	=> true,
					'min'		=> 2,
					'max'		=> 20,
					'unique'	=> 'users'
					),
				'password' => array(
					'required'	=> true,
					'min'		=> 6

					),
				'password_again' => array(
					'required'	=> true,
					'matches'	=> 'password'
					),
				'email' => array(
					'required'	=> true,
					'min'		=> 2,
					'max'		=> 50
					),
				));

				if ($validation->passed()) {

						$user = new User();
						
						$salt = Hash::salt(32);

				
						try {
							$user->create(array(
									'username' => Input::get('username'),
									'password' => Hash::make(Input::get('password'), $salt),
									'salt' => $salt,
									'email' => Input::get('email'),
									'joined' => date('Y-m-d H:i:s'),
									'privilege' => 1
								));
							} catch (Exception $e) {
							die($e->getMessage());	///promeniti zbog funkcionalnosti i redirekta.
						}
					

						Session::flash('message', 'You registered successfully!'); // eventualno promeniti
						Redirect::to('profile.php');

				} else {
					foreach($validation->errors() as $error) {
						$output .= $error . "<br />";
					}
				}

		} // end if (Token::check...)

	}	// end if (Input::exists())




include_once "templates/header.php";


?>




<html>
<head>

	
	<title>App</title>

</head>
<body>

	


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


			<form action="register.php" method="post">
				<div class="field">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off"> 
				</div>

				<div class="field">
					<label for="password">Choose a password</label>
					<input type="password" name="password" id="password">
				</div>

				<div class="field">
					<label for="password_again">Enter your password again</label>
					<input type="password" name="password_again" id="password_again">
				</div>

				<div class="field">
					<label for="email">Enter your email</label>
					<input type="text" name="email" value="<?php echo escape(Input::get('email')); ?>" id="email">
				</div>

				<input type="hidden" name="token" value="<?php echo Token::generate(); ?>" >
				<input type="submit" value="Register" >

			</form>
			

		</div>

		
    <div class="col-md-3"></div>

</div><!-- .row -->


<?php echo $output; ?>

<?php
include_once "templates/footer.php";