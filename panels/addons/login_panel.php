<?php
/*
 * NAZWA:   panel logowania
 * RODZAJ:  wszystkie typy
 * OPIS:    panel wyświetla prosty monit do logowania przy czym automatycznie loguje do danej strony, jej rodzaju
 * OSTATNIA AKTUALIZACJA: 19-02-2015
 */
	if($_SESSION['login']){
		echo "Witaj Atrox.";
	}else{
			if ( (isset($_POST["username_"])) && (isset($_POST["password_"])) ) { // jezeli otrzyma dane do logowania
			//TYMCZASOWO
			$_SESSION['login'] = true;
			$_SESSION['user_id'] = 1;
		} else { // jezeli nie ma danych do logowania
			echo "<center><div id='panel_logowania'>"
				."<form action='{$GLOBALS['SUBDOMEN']}.index.php?ekran=news' method='post'>"
				."Login: <input type='text' name='username_' class='input'></br>"
				."Hasło: <input type='password' name='password_' class='input'></br>"
				."<input type='submit' value='Zaloguj' class='input' id='guzik'>"
				."</form>";
			echo "Nie masz konta? <a onClick=\"post('{$GLOBALS['SUBDOMEN']}.index.php?ekran=register', {register: 'register'})\">Zarejestruj się!</a><br /><a onClick=\"post('metin2.index.php?ekran=recorvery', {recorvery: 'recorvery'})\">Przypomnienie hasła</a>";
		}
	    
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