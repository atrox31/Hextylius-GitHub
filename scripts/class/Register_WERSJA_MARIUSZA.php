<?php
	/*
		Name: Register
		Author: Mariusz Woelk
		Description: Class used to register new users. First it checks provided data and if it pass then
		whole data is sent to the database.
	*/

	Class Register
	{
		// Conditions for check function
		private static $CONDITION_MIN = 5; // Minimum ammount of characters in string

		private $username, $password, $email;
		private $error; // On called destruct it is displayed

		function __construct($_username, $_password, $_repassword, $_email) {
			if($this -> check($_username)) {
				$this -> username = $_username;
			} else {
				$this -> error = "Zła nazwa użytkownika!";
				return false;
			}

			if($this -> check($_password) && $this -> check($_repassword)) {
				if($_password == $_repassword) {
					$this -> password = $_password;
				}
			} else {
				$this -> error = "Złe hasło!";
				return false;
			}

			if($this -> check($_email)) {
				if($this -> isEmail($_email)) {
					$this -> email = $_email;
				}
			} else {
				$this -> error = "Zły e-mail!";
				return false;
			}
		}

		function __destruct() {
			echo $this -> error;
		}

		// Checks the provided data by using CONDITION's
		private function check($data) {
			if(strlen($data) >= self::$CONDITION_MIN) {
				return true;
			} else {
				return false;
			}
		}

		// You know what is mean
		private function isEmail($data) {
			if(filter_var($data, FILTER_VALIDATE_EMAIL) !== false) {
				return true;
			} else {
				return false;
			}
		}
	}
?>