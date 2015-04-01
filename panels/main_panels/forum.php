<?php
/*
    1. pobiera kategorie z bazu forum_categories
    2. pobiera najnowsze tematy z każdej kategori (max 8 - domyślnie)
    3. Pozwala przekierować na 
*/                                                      

if($_SESSION['login']){

    $database = new db("fassh114_1");

    // generowanie kategori
    if(!isset($_GET['cat'])){

        $ALL_CATEOGRY = $database -> get_data("forum_category", "*", false);

        while($CATEOGRY = mysql_fetch_assoc($ALL_CATEOGRY)){
            // dla każdej kategori
            echo "<div class='panel_content'>";
                echo "<h2 onClick='document.location = \"{$GLOBALS['SUBDOMEN']}.index.php?ekran=forum&cat={$CATEOGRY['id']}\";'>{$CATEOGRY['name']}</h2>
                    <hr />";

            FORUM::show_threads( $CATEOGRY['id'], 0, 5);
           
            echo "</div>";
        }
           
    }else{
        if(isset($_GET['post'])){
            if(isset($_POST['text'])){
                // jeżeli ktoś chce dodać wątek
                $MESSAGE = nl2br(clear($_POST['text']));
                $database -> insert_data("posts", "thread, author, time_add, content", "'{$_GET['post']}', '{$_SESSION['user_id']}', '" . time() . "', '{$MESSAGE}'");
                page_refresh();
            }
            FORUM::show_post( $_GET['post'] );
        }else{
            // sprawdź czy jest polecenie dodania postu
            if(isset($_POST['post']) ){
                if($_SESSION['user_rank'] >= 3){

                    // czas na twożenie nowego wątku
                    FORUM::create_new_thread();

                }else{
                    echo "<span class='error'>Żeby zakładać nowe wątki musisz posiadać wyższą rangę.</span>";
                }
            }
           
           

            if(!isset($_POST['post'])){

                if($_SESSION['user_rank'] >= 3){
                 // jeżeli wybrano kategorie pokaż listę wątków
                    echo "<input type='button' value='Dodaj wątek' onClick=\" post( '" . this_url() . "', { post: 'add' } ); \" />";
                }else{
                    echo "Żeby zakładać nowe wątki musisz posiadać wyższą rangę.";
                } 

                FORUM::show_threads( $_GET['cat'], 0, 12); 
            }
            
        }  
    }
}else{
    echo "Musisz się zalogować!";
}
                        