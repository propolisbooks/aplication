<?php

  session_start();

  // config 

  $GLOBALS['config'] = array (
      'mysql' => array(
          'host' => '127.0.0.1',
          'username' => 'root',
          'password' => '',
          'db' => 'cloudhorizon-app'                  
      ),
      'remember' => array(
          'cookie_name' => 'hash',
          'cookie_expiry' => 604800
      
      ),
      'session' => array(
          'session_name' => 'user', 
          'token_name' => 'token'
      )
    );

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)


defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.''.DS.''.DS.''.DS.'');
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'classes');
defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes');




  // initialization:
  
  /*
    // load config file first:
  require_once(LIB_PATH.DS.'config.php');

    // load basic functions next so that everything after can use them:
  require_once(INC_PATH.DS.'functions.php');

  */
  
 // load core objects:
 // ...
  
   

  //predefinisano
      
    require_once 'includes/sanitize.php';
    require_once 'includes/functions.php';
    require_once 'classes/Config.php';
  
  // autoload
 spl_autoload_register(function($class) {
   require_once 'classes/' . $class . '.php';
 });      


            // check za remember me

      /*
if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
      $hash = Cookie::get(Config::get('remember/cookie_name'));
      $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

        if($hashCheck->count()) {
          $user = new User($hashCheck->first()->user_id);
          $user->login();
        }

}
    */
    
?>
