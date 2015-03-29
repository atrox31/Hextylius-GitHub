<?php
	/******************************************************
	* core.php
	* pobieranie danych z bazy
	* cały silnik podstawowych komend do War Plans
	******************************************************/
		// WSZTSTKIE STAŁE WYKOŻYSTANE W GRZE
		if ((strpos($_SERVER['HTTP_HOST'], '192.168') !== FALSE)||(strpos($_SERVER['HTTP_HOST'], 'localhost') !== FALSE)){ // jeżeli serwer jest w domku to dawaj te pasy, inaczej internetowe
			define("GLOBAL_BASE_HREF", "localhost", true);
			define("GLOBAL_BASE_USER", "root", true);
			define("GLOBAL_BASE_PASS", "zaq1@WSX", true);
		} else {
			define("GLOBAL_BASE_HREF", "localhost", true);
			define("GLOBAL_BASE_USER", "fassh114_1", true);
			define("GLOBAL_BASE_PASS", "ptPXPF6A", true);
		};
		
	function __autoload($className){
	   require_once('./scripts/class/'.$className.'.php');
	}	

	function array_delete_value( &$array, $value){
	    if(($key = array_search($value, $array)) !== false) {
	        unset($array[$key]);
	    }
	}

	function array_to_string( $array, $char = ","){
	    $RETURN_STRING = "";
	    foreach($array as $array_key => $array_item){
	        $RETURN_STRING .= $array_item;
	        if(array_last_key($array) != $array_key){
	            $RETURN_STRING .= $char;
	        }   
	    }
	    
	    return $RETURN_STRING;
	}

	function clear($text) {
	    // jeśli serwer automatycznie dodaje slashe to je usuwamy
	    if(get_magic_quotes_gpc()) {
	        $text = stripslashes($text);
	    }

	    $text = trim($text); // usuwamy białe znaki na początku i na końcu
	    $text = mysql_real_escape_string($text); // filtrujemy tekst aby zabezpieczyć się przed sql injection
	    $text = htmlspecialchars($text); // dezaktywujemy kod html
	    
	    return $text;
	}

	function codepass($password) {
	    // kodujemy hasło (losowe znaki można zmienić lub całkowicie usunąć
        // domyślne dla starych haseł: fT3YYas2dD34
	    return sha1(md5($password).'fT3YYas2dD34');
	}
		
	function minute( $cout = 1 ){
		return ( $cout * 60 ); 
	}	
		
	function hour( $cout = 1 ){
		return ( $cout * minute(60) ); 
	}	
		
	function day( $cout = 1 ){
		return ( $cout * hour(24) );
	}	

	function download($file){
		if (file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			readfile($file);
			exit;
		}
	}

	function get_image( $filename ){
		$file_exts = array("jpg", "bmp", "jpeg", "gif", "png");
		$upload_exts = end(explode(".", $_FILES[ $filename ]["name"]));
		if ((($_FILES[ $filename ]["type"] == "image/gif")
		|| ($_FILES[ $filename ]["type"] == "image/jpeg")
		|| ($_FILES[ $filename ]["type"] == "image/png")
		|| ($_FILES[ $filename ]["type"] == "image/pjpeg"))
		&& ($_FILES[ $filename ]["size"] < 2000000)
		&& in_array($upload_exts, $file_exts)){
			if ($_FILES[ $filename ]["error"] > 0){
				echo "BŁĄD!: " . $_FILES[ $filename ]["error"];
				return false;
			}else{
				// Enter your path to upload file here
				if (file_exists("grafika/" . $_FILES[ $filename ]["name"])){
					
					echo "BŁĄD! Plik już istnieje, ewentualnie zmień jego nazwę.";
					return false;
				}else{
					move_uploaded_file($_FILES[ $filename ]["tmp_name"],
					"grafika/" . $_FILES[ $filename ]["name"]);

					return $_FILES[ $filename ]["name"];
				}
			}
		}else{
			if ($upload_exts != "")
				echo "BŁĄD!: Zły format pliku( $upload_exts )! Dostępne rozszerzenia:'jpg', 'bmp', 'jpeg', 'gif', 'png'";
			else
				echo "BŁĄD!: Nie wybrano żadnego pliku, albo nastąpił jakiś dziwny błąd którego nie przewidziałem.";
			return false;
		}
	}	

	function array_last_key( &$array ){
		end($array);
		return key($array);  
	}

	function url_exists($url){
	    $url = str_replace("http://", "", $url);
	    if (strstr($url, "/")) {
	        $url = explode("/", $url, 2);
	        $url[1] = "/".$url[1];
	    } else {
	        $url = array($url, "/");
	    }
	    $fh = fsockopen($url[0], 80);
	    if ($fh) {
	        fputs($fh,"GET ".$url[1]." HTTP/1.1\nHost:".$url[0]."\n\n");
	        if (fread($fh, 22) == "HTTP/1.1 404 Not Found") { return FALSE; }
	        else { return TRUE;    }
		} else { 
			return FALSE;
		}
	}

	function str_contain( $string, $contain ) {
		if (strpos($string, $contain) !== false) {
			return true;
		} else {
			return false;
		}
	}

	function js( $script ) {
		echo "<script> $script </script>";
	}

	function this_url(){
		$STR = basename($_SERVER['PHP_SELF']);
		if(isset($_GET)){
			$STR .= "?";
			foreach ($_GET as $key => $value) {
				$STR .= $key . "=" . $value;

				if($key != array_last_key($_GET)){
					$STR .= "&";
				}

			}
		}
		return $STR;
	}

	function page_refresh(){
		header("location: " . this_url());
	}

?> 