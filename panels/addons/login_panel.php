<?php
/*
 * NAZWA:   panel logowania
 * RODZAJ:  wszystkie typy
 * OPIS:    panel wyświetla prosty monit do logowania przy czym automatycznie loguje do danej strony, jej rodzaju
 * OSTATNIA AKTUALIZACJA: 19-02-2015
 */
	if($_SESSION['login']){
		echo "Witaj {$_SESSION['nick']}.
			<br />
			<input type='button' value='Wyloguj' onClick=\"post('" . this_url() . "', {wylogowanie: 'wylogowanie'})\"";
	}else{
			if ( (isset($_POST["username_"])) && (isset($_POST["password_"])) ) { // jezeli otrzyma dane do logowania

			$nick = clear($_POST["username_"]);
			$pass = codepass($_POST['password_']);

			$database = new db('fassh114_1');
			$USER_DATA = $database -> get_data("users", "*", true, "`nick` = '{$nick}' AND `pass` = '{$pass}'", true);

			if( $USER_DATA['id'] != "" ){
				if( $USER_DATA['ban'] <= time()){
					$_SESSION['login'] = true;
					$_SESSION['user_id'] = $USER_DATA['id'];
					$_SESSION['user_rank'] = $USER_DATA['rank'];

					$_SESSION['kind'] = $USER_DATA['kind'];
					$_SESSION['nick'] = $USER_DATA['nick'];

					page_refresh();
				}else{
					$_GET['error'] = "ban";
				}
				
			}else{
				$_GET['error'] = "true";
			}

			

		}
			echo "<center><div id='panel_logowania'>"
				."<form action='{$GLOBALS['SUBDOMEN']}.index.php?ekran=news' method='post'>"
				."Login: <input type='text' name='username_' class='input'></br>"
				."Hasło: <input type='password' name='password_' class='input'></br>"
				."<input type='submit' value='Zaloguj' class='input' id='guzik'>"
				."</form>";
			echo "Nie masz konta? <a onClick=\"window.location = '{$GLOBALS['SUBDOMEN']}.index.php?ekran=register'\">Zarejestruj się!</a><br /><a onClick=\"window.location = '{$GLOBALS['SUBDOMEN']}.index.php?ekran=recorvery'\">Przypomnienie hasła</a>";
		
	    
	    if ( isset($_GET['error']) ) { 
			if ($_GET['error']=='true') { 
				echo "<p class='error'>Błąd! Podano niewłaściwy login lub hasło.</p> </div></center>";
			} elseif($_GET['error']=='ban') {
				echo "<p class='error'>Błąd! Konto zostało zablokowane.</p> </div></center>";
			}
	    } else {
			echo "</div></center>";
		}
	}

?>