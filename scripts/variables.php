<?php
	if ((strpos($_SERVER['HTTP_HOST'], '192.168') !== FALSE)||($_SERVER['HTTP_HOST'] == 'localhost')){ // jeżeli serwer jest w domku to dawaj te pasy, inaczej internetowe
		define("GLOBAL_BASE_HREF", "localhost", true);

		$GLOBALS['GLOBAL_BASE_USER']["fassh114_1"] = "root";
		$GLOBALS['GLOBAL_BASE_PASS']['fassh114_1'] = "zaq1@WSX";
		$GLOBALS['GLOBAL_BASE_USE']['fassh114_1'] = "fassh114_1";

	}else{

		define("GLOBAL_BASE_HREF", "localhost", true);

		$GLOBALS['GLOBAL_BASE_USER']['fassh114_1'] = "fassh114_1";
		$GLOBALS['GLOBAL_BASE_PASS']['fassh114_1'] = "ptPXPF6A";
		$GLOBALS['GLOBAL_BASE_USE']['fassh114_1'] = "fassh114_1";
		
	};
