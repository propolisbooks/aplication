<?php

require_once 'core/init.php';
// u form tag-u action="" ostavljeno prazno da bi se kod izvrsio na istoj strani

$output = "";

if(Input::exists()) {
	if(Token::check (Input::get('token'))) {

		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username'	=> array ('required' => true),
			'password'	=> array ('required' => true)
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



		} else {					// end if($validation->passed... pa else
			
			foreach ($validation->errors() as $error){
				$output .= $error . "<br />";

			}
		}

	}


}




?>



		
<html>
<head>
	<title></title>
</head>
<body>
					<div>
	                		<ul>
							<li><a href="login.php">Log in</a></li>
							<li><a href="register.php">Register</a></li>
							</ul>
					</div>
               		




			<div>
	

				<?php
							if(Session::exists('message')) {
								echo "<div>";
								echo "<p>" . Session::flash('message') . "</p>";
								echo "</div>";
							}
				?>
				
				<form action="" method="post">

				<div class="field">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" value="" autocomplete="off"> 
				</div>

				<div class="field">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" autocomplete="off">
				</div>

				<div class="field">
					<label for="remember">
					<input type="checkbox" name="remember" id="remember"> Remember me
				</label>
				</div>

				<input type="hidden" name="token" value="<?php echo Token::generate(); ?>" >
				<input type="submit" value="Log in">
				</form>


				<div>
					<?php echo $output; ?>
				</div>



			</div>




		

</body>
</html>
