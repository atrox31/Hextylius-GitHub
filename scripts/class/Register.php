 <?php
	/*
		Nazwa: Register
		Autor: Mariusz Woelk
		Opis: Klase używamy do rejestracji nowych użytkowników. Sprawdza dane pod względem poprawności, a następnie zapisuje do bazy danych.
	*/

	Class Register
	{
		// Warunki do spełnienia
		private static $CONDITION_MIN = 5; // Minimalna długość tekstu
  		private static $CONDITION_MAX = 32; // Maksymalna długość tekstu
  		private static $BASEDATA = "fassh114_1"; // Nazwa bazy danych
  		private static $BASE = "users"; // Nazwa tablicy z bazy danych

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

			if($this -> isExist()) {
				$this -> error .= "<li>Użytkownik już istnieje!</li>";
			}

			if($this -> error == "") {
				$this -> register();
				header("location: " . $GLOBALS['SUBDOMEN'] . ".index.php?ekran=register_complite");
			} else {
				echo "<span class='error'><ul>{$this -> error}</ul></span>";
			}
		}

		// Sprawdza czy długość tekstu odpowiada założonemu w CONDITION_MIN
		private function check($data) {
			return (strlen($data) >= self::$CONDITION_MIN);
		}

		private function isExist() {
			$fields = "nick";

			$db = new db(self::$BASEDATA);
			$users = $db -> get_data(self::$BASE, $fields, true, "`nick` = '" . (string)$this -> username . "'");

			if($users)
				return true;
			else
				return false;
		}

		// Łączy się z bazą danych i tworzy dane użytkownika
		private function register() {
			$fields = "nick, pass, kind";
			$values = "'" . (string)$this -> username . "', '" . (string)$this -> password . "', '" . $GLOBALS['SUBDOMEN'] . "'";

			$db = new db(self::$BASEDATA);
			$db -> insert_data(self::$BASE, $fields, $values, true);
		}
	}
?>