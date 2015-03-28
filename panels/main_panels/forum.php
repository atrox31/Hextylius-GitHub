<?php
/*
    1. pobiera kategorie z bazu forum_categories
    2. pobiera najnowsze tematy z każdej kategori (max 8 - domyślnie)
    3. Pozwala przekierować na 
*/
if($_SESSION['login']){

    // limit wątków do wyświetlenia na wstępie
    $LIMIT_THREAD = 8; 

    $database = new db("fassh114_1");

    // generowanie kategori
    if(!isset($_GET['cat'])){
        $ALL_CATEOGRY = $database -> get_data("forum_category", "*", false);

        while($CATEOGRY = mysql_fetch_array($ALL_CATEOGRY)){
            // dla każdej kategori
            echo "<div class='panel_content'>";
                echo "<h2 onClick='document.location = \"{$SUBDOMEN}.index.php?ekran=forum&cat={$CATEOGRY['id']}\";'>{$CATEOGRY['name']}</h2>
                    <hr />";

                    $TO_DISPLAY = "";

            // pobierz wszystkie aktualne wątki ( domyślnie 8)
            $THREADS = $database -> get_data("forum_threads", "*", false, "`category` = '{$CATEOGRY['id']}' ORDER BY last_answer DESC LIMIT {$LIMIT_THREAD}");
           
                 while($THREAD = mysql_fetch_array($THREADS)){
                    $AUTHOR = $database -> get_data("users", "*", true, "`id` = '{$THREAD['author']}'", true);

                                $TO_DISPLAY .= "  <div style='panel_content'>
                                            <table style='width: 100%'>
                                                <tr>
                                                    <td>
                                                        {$AUTHOR['nick']}
                                                    </td>
                                                    <td style='text-align:right;'>
                                                        <h3 onClick='document.location = \"{$SUBDOMEN}.index.php?ekran=forum&cat={$CATEOGRY['id']}&post={$THREAD['id']}\";' >{$THREAD['name']}</h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan='2' style='text-align:right;'>
                                                    " . date("H:i", $THREAD['last_answer']) . "
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>";
                            
                }
            if($TO_DISPLAY != ""){
                echo $TO_DISPLAY;
            }else{
                echo "Brak wątków!";
            }
           
            echo "</div>";
        }
           
    }else{
        // jeżeli wybrano kategorie pokaż listę wątków
        $_GET['cat']
    }
}else{
    echo "Musisz się zalogować!";
}
                        