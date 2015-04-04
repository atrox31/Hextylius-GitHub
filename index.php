<?php	
	$VERSION = '0.2.0 alpha';
	session_start();
        error_reporting( error_reporting() & ~E_NOTICE );
        if (!isset($_SESSION["gamelogin"])) { $_SESSION["gamelogin"] = false; }
        
	// wylogowanie zanim strona zacznie się generować.
	if (isset($_POST["wylogowanie"])) { session_destroy(); header("Location: index.php"); }
        /*
         * funkcja buffer zmniejsza zużycie danych
         * usuwa wszelkie spacje, entery i inne białe niepotrzebne znaki
         * dodatkowo wścibscy mają problem z przejżeniem kodu
         */
	function BUFFER($buffer){
		//$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		//$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  '), '', $buffer);
		return $buffer;
	}	
	ob_start('BUFFER');
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'>
	<meta name='Description' content='OPIS'>
	<meta name='Keywords' content='KLUCZOWE'>
	<meta name='Author' content='Ex Favilla Games'>
	<meta name='Generator' content='NetBeans'>
	
	<title>Hextylius</title>

<?php
    // implementacja skryptów
    foreach (glob("js/*.js") as $filename){
        echo "<script type='text/javascript' src='{$filename}' ></script>";
    }
?>

<link rel='stylesheet' href='css/alpha.css' type='text/css' />
<link rel='stylesheet' href='css/main.css' type='text/css' />
<link rel='stylesheet' href='css/forum.css' type='text/css' />

</head>
<body>
	<div id='strona'>

	<?php
	    // inplementacja silnika i przydatnych funkcji
		require "scripts/artCore.php";
	        
	    // rysowanie całego kontentu
	    require 'panels/main_global.php';
	?>

	</div>
	<div id='stopka'>
		Czas serwera: <?php echo date('H:i:s',time()); ?> | Serwer: s1 | <a href='about.php' style='color:white;'>Kontakt</a>
	</div>
</body>
</html>

<?php
	ob_end_flush();
?>