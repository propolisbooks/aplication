<?php

// Database Constants

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "dinamikturs");
define("APP_DIR", $_SERVER['DOCUMENT_ROOT']."/test");
//


   function  __autoload($class) {
       	require_once "classes/{$class}.php";
    };    

