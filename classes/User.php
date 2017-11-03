<?php

class User {
	private $_db,
			$_data,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn = false;  


	public function __construct($user = null) {
		$this->_db = DB::getInstance();				

		$this->_sessionName = Config::get('session/session_name');  
		$this->_cookieName = Config::get('remember/cookie_name');

		if(!$user) {
			if(Session::exists($this->_sessionName)) {
				$user = Session::get($this->_sessionName);

				if($this->find($user)) {
					$this->_isLoggedIn = true;
					
				} else {
					$user->logout(); 
				}
			}		
		} else {
			$this->find($user);
		}

	}


	public function create($fields = array()) {
		if(!$this->_db->insert('users', $fields)) {
			throw new Exception('There was a problem creating an account.');
		}

	}

	public function find($user = null) {
		if ($user) {
			$field = (is_numeric($user)) ? 'id' : 'username'; //totalna glupost, omogucava da se user loguje sa id-jem
			$data = $this->_db->get('users', array($field, '=', $user)); // $data izvlaci ceo record za korisnika

			if($data->count()) {
				$this->_data = $data->first(); //funkcija u db klasi first(), izvlaci id korisnika u ovom slucaju
				return true;
			}
		}
		return false;

	}


	public function update($fields = array(), $id = null) {

		if(!$id && $this->isLoggedIn()) {
			$id = $this->data()->id;
		}

		if(!$this->_db->update('users', $id, $fields)) {
			throw new Exception("Error updating user.");
			
		}


	}






	public function login ($username = null, $password = null, $remember = false) {
		
		if(!$username && !$password && $this->exists()) {
				Session::put($this->_sessionName, $this->data()->id);

		} else {

		$user = $this->find($username);

			if ($user) {		// klasa hash, funkcija make

				if($this->data()->password === Hash::make($password, $this->data()->salt)) {
					Session::put($this->_sessionName, $this->data()->id); // funkcija iz session klase, ubacuje u session array vrednost put($name, $value)
																		  // dodati po potrebi sta ide sve u session u startu
					if ($remember) {

						$hash = Hash::unique();
						$hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->id)); // ovo je mozda i nepotreban deo jer proverava da li vec postoji zabelezen hash u tabeli pa ako ne onda dodaje, radi 1 sql vise

						if(!$hashCheck->count()) {
							$this->_db->insert('users_session', array(
								'user_id'	=>	$this->data()->id,
								'hash'		=>	$hash
								));
						}	else {
							$hash = $hashCheck->first()->hash;
						}

							Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));

					}	// end if ($remember)...

					return true; // obavezno da bi oznacili uspesan login
				}

			}	// end if($user)
		}
		return false;
	} // end function

	public function exists() {
		return (!empty($this->_data)) ? true : false;
	}

	public function logout () {

		$this->_db->delete('users_session', array('user_id', '=', $this->data()->id));

		Session::delete($this->_sessionName);
		Cookie::delete($this->_cookieName);
	}

			// prvobitno kao private funkcija za potrebe klase a naknadno promenjena u public radi upotrebljivosti
	public function data() {
		return $this->_data;
	}


	public function sessionname() {
		return $this->_sessionName;
	}


		// check za login 
	
	public function isLoggedIn() {
		return $this->_isLoggedIn;
	}

		// eventualno dodati funkciju za unsetovanje usera





}












?>