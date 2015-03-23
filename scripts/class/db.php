<?php
	class db
	{
		private $con;
		private $READ_ONLY = false;
        private $BASE;
		
		function __construct( $_BASE ) {
			$this -> con = mysql_connect(GLOBAL_BASE_HREF, GLOBAL_BASE_USER, GLOBAL_BASE_PASS)
				or die($this -> get_error());
			$this -> BASE = $_BASE;
				$this -> RECONNECT();
				$this -> READ_ONLY = false;
		}
		
        public function RECONNECT() {
        	mysql_select_db($this -> BASE);
        }

        function SHOW_BASE() {
        	var_dump(GLOBAL_BASE_USE2);
        }

		private function mysql_question($tresc, $DEBUG)	{
			//$DEBUG = true;
			if($DEBUG) DEBUG::debug_to_console("mysql_question: " . str_replace("'", "\'", $tresc));
			
			$wynik = mysql_query($tresc);

			if($wynik) {
				if($DEBUG)
					DEBUG::debug_to_console("mysql_question: " . str_replace("'", "\'", $wynik));
				return $wynik;
			} else {
				if($DEBUG)
					DEBUG::debug_to_console("Error: " . str_replace("'", "\'", mysql_error()));
				return false;
			}
		}

		public function get_error() {
			return mysql_error();
		}
		
		public function get_last_id() {
			$ID = mysql_fetch_array($this -> mysql_question("SELECT  LAST_INSERT_ID();", false));
			return $ID['LAST_INSERT_ID()'];
		}
		
		public function count_data($baza, $pole, $warunek = NULL, $DEBUG = false) {
			if ($warunek == NULL) {
				$wynik = $this -> mysql_question("SELECT COUNT({$pole}) FROM {$baza};", $DEBUG);
			} else {
				$wynik = $this -> mysql_question("SELECT COUNT({$pole}) FROM {$baza} WHERE {$warunek};", $DEBUG);
			}
			
			if($wynik) {
				$wynik = mysql_fetch_assoc($wynik);
				return $wynik[$pole];
			} else {
				return 0;
			}
		}
		
		public function update_data($baza, $wartosc, $warunek, $DEBUG = false) {
			if(!$this -> READ_ONLY)
				$this -> mysql_question("UPDATE " . $baza . " SET " . $wartosc . " WHERE $warunek;", $DEBUG);
		}		

		public function insert_data($baza, $pole, $wartosc, $DEBUG = false) {	
			if(!$this -> READ_ONLY)
				$this -> mysql_question("INSERT INTO " . $baza . " (" . $pole . ") VALUES (" . $wartosc . ")", $DEBUG);
		}		

		public function delete_data($baza, $warunek, $DEBUG = false) {
			if(!$this -> READ_ONLY)	
				$this -> mysql_question("DELETE FROM $baza WHERE $warunek ;", $DEBUG);
		}		

		public function get_data($baza, $pole, $assoc = true, $warunek = null, $DEBUG = false) {
			if ($warunek == null) {
				$_baza = $this -> mysql_question("SELECT " . $pole . " FROM " . $baza . ";", $DEBUG);
			} else {
				$_baza = $this -> mysql_question("SELECT " . $pole . " FROM " . $baza . " WHERE " . $warunek . ";", $DEBUG);
			}
			
			if ($assoc == true) {
				return mysql_fetch_assoc($_baza);
			} else {
				return $_baza;
			}
		}
	}
?>