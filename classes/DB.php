<?php
    // singleton pattern 
   
  Class DB {
     
     private static $_instance = null;
     private  $_pdo, 
              $_query, 
              $_error = false, 
              $_results, 
              $_last_id = null,
              $_count = 0, 
              $_last_query = '';
              


      // konstruktor je private po default-u, instanca se poziva statickim metodom getInstance()
      private function __construct(){
          try {
              $this->_pdo = New PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'),Config::get('mysql/password'));    //standardni postupak  PDO(host-db name, username, password)  ... stavljeno x, y, z, a za pocetak
               echo "connected";         // kao test da li je baza povezana
          } catch(PDOException $e) {       
              die($e->getMessage());
          }
      }      
  
  
        public static function getInstance() {
           if(!isset(self::$_instance)) {
               self::$_instance = New DB();
           }
           return self::$_instance;
        }


 
                   // params - parametri za query
        public function query($sql, $params = array()) {
             $this->_error = false;
         
              if($this->_query = $this->_pdo->prepare($sql)) {
              
                  $x = 1;
                  if(count($params)) {
                    foreach($params as $param) {
                       $this->_query->bindValue($x, $param);
                       $x++;   // zadajemo parametre po redu pocevsi od x=1 (prvi ? u queryju) 
                     } 
                  } 
                
                  if ($this->_query->execute()) {
                       $this->_results = $this->_query->fetchALL(PDO::FETCH_OBJ);
                            
                       $this->_count = $this->_query->rowCount();
                       $this->_last_query = $sql; 

                  } else {
                        $this->_error = true;
                  }
              }  
            return $this;
         }    
  
                       // ovaj arej treba da ima field, operator, value
         public function action($action, $table, $where = array()) {
                if (count($where) == 3) {
                  $operators = array('=', '>', '<', '>=', '<=');  // moze da se doda na spisak dozvoljenih operacija - metoda koji se koriste
                    
                    $field      = $where[0];
                    $operator   = $where[1];
                    $value      = $where[2];
                    
                    if(in_array($operator, $operators)) {
                       $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                          if (!$this->query($sql, array($value))->error()) {
                               return $this;
                          }
                     }
                  }
              return false;
           } 
         
         
         public function get($table, $where = array()) {
              return $this->action('SELECT *', $table, $where);
         
         }    
  
  
  
          public function delete($table, $where = array()) {
                return $this->action('DELETE', $table, $where);
               
          } 
        
        
        
          public function insert($table, $fields = array()) {
            
                  $keys = array_keys($fields);
                  $values = '';
                  $x = 1;
                  
                  foreach($fields as $field) {
                       $values .= '?';
                       if($x < count($fields)) {
                            $values .= ', ';
                       }
                       $x++;
                  }
                  
               
                                           
                  $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys ) . "`) VALUES ({$values})";
                  
                  if(!$this->query($sql, $fields)->error()) {
                    $this->_last_id = $this->_pdo->lastInsertId();
                      return true;
                  }
              
              return false;
          }
        
        
        
         public function update($table, $id, $fields = array()) {
              $set = '';
              $x = 1;
              
              foreach($fields as $name => $value) {
                  $set .= "{$name} = ?";
                  if($x < count($fields)) {
                     $set .=", ";
                  }
                  $x++;

               }
             $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
              
              if(!$this->query($sql, $fields)->error()) {
                  $this->last_query = $sql;
                  return true;
              }
                $this->last_query = $sql;
               return false;
         }  // end update



         

         public function direct_sql ($sql) {
            $this->_error = false;

            if($this->_query = $this->_pdo->prepare($sql)) {

                  if ($this->_query->execute()) {
                       $this->_results = $this->_query->fetchALL(PDO::FETCH_OBJ);
                       $this->_count = $this->_query->rowCount();
                       $this->last_query = $sql; 
                  } else {
                        $this->_error = true;
                  }
               }

           return $this;
         }  
              
              
             
          // metodi za pristup private varijablama


        public function results() {
              return $this->_results;
         }
        
        public function first() {
          if($this->count()){
            return $this->results()[0];
          } else {
            return null;
          }
        }
        public function error() {
            return $this->_error;
         }
    
        public function count(){
           return $this->_count;
         
         }



          // get_id vraca poslednji id iz baze a zatim resetuje $_last_id;
        public function get_id() {

          $id = $this->_last_id;
          $this->reset_id();
          return $id;
        }

        public function last_id() {
          return $this->_last_id;
        }

        public function reset_id() {
          $this->_last_id = null;
        }

        
        public function last_query() {
          return $this->_last_query;
        }

  


 }




?>
