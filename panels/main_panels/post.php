<?php
$database = new db("fassh114_1");
$ID = clear($_GET["id"]);
$NEWSY =$database -> get_data("news", "*", true, "`kind` = '{$GLOBALS["SUBDOMEN"]}' AND `id` = '$ID'");

if($NEWSY){
    echo "<p><h2>{$NEWSY["title"]}</h2>";
    echo $NEWSY["content"];
    echo "<br /><div class='date'>".(date("m.d.y / H:i:s", $NEWSY["time"]))."</div></p>";
}else{
    echo "<strong>Błąd 404! ( ͡° ͜ʖ ͡°)</strong> Nie znaleziono posta.";
}