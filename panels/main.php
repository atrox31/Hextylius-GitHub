<?php
/*
 * man.php zawiera ogólny zarys strony, twoży tabelkę główną, guziki funkcyjne i logo
 * jest globalne dla każdego i za bardzo się nie różni
 * require global_generate <- generuje cały kontent w środku
 */
	// zawsze nadawaj ekran
	if (!isset($_GET['ekran'])) { header("Location: index.php?ekran=news"); };
        // tymczasowe zastosowanie, dopuki nie ma w bazie danych
        if (!isset($_GET["page"])){ $_GET['page'] = "1"; }

	// rysowanie menu gracza
	echo "<div class='general_content'>";
            echo "<table style='text-align: center; margin: auto;vertical-align: top;'>";
                echo "<tr>";
            // nagłówek i guziki
                    echo "<td colspan='3'>";
                        echo "<div style='margin:auto; text-align: center;'>";
                            echo "<input type='button' value='Strona Główna' onClick='document.location = \"{$SUBDOMEN}.index.php?ekran=news\";' style='margin:auto 2% ;' />";
                            echo "<input type='button' value='Ranking'  style='margin:auto 2% ;' />";
                            echo "<input type='button' value='Forum' onClick='document.location = \"{$SUBDOMEN}.index.php?ekran=forum\";' style='margin:auto 2% ;' />";
                            echo "<input type='button' value='Pobieranie'  style='margin:auto 2% ;' />";
                        echo "</div>";
                    echo "</td>";
                echo "</tr>";
            // generalny kontant i panele
            
            require "panels/global_generate.php";
                
            echo "</table>";
	echo "</div>";
	

?>