<?php
class Redirect {

	public static function to ($location = null) {
			if ($location) {
					if (is_numeric($location)) {
						// koristi se switch da bi moglo da se doda jos error kodova
						switch($location) {
							case 404:
								header('HTTP/1.0 404 Not Found');
								include 'includes/errors/404.php';
								exit();

							break;
						}
					}
				header('Location: ' . $location);
				exit();
			} 
	} 

}

?>