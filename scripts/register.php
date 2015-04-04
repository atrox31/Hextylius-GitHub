<?php
require "artCore.php";

	$database = new db("fassh114_1");
	
	//if (!empty($_GET['username']) || !empty($_GET['password']) || !empty($_GET['repassword']) || !empty($_GET['email'])) {
	
		
			
		$AVABLE_SOBDOMEN = array("minecraft", "metin2", "tibia");								
		if(in_array($_GET['subdomen'], $AVABLE_SOBDOMEN)){
			if ($_GET['username'] != ""){
				$_GET['username'] = clear($_GET['username']);
				if($database -> count_data('users', 'id', "`nick` = '{$_GET['username']}'") <= 0) {
					if (strlen($_GET['username']) >= 5 ) {			
						if (filter_var($_GET['email'], FILTER_VALIDATE_EMAIL) !== false){	
							$_GET['email'] = clear($_GET['email']);
							if($database -> count_data('users', 'id', "`email` = '{$_GET['email']}'") <= 0) {
								if (strlen($_GET['password']) >= 6 ){
									if ($_GET['password'] == $_GET['repassword'] ){
										if ($_GET['terms'] == "true"){

											
									        $_GET['password'] = clear($_GET['password']);
									        $_GET['repassword'] = clear($_GET['repassword']);
									        
									        $_GET['subdomen'] = clear($_GET['subdomen']);

											$db = new db("fassh114_1");
											$db -> insert_data("users", "`nick`, `pass`, `kind`, email", "'{$_GET['username']}', '" . codepass($_GET['password']) . "', '{$_GET['subdomen']}', '{$_GET['email']}'");
											echo "<script> window.location = '{$_GET['subdomen']}.index.php?ekran=register_complite' </script>";
											

										}else{ echo "<p class='error'> Musisz zaakceptować warunki regulaminu! </p>"; };
									}else{ echo "<p class='error'> Podane hasła różnią się! </p>"; };
								}else{ echo "<p class='error'> Hasło musi mieć conajmniej 6 znaków! </p>"; };
							}else {echo "<p class='error'> E-mail zajęty, spróbuj <a href='index.php?ekran=recovery' >przypomnieć hasło</a>! </p>"; };
						}else{ echo "<p class='error'> Nieprawidłowy e-mail! </p>"; };	
					}else{ echo "<p class='error'> Nick musi mieć conajmniej 5 znaków! </p>"; };
				}else {echo "<p class='error'> Nick zajęty! </p>"; };
			}else{ echo "<p class='error'>Wpisz nick! </p>"; };
		}else{ echo "<p class='error'Zła strona! </p>"; };
	//}