<?php
$database = new db("fassh114_1");
$ALL_NEWS =$database -> get_data("news", "*", false, "`kind` = '{$GLOBALS["SUBDOMEN"]}' ORDER BY `date` DESC");

$NEWSY = array();
$i = 1;
while($N = mysql_fetch_array($ALL_NEWS)){
    $NEWSY[$i] = array();
    foreach($N as $FIELD => $VALUE){
        $NEWSY[$i][$FIELD] = $VALUE;
    }
    $i++;
}
                            for($i=((intval($_GET["page"]))*$GLOBALS['NEWS_PER_PAGE'])-($GLOBALS['NEWS_PER_PAGE']-1); $i<=intval($_GET["page"])*$GLOBALS['NEWS_PER_PAGE']; $i++){
                                if(isset($NEWSY[$i])){
                                echo "<p><h2>{$NEWSY[$i]["title"]}</h2>";
                                if(count($NEWSY[$i]["content"]) <= 200){
                                    for($k=0; $k<=200; $k++){
                                        echo $NEWSY[$i]["content"][$k];
                                    };
                                    echo "... <a href='{$GLOBALS["SUBDOMEN"]}.index.php?ekran=post&id={$NEWSY[$i]["id"]}'>[czytaj dalej]</a>";
                                }else{
                                    echo $NEWSY[$i]["content"];
                                }
                                echo "<br /><div class='date'>".(date("d.m.y / H:i:s", $NEWSY[$i]["date"]))."</div></p>";
                                }
                            }

                            // generowanie licznika podstron
                            for($j=1; $j<=ceil(count($NEWSY)/$GLOBALS['NEWS_PER_PAGE']); $j++){
                                if($j != intval($_GET['page'])){
                                    echo " [<a href='{$GLOBALS["SUBDOMEN"]}.index.php?ekran={$_GET["ekran"]}&page={$j}'>{$j}</a>] ";
                                }else{
                                    echo " [{$j}] ";
                                }
                            }