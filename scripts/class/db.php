<?php
	class db{
		
		private $con;
		private $READ_ONLY=false;
        private $BASE;

        private $ERROR_REPORT = true;
        private $RECONECT = false;
		
		function __construct( $_BASE = 'u'){
			if(isset($GLOBALS['GLOBAL_BASE_USER'][$_BASE])
			&& isset($GLOBALS['GLOBAL_BASE_PASS'][$_BASE])
			&& isset($GLOBALS['GLOBAL_BASE_USE'][$_BASE])){
				$this -> BASE = $_BASE;
				$this -> connect();
	            $this -> RECONNECT();
			}else{
				echo "Nie ustawiono danych dla bazy: '{$_BASE}', wprowadź je w pliku variables.php";
				exit();
			}
		}

		private function connect( $REPORT_ON_ERROR = true){
			$this->con=mysql_connect(GLOBAL_BASE_HREF, $GLOBALS['GLOBAL_BASE_USER'][$this -> BASE], $GLOBALS['GLOBAL_BASE_PASS'][$this -> BASE]);

			if(!$this->con){
				if($REPORT_ON_ERROR) { 
					die($this -> get_error()); 
				}
			}
		}
		
        public function RECONNECT(){
        	// próba ponownego połączenia z bazą w sensue uzycia USE, jeżeli nie da się połączyć z bazą to wtedy
			if(!mysql_select_db($GLOBALS['GLOBAL_BASE_USE'][$this -> BASE])){
				// jeżeli wystąpił błąd
				if($RECONECT){	// jeżeli kaput
					echo "Wystąpił błąd krytyczny!<br />" . $this -> get_error();
				}else{
					$this -> RECONECT = true;
					$this -> connect( false );
				}
			}
		}
                
		private function mysql_question($tresc, $DEBUG)	{
            
			//$DEBUG = true;
			if($DEBUG) DEBUG::debug_to_console("mysql_question: ".str_replace("'","\'",$tresc));
			$wynik=mysql_query($tresc);
			if ($wynik){
				if($DEBUG) DEBUG::debug_to_console("mysql_question: ".str_replace("'","\'",$wynik));
				return $wynik;	
			}else{
				if($DEBUG || $this->ERROR_REPORT) {
					DEBUG::debug_to_console("mysql_question: ".str_replace("'","\'",$tresc));
					DEBUG::debug_to_console("Error: " . str_replace("'","\'",mysql_error()));
				}
				return false;	
			}
		}

		public function get_error(){
			return mysql_error();
		}
		
		public function get_last_id(){
			$ID = mysql_fetch_array($this -> mysql_question("SELECT  LAST_INSERT_ID();", false));
			return $ID['LAST_INSERT_ID()'];
		}
		
		public function count_data($baza, $pole, $warunek = NULL, $DEBUG = false){
			if ($warunek == NULL) {
				$wynik = $this->mysql_question("SELECT COUNT({$pole}) FROM {$baza};", $DEBUG);
			}else{
				$wynik = $this->mysql_question("SELECT COUNT({$pole}) FROM {$baza} WHERE {$warunek};", $DEBUG);
			}
			if($wynik){
				$_wynik = mysql_fetch_assoc($wynik);
				return $_wynik["COUNT(" . $pole . ")"];
			}else{
				return 0;
			}
		}
		
		public function update_data($baza,$wartosc,$warunek, $DEBUG = false){
			if(!$this->READ_ONLY)
			$this->mysql_question("UPDATE ".$baza." SET ".$wartosc." WHERE $warunek;", $DEBUG);
		}		

		public function insert_data($baza,$pole,$wartosc, $DEBUG = false){	
			if(!$this->READ_ONLY)
			$this->mysql_question("INSERT INTO ".$baza." (".$pole.") VALUES (".$wartosc.")", $DEBUG);
		}		

		public function delete_data($baza,$warunek, $DEBUG = false){
			if(!$this->READ_ONLY)	
			$this->mysql_question("DELETE FROM $baza WHERE $warunek ;", $DEBUG);
		}		

		public function get_data($baza, $pole, $assoc = true, $warunek = null, $DEBUG = false){
			if ($warunek == null){
				$_baza = $this->mysql_question("SELECT ".$pole." FROM ".$baza.";", $DEBUG);
			}else{
				$_baza = $this->mysql_question("SELECT ".$pole." FROM ".$baza." WHERE ".$warunek.";", $DEBUG);
			}
			
			if ($assoc == true){
				return mysql_fetch_assoc($_baza);
			}else{
				return $_baza;
			}
		}

	}
?>