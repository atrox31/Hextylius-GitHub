 <?php
	/*
		Nazwa: Register
		Autor: Mariusz Woelkl
		Opis: Klasa używany do rejestracji nowych użytkowników. Najpierw sprawdza, pod warunkiem, dane i jeśli przejdzie następnie
			Całość dane są przesyłane do bazy danych
	*/

	Class Register
	{
		// Warunki do spełnienia
		private static $CONDITION_MIN = 5; // Minimalna długość tekstu
  		private static $CONDITION_MAX = 32; // Maksymalna długość tekstu

		private $username, $password, $email;
		private $error = ""; // Wiadomość błędu, wypisywana po pierwszym napotkanym błędzie

		function __construct($_username, $_password, $_repassword, $_email) {
			if($this -> check($_username)) {
				$this -> username = $_username;
			} else {
				$this -> error = "<li>Zła nazwa użytkownika!</li>";
			}

			if($this -> check($_password) && $this -> check($_repassword)) {
				if($_password == $_repassword) {
					$this -> password = $_password;
				}
			} else {
				$this -> error .= "<li>Złe hasło!</li>";
			}

			if($this -> check($_email)) {
				if(filter_var($_email, FILTER_VALIDATE_EMAIL)) {
					$this -> email = $_email;
				}
			} else {
				$this -> error .= "<li>Zły e-mail!</li>";
			}

			if($error <> "") {
				$this -> register();
			} else {
				echo "<span class='error'><ul>{$this -> error}</ul></span>";
			}
		}

		// Sprawdza czy długość tekstu odpowiada założonemu w CONDITION_MIN
		private function check($data) {
			if(strlen($data) >= self::$CONDITION_MIN) {
				return true;
			} else {
				return false;
			}
		}

		// Łączy się z bazą danych i tworzy dane użytkownika
		private function register() {
			$fields = "login, password";
			$values = (string)$this -> username . " " . (string)$this -> password;

			$db = new db("fassh114_1");
			$db -> insert_data("users", $fields, $values, true);
		}
	}
?>