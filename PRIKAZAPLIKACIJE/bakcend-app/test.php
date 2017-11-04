<?php
header("content-type:application/json");
require 'config.php';
require 'classes/Db.php';


$users =  Users::get();

$res = [];
foreach($users as $user){
   $res[]=$user;
}


echo json_encode($res);
