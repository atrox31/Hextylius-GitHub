<?php	
	$VERSION = '0.1.0 alpha';
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

    <title>Hextylius - Metin2</title>

<?php
    // implementacja skryptów
    foreach (glob("js/*.js") as $filename){
        echo "<script type='text/javascript' src='{$filename}' ></script>";
    }
?>

    <link rel="shortcut icon" href="grafika/metin2.png" />
    <link rel='stylesheet' href='css/main.css' type='text/css' />
    <link rel='stylesheet' href='css/metin2.css' type='text/css' />
</head>
<body>
    <div id='strona'>

        <?php
            // inplementacja silnika i przydatnych funkcji
        	require_once "scripts/core.php";
                
            // tymczasowo
            $GLOBALS["SUBDOMEN"] = "metin2";
                
            // rysowanie całego kontentu
            require 'panels/main.php';
        ?>
        
        <div id='stopka'>
            Czas serwera: <?php echo date('H:i:s',time()); ?> | Serwer: s1 | <a href='about.php' style='color:white;'>Kontakt</a>
        </div>
    </div>
</body>
</html>

<?php
	ob_end_flush();
?>