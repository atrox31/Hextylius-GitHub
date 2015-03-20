<?php	
	session_start();
        //error_reporting( error_reporting() & ~E_NOTICE );
        if (!isset($_SESSION["ADMINlogin"])) { $_SESSION["ADMINlogin"] = false; }
        
	// wylogowanie zanim strona zacznie się generować.
	if (isset($_POST["wylogowanie"])) { session_destroy(); header("Location: index.php"); }
        /*
         * funkcja buffer zmniejsza zużycie danych
         * usuwa wszelkie spacje, entery i inne białe niepotrzebne znaki
         * dodatkowo wścibscy mają problem z przejżeniem kodu
         */
	
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

    <link rel='stylesheet' href='css/main.css' type='text/css' />
    <link rel='stylesheet' href='css/alpha.css' type='text/css' />
</head>
<body>
<div id='strona'>

    <?php
        // implementacja silnika i przydatnych funkcji
	   require_once "scripts/core.php";
    
        // sprawdzenie czy zalogowano
        if(isset($_POST["username_"]) && isset($_POST["password_"])){
            // czyszczenie danych
            $database = new db("fassh114_1");
            $LOGIN = clear($_POST["username_"]);
            $PASS = codepass(clear($_POST["password_"]));
            
            if( ($NICK = $database -> get_data("admin", "*", true, "`login` = '{$LOGIN}' AND `pass` = '{$PASS}'")) !== false ){
                $_SESSION["ADMINlogin"] = true;
                $_SESSION["ADMIN"] = $NICK["login"];
            }
        }
        
        // rysowanie całego kontentu
        if($_SESSION["ADMINlogin"] == true){ // jeżeli admin jest zalogowany
            echo "<div class='general_content'>"
            ."   <div style='float: right; height: 100%;' ><form action='admin_panel.php' method='post'>"
            ."<input type='submit' value='Wyloguj' name='wylogowanie' class='input' id='guzik'>"
            ."</form></div> ";
   
            echo "KONTENT MENU ADMINA <br /><HR />";
             
            if(isset($_GET['ekran'])){
                switch($_GET['ekran']){
                    case "main":
                        echo "<a href='admin_panel.php?ekran=NJUSY'>ZARZĄDANIE NJUSAMI</a><br />";
                        echo "<a href='admin_panel.php?ekran=PANELE'>ZARZĄDZANIE PANELAMI</a><br />";
                        //echo "<a href='index.php?ekran='></a><br />";
                        //echo "<a href='index.php?ekran='></a><br />";
                    break;
                    case "NJUS_DODAJ":
                        if(isset($_POST["type"]) && isset($_POST["title"]) && isset($_POST["content"])){
                            $database = new db("fassh114_1");
                            $KIND = clear($_POST["type"]);
                            $TITLE = clear($_POST["title"]);
                            $CONTENT = clear($_POST["content"]);
                            $DATE = time();
                            $AUTHOR = $_SESSION['ADMIN'];

                            if (isset( $_FILES['image'] ) && ( $_FILES['image']['name'] )){
                                if (($IMAGE = get_image('image')) == false) {
                                    echo  "Coś nie tak z dołączoną grafiką!<br />" ; 
                                }
                            }else{
                                // domyślny obrazek to ikona danego serwisu
                                $IMAGE = $KIND . ".png";
                            }

                            $database->insert_data("news", "`kind`, `title`, `content`, `date`, `author`, `image`", "'{$KIND}', '{$TITLE}', '{$CONTENT}', '{$DATE}', '{$AUTHOR}', '{$IMAGE}'");
                             header("Location: admin_panel.php?ekran=NJUSY");
                            
                        }else{
                            echo "<form action='admin_panel.php?ekran=NJUS_DODAJ' method='post' enctype='multipart/form-data'>"
                            . "     <table border='1px' cellpadding='10px'>";
                            echo "  <tr>";
                            echo "      <td><strong>RODZAJ</strong>";
                            echo "      </td>";
                            echo "      <td><strong>TYTUŁ</strong>";
                            echo "      </td>";
                            echo "      <td><strong>OBRAZ</strong>";
                            echo "      </td>"; 
                            echo "      <td><strong>TREŚĆ</strong>";
                            echo "      </td>";
                            echo "  </tr>";
                            echo "  <tr>";
                            echo "      <td>";
                                echo "  <input type='radio' name='type' value='minecraft'> Minecraft<br>
                                        <input type='radio' name='type' value='metin2'> Metin2<br>
                                        <input type='radio' name='type' value='tibia'> Tibia<br> ";
                            echo "      <td>";
                                echo "<input type='text' name='title' />";
                            echo "      </td>";
                            echo "      <td>";
								
                                echo "<input type='file' name='image' />";
                            echo "      </td>";
                            echo "      </td>";
                            echo "      <td>";
                                echo "<textarea rows='1' cols='10' type='text' name='content' autofocus >treść...</textarea>";
                            echo "      </td>";
                            echo "  </tr>";
                            echo "</table><br /><input type='submit' value='Dodaj'></form>";
                        }
                    break;
                    case "NJUSY":
                        echo "<a href='admin_panel.php?ekran=main'>WRYĆ!</a><br /><HR/>";
                        
                        $database = new db("fassh114_1");
                        //sprawdzenie czy jest delete
                        if(isset($_POST['delete'])){
                            $database->delete_data("news", "`id` = '".clear($_POST['delete'])."'");
                        }
                        
                        echo "<a href='admin_panel.php?ekran=NJUS_DODAJ'>Dodaj newsa!</a><br /><HR/>";
                        echo "<table border='1px' cellpadding='10px'>";
                        echo "  <tr>";
                        echo "      <td><strong>RODZAJ</strong>";
                        echo "      </td>";
                        echo "      <td><strong>TYTUŁ</strong>";
                        echo "      </td>";
						echo "		<td><strong>OBRAZEK</strong>";
                        echo "      </td>";
                        echo "      <td><strong>TREŚĆ</strong>";
                        echo "      </td><td><strong>USUŃ</strong>";
                        echo "      </td>";
                        echo "  </tr>";
                       
                        $NJUSY = $database -> get_data("news", "*", false, "0=0  ORDER BY `date` DESC");
                        while($CONTENT = mysql_fetch_array($NJUSY)){
                            echo "      <tr><td>{$CONTENT['kind']}";
                            echo "      </td>";
                            echo "      <td>{$CONTENT['title']}";
                            echo "      </td>";
                            echo "      <td>{$CONTENT['image']}";
                            echo "      </td>";
                            echo "      <td>{$CONTENT['content']}";
                            echo "      </td><td>"
                            . "<input type='button' onclick=\"post('admin_panel.php?ekran=NJUSY', {delete: '{$CONTENT['id']}'})\" value='USUŃ'/></td></tr>";
                        }
                        
                        echo "</table>";
                        
                    break;
                    case "PANELE":
                        echo "<a href='admin_panel.php?ekran=main'>WRYĆ!</a><br /><HR/>";
                        
                        $database = new db("fassh114_1");
                        // zmiany dokonane na żądanie
                        if(isset($_POST['add'])){
                    
                            // add: '{$_PANEL}, from: '{$PAGE['kind']}', side: 'left'
                            $ACTUAL_SIDE = $_POST['side']."_panel";
                            $KIND = clear($_POST['from']);
                            $IMAGE = clear($_POST['image']);
                            $FROM_PANEL = $database -> get_data("pages", $ACTUAL_SIDE, true, "`kind` = '{$KIND}'");
                            if($FROM_PANEL[$ACTUAL_SIDE] != ""){
                                $TO_BASE = $FROM_PANEL[$ACTUAL_SIDE] . "," . clear($_POST['add']);
                            }else{
                                $TO_BASE = clear($_POST['add']);
                            }
                            $database ->update_data("pages", "`{$ACTUAL_SIDE}` = '{$TO_BASE}'", "`kind` = '{$KIND}'");
                        
                            // przekierowanie zapobiegające możliwosci odświerzenia strony
                            header("Location: admin_panel.php?ekran=PANELE");
                        }
                        // jeżeli żądanie usunięcia
                        if(isset($_POST['delete'])){
                    
                            //delete: '{$PANEL}, from: '{$PAGE['kind'], side: left/right}'  
                            $ACTUAL_SIDE = $_POST['side']."_panel";
                            $KIND = clear($_POST['from']);
                            $DELETE = clear($_POST['delete']);
                            
                            $FROM_PANEL = $database -> get_data("pages", $ACTUAL_SIDE, true, "`kind` = '{$KIND}'", true);
                            if($FROM_PANEL[$ACTUAL_SIDE] != ""){    //jeżeli jest puste to nie ma co usunąć, taki śmieszek z uzyszkodnika...
                                //$TO_BASE = $FROM_PANEL[$ACTUAL_SIDE] . "," . clear($_POST['add']);
                                $NEW_PANELS = array();
                                $PANELS = explode(",", $FROM_PANEL[$ACTUAL_SIDE]);
                                foreach($PANELS as $PANEL){
                                    if($PANEL != $DELETE){
                                        $NEW_PANELS[] = $PANEL;
                                    }
                                }
                                if(empty($NEW_PANELS)){
                                    $TO_BASE = "";
                                }else{
                                    $TO_BASE = array_to_string($NEW_PANELS);
                                }
                                $database ->update_data("pages", "`{$ACTUAL_SIDE}` = '{$TO_BASE}'", "`kind` = '{$KIND}'");                                                                                                                                                                                                                                           //nic tu nie znajdziesz ^.^
                                
                                // przekierowanie zapobiegające możliwosci odświerzenia strony
                                header("Location: admin_panel.php?ekran=PANELE");
                            }else{
                                echo "BŁĄD! Panel nie istnieje tam skąd ma być usunięty!<br />( ͡° ͜ʖ ͡°)";
                            }
                        }
                        /*
                         * pobiera strony z bazy, na wypadek gdyby było ich więcej w przyszłość
                         * a robi to po to żeby proceduralnei wygererować dla nich wszystkich tabelki
                         */
                        $PAGES = $database -> get_data("pages", "*", false);
                        while($PAGE = mysql_fetch_array($PAGES)){
                            // tablica przechowuje panele które są na stronie, więc nie nadają się do dodania
                            $PANELS_ON_PAGE = array();
                            // tak wiem... burdel
                            echo "  <table class='panel_content'>"
                            . "         <tr>"
                                    . "     <td colspan='2'>"
                                    . "         <h2>{$PAGE['name']}</h2>"
                                    . "     </td>"
                                    . " </tr>" // kontent
                                    . "<tr>"
                                    . "     <td class='panel_content'><strong>Lewy panel</strong><hr />";// lewy panel
                                    if($PAGE['left_panel'] != ""){
                                       $LEFT_PANEL = explode(",", $PAGE['left_panel']);
                                       foreach($LEFT_PANEL as $PANEL){
                                           $PANELS_ON_PAGE[] = $PANEL;
                                       
                                            echo "<div class='panel_content'><strong>{$PANEL}</strong><br />"
                                            . "   <input type='button' value='usuń' onclick=\"post('admin_panel.php?ekran=PANELE',{delete: '{$PANEL}', from: '{$PAGE['kind']}', side: 'left'} )\" /></div>";

                                            if($PANEL != $LEFT_PANEL[array_last_key($LEFT_PANEL)]){
                                                echo "<hr />";
                                            }
                                        }
                                    }else{
                                        echo "Brak paneli.";
                                    }
                                    echo "     </td>"       
                                    . "     <td class='panel_content'><strong>Prawy panel</strong><hr />";// prawy panel
                                    if($PAGE['right_panel'] != ""){
                                       $RIGHT_PANEL = explode(",", $PAGE['right_panel']);
                                        foreach($RIGHT_PANEL as $PANEL){
                                           $PANELS_ON_PAGE[] = $PANEL;
                                           
                                            echo "<div class='panel_content'><strong>{$PANEL}</strong><br />"
                                            . "   <input type='button' value='usuń' onclick=\"post('admin_panel.php?ekran=PANELE',{delete: '{$PANEL}', from: '{$PAGE['kind']}', side: 'right'})\" /></div>";
                    
                                            if($PANEL != $RIGHT_PANEL[array_last_key($RIGHT_PANEL)]){
                                                echo "<hr />";
                                            }
                                        }
                                    }else{
                                        echo "Brak paneli.";
                                    }
                                    echo "     </td>"
                                    . " </tr>"
                                    . "<tr>"    // jeżeli wygenerował już wszystkie panele to niech da możliwość dodania kolejnyvh dostępnych
                                    . "     <td colspan='2'>";
                                    // dla wszystkich dodatkowych paneli dostępnych

                                    foreach (glob(dirname(__FILE__) . "/panels/addons/*.php") as $_PANEL){
                                        //echo $_PANEL;
                                        // wywal z nazwy pliku jego ścieżkę i roższeżene
                                        $_PANEL = str_replace(dirname(__FILE__) . "/panels/addons/", "", $_PANEL);
                                        $_PANEL = str_replace(".php", "", $_PANEL);
                                        if(!in_array($_PANEL, $PANELS_ON_PAGE)){
                                            // jeżeli panel nie jest już dodany to zaproponuj jego dodanie
                                            echo "<div class='panel_content' style='float:left'><strong>{$_PANEL}</strong><br />";
                                            
                                            // generowanie opisu z szablonu addonu, czyli pierwsze 7 linijek
                                            $PANEL_DESC = file(dirname(__FILE__) . "/panels/addons/{$_PANEL}.php");
                                            for($i=2; $i<6; $i++){
                                                echo $PANEL_DESC[$i] . "<br />";
                                            }
                                            
                                            echo "   <input type='button' value='Dodaj do lewego' onclick=\"post('admin_panel.php?ekran=PANELE',{add: '{$_PANEL}', from: '{$PAGE['kind']}', side: 'left'})\" />"
                                            . "   <input type='button' value='Dodaj do prawego' onclick=\"post('admin_panel.php?ekran=PANELE',{add: '{$_PANEL}', from: '{$PAGE['kind']}', side: 'right'})\" />"
                                            . "</div>";
                                        }
                                    }
                                    echo  "     </td>"
                                    . "</tr>"
                            . "     </table>";
                        }
                        
                    break;
                }
            } else{
                header("Location: admin_panel.php?ekran=main");
            }
            
            echo "</div>";
             
        } else{  // panel do logowania
            echo "<div style='margin: auto; text-align: center;' class='general_content'>"
            . "   <form action='admin_panel.php' method='post'>"
            ."Login: <input type='text' name='username_' class='input'></br>"
            ."Hasło: <input type='password' name='password_' class='input'></br>"
            ."<input type='submit' value='Zaloguj' class='input' id='guzik'>"
            ."</form>  "
            . "</div>";
        }
?>

    </div>
    <div id='stopka'>
        Czas fassh114_1a: <?php echo date('H:i:s',time()); ?> | fassh114_1: s1 | <a href='about.php' style='color:white;'>Kontakt</a>
    </div>
</body>
</html>