<?php
/******************************************************
* ArtCore.php
* 
* artCore - silnik podstawowych komend przydatnych w wielu projektach
* atrox - autor, opracował i napisał.
* dostęp ograniczony - Ex Favilla Games 2015
* 
******************************************************/

if(!isset($_SESSION['developer'])){
	$_SESSION['developer'] = false;
}
if(isset($_GET['developer'])){
	$_SESSION['developer'] = $_SESSION['developer'] == true ? false : true;
}
// powiadom o trybie
if($_SESSION['developer']){
	echo "<div style='color:red; text-align: center; width:100%'>TRYB DEVELOPERA</div>";
}

if(file_exists ( "stop" )){
	if($_SESSION['developer']){
		echo "<div style='color:red; text-align: center; width:100%'>tryb aktualizacji: włączony</div>";
	}else{
		echo "<center>
			<h1>
				Wprowadzanie aktualizacji, proszę się nie denerwować <br />(ノಠ益ಠ)ノ彡┻━┻ |
			</h1>
			Aktualizacje nie są niczym złym, wręcz przeciwnie! Listy zmian można wypisywac w nieskończoność, ale ta jest szczególna (chyba)<br />
			Wróć do WarPlans za jakiś czas, naprawdę!
		</center>";
		exit();
	}
}

require_once("variables.php");

function __autoload($className){
	if( str_contain(basename($_SERVER['PHP_SELF']), "index.php") ){ // jeżeli główny index chce klase
   		require_once('./scripts/class/'.$className.'.php');
	}else{
		require_once('../scripts/class/'.$className.'.php');
	}
}	

function array_delete_value( &$array, $value){
    if(($key = array_search($value, $array)) !== false) {
        unset($array[$key]);
    }
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

function new_id( $len = 8 ){
	// co ciekawe przy takiej konstrukcji wygeneruje tylko 32767 unikatowych identyfikatorów, potem wróci do pierwszego (przy jedneym przejściu kodu - czyli przy generacji nowej strony id znowu będą od 0)
	if($len < 1 ){ $len = 1; };
	return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $len);
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

function array_value_to_string( $array, $char = ";", $char2 = "="){
    $RETURN_STRING = "";
    foreach($array as $array_key => $array_item){
        $RETURN_STRING .= $array_key . $char2 . $array_item;
        if(array_last_key($array) != $array_key){
            $RETURN_STRING .= $char;
        }   
    }
    return $RETURN_STRING;
}

function array_from_string_value( $string, $char = ";", $char2 = "="){
    $RETURN_ARRAY = array();

    $KEYS = explode($char, $string);
    foreach($KEYS as $array_key ){
        $TO_ARRAY = explode( $char2, $array_key);
        $RETURN_ARRAY[$TO_ARRAY[0]] = $TO_ARRAY[1];
    }

    return $RETURN_ARRAY;
}

function array_to_js( $array ){
    $RETURN_STRING = "";
    foreach($array as $array_key => $array_item){
        $RETURN_STRING .= $array_key . ": '" . $array_item . "'";
        if(array_last_key($array) != $array_key){
            $RETURN_STRING .= ",";
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
    return sha1(md5($password).'#d%ggD34');
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
		
function to_time($czas){
	$str="";
	$s=0;
	$m=0;
	$h=0;
	while ($czas>=3600) { $h++; $czas-=3600; }; 
	while ($czas>=60) { $m++; $czas-=60; }; 
	$s = $czas;
	if ($h>0) { if ($h<10) $str = $str.'0'; $str = $str.$h; }else{ $str = $str."00"; }
	$str = $str.':';
	if ($m>0) { if ($m<10) $str = $str.'0'; $str = $str.$m; }else{ $str = $str."00"; }
	$str = $str.':';
	if ($s>0) { if ($s<10) $str = $str.'0'; $str = $str.$s; }else{ $str = $str."00"; }
	return $str;
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

function str_contain( $string, $contain ){
	if (strpos($string, $contain) !== false) {
		return true;
	}else{
		return false;
	}
}

function text($STRING)
{
	$z_bazy = 		array("%z", "%a", "%s", "%x", "%e", "%c", "%n", "%o", "%l", "%Z", "%A", "%S", "%X", "%E", "%C", "%N", "%O", "%L");
	$na_polskie   = array("ż", "ą", "ś", "ź", "ę", "ć", "ń", "ó", "ł", "Ż", "Ą", "Ś", "Ź", "Ę", "Ć", "Ń", "Ó", "Ł");
	
	return str_replace($z_bazy, $na_polskie, $STRING);
}

function show_Popup($HEADER, $MESSAGE, $BUTTONS=null ){
echo ""	
		."<script>"
		."   $(document).ready(function () {"
		."	$('#strona').append(\"<div id='back' style='background-color:black;'></div>\"); "
		."	$('#back').css({ 'width': ( ( $(document).width() ) )+'px' });"
		."	$('#back').css({ 'height': ( ( $(document).height() ) )+'px' });"
		."	$('#back').css({ 'left': 0 });"
		."	$('#back').css({ 'top': 0 });"
		."	$('#back').css({ 'opacity': 0 });"
		."	$('#back').animate({ 'opacity': 0.5 }, 1000);"
		."	$('#back').css({ 'position': 'absolute' });"
		."	$('#back').css({ 'z-index': '2' });"
		."	});"
		
		. "	$( window ).resize(function() { "
		."		$('#back').css({ 'width': ( ( $(document).width() ) )+'px' });"
		."		$('#back').css({ 'height': ( ( $(document).height() ) )+'px' });"
		."	 	$('#dialog').css({ 'left': ( ( $(window).width() / 2) - 200)+'px' });"
		."	});"
		."  </script>"
		." <div id='dialog'  style='width:400px; '>"
		."	<h1> ".$HEADER." </h1><p>".$MESSAGE."</p>";
		
	if ($BUTTONS != null){
		echo "<form action='index.php?ekran=".$_GET['ekran']."' method='post'>";
		foreach($BUTTONS as $BUTTON_NAME => $BUTTON_VALUE){
			echo "<button name='button' id='dialog_button' class='input' value='".$BUTTON_VALUE."'>".$BUTTON_NAME."</button>";
		};
		echo "</form>";
	}
	else echo "<button name='button' class='input' id='dialog_button'>Ok</button>";
		
		
	echo "</div>"
		."<script>"
		."   $(document).ready(function () {"
		."		$('#dialog').css({ 'left': ( ( $(window).width() / 2) - 200)+'px' });"
		."		$('#dialog').css({ 'opacity': 0 });"
		."  	$('#dialog').animate({ 'opacity': 1 }, 500);"
		."	 $('#dialog_button').click(function (){ "
		."	$('#dialog').animate({ 'opacity': 0 }, 800); "
		."	$('#dialog').animate({ 'z-index': '-1' }, 1); "
		."	$('#back').animate({ 'opacity': 0 }, 1000);"
		."	$('#back').animate({ 'z-index': '-1' }, 1);"
		."		});"				
		."	});"
		."  </script>";
		
}

function js( $script ){
	echo "<script> $script </script>";
}

function page_refresh(){
	header("location: " . this_url());
}
?> 