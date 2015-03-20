<?php
// logika
$database = new db("fassh114_1");
$PAGE = $database -> get_data("pages", "*", true, "`kind` = '{$GLOBALS['SUBDOMEN']}'");

$GLOBALS['NEWS_PER_PAGE'] = $PAGE['news_per_page'];
// jeżeli któryś z paneli coś zawiera to przydziel jego zawarość
// jeżeli nie zostaw zmienną pustą, żeby nie generować panelu
$LEFT_PANEL = ($PAGE['left_panel'] == "" ? NULL : explode(",", $PAGE['left_panel']));
$RIGHT_PANEL = ($PAGE['right_panel'] == "" ? NULL : explode(",", $PAGE['right_panel']));
        /*
         * 
         *  newsy( int `id`, varchar `title`, varchar `content`, int `time`)
         * 
         */
//grafika
echo "<tr>";
                    echo "<td style='vertical-align: top;'>";
                    // lewy panel
                    // <- pobiera i include "panels/addons/{$_GET['ekran']}.php";
                    if(!empty($LEFT_PANEL)){
                        echo "<div class='panel_content'>";    
                            foreach($LEFT_PANEL as $PANEL){
                                if($PANEL != ""){
                                    // pokazuje panel
                                    echo "<div class='panel_content'>";
                                    include "panels/addons/{$PANEL}.php";
                                    echo "</div>";
                                    // jeżeli element czyli $PANEL nie jest ostatnim to narysuj <hr />
                                    // zabieg kosmetyczny do ewentualnego usunięcia, aczkolwiek ładne xD
                                    if($PANEL != $LEFT_PANEL[array_last_key($LEFT_PANEL)]){
                                        echo "<hr />";
                                    }
                                }
                            }
                        echo "</div>";
                    }
                    echo "</td>";
                    echo "<td class='panel_content'  style='vertical-align: top; width:100%'>";
                        // centrum strony
                        echo "<div style=''>"; 
                        if(file_exists("panels/main_panels/{$_GET['ekran']}.php")){
                            include "panels/main_panels/{$_GET['ekran']}.php";
                        }else{
                            echo "<strong>BŁĄD 404! ( ͡° ͜ʖ ͡°)</strong><br />Strona nie odnaleziona.";
                        }
                        echo "</div>";  
                        
                    echo "</td>";
                    echo "<td style='vertical-align: top;'>";
                        // prawy panel
                        // <- pobiera i include "panels/addons/{$_GET['ekran']}.php";
                    if(!empty($RIGHT_PANEL)){
                        echo "<div class='panel_content'>";
                             foreach($RIGHT_PANEL as $PANEL){
                                if($PANEL != ""){
                                    echo "<div class='panel_content'>";
                                    include "panels/addons/{$PANEL}.php";
                                    echo "</div>";
                                    if($PANEL != $RIGHT_PANEL[array_last_key($RIGHT_PANEL)]){
                                        echo "<hr />";
                                    }
                                }
                            }
                        echo "</div>"; 
                    }
                    echo "</td>";
                echo "</tr>";