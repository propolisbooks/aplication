<?php

class Users extends Crud{
	public static $key = "id";
	public static $tabela = "users";

    public static function setSessions()
    {
           Session::set("user", $this->login);
    }
    
    public static function login($user, $password)
    {
        $user = str_replace("'", "", $user);
        $user = str_replace("`", "", $user);
        $user = str_replace("-", "", $user);
        $password = str_replace("'", "", $password);
        $password = str_replace("`", "", $password);
        $password = str_replace("-", "", $password);
        $password = sha1($password);

         $db = Db::getConnection();
          $res = $db->query("select * from users  where user ='{$user}' and password = '{$password}'");
          while($users=$res->fetch(PDO::FETCH_OBJ)){
            //print_r($users);
         if (count($users) ==1) {
             return $users;
          }
             return null;
          }

   }

 }