<?php

require_once "core/init.php";

$user = new User(Session::get('user'));

          if(Session::exists('message')) {
                echo "<div>";
                echo "<p>" . Session::flash('message') . "</p>";
                echo "</div>";
              }



echo "Hello " . $user->data()->username;

?>
	