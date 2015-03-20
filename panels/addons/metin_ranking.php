<?php
/*
 * NAZWA:   Ranking top 10 graczy z Metin 2 alpha 0.1
 * RODZAJ:  METIN
 * OPIS:    Prosty ranking pokazujący najlepszych graczy według ich poziomu, oraz gildie
 * OSTATNIA AKTUALIZACJA: 24-02-2015
 */
function METIN_GENERATE_NAME(){
    $LETTERS = rand(5,12);
    $NAME = substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", $LETTERS)), 0, $LETTERS);
    $NAME[0] = strtoupper($NAME[0]);
    return $NAME;
}

// dla celów alpha gracze i gildie są generowane
$PLAYERS = array();
$GUILDS = array();
$KINGDOMS = array ("Chunjo", "Shinsoo", "Jinno");
for($i=1; $i<=10; $i++){
    $PLAYERS[] = array(
        'nick'  => METIN_GENERATE_NAME(),
        'level' => rand(290-($i*10), 300-($i*10)),
        //              290 300
        //              280 290
        //              270 280
        //              290-($i*10)
        'kingdoom' => array_rand($KINGDOMS)
    );
    
    $GUILDS[]['name'] = METIN_GENERATE_NAME();
}
////////////////////////////////////////////////
$PLAYERS_LIST = "";
$GUILD_LIST = "";
//while($PLAYER = mysql_fetch_array($PLAYERS)){
for($i=0; $i<10; $i++){
    $PLAYERS_LIST .= "<li>{$PLAYERS[$i]['nick']} ({$PLAYERS[$i]['level']})</li>";
    //$PLAYERS_LIST .= "<li>{$PLAYER['nick']} ({$PLAYER['level']})</li>";
    
    $GUILD_LIST .= "<li>{$GUILDS[$i]['name']}</li>";
    //$GUILD_LIST .= "<li style='height:100%; text-align: left;'>{$GUILD['name']}</li>";
}

echo  "<script>
     var PlayerList = \"{$PLAYERS_LIST}\";
     var GuildList = \"{$GUILD_LIST}\";
     $(document).ready(function(){
                // wyświetl domyślną liste graczy
             $('#metin_ranking_list_content').html( PlayerList );
             $('#metin_ranking_players').css('border-bottom', '0px');
        
             $('#metin_ranking_players').click(function(){
                 $('#metin_ranking_list_content').html( PlayerList );
        
                 $('#metin_ranking_players').css('border-bottom', '0px solid');
                 $('#metin_ranking_guilds').css('border-bottom', '4px solid');
             });     
             $('#metin_ranking_guilds').click(function(){
                  $('#metin_ranking_list_content').html( GuildList );
                  
                 $('#metin_ranking_players').css('border-bottom','4px solid');
                 $('#metin_ranking_guilds').css('border-bottom','0px solid');
             });     
        });
    </script>
        <table style='width:100%;'  cellpadding='0'>
         <tr>
             <td id='metin_ranking_players' style='border: 4px solid black; width:50%;'>
                 <h4>Gracze</h4>
             </td>
             <td id='metin_ranking_guilds' style='border: 4px solid black; width:50%;'>
                 <h4>Gildie</h4>
             </td>
         </tr>
         <tr>
             <td colspan='2'   style='text-align: left; border: 4px solid black; border-top: 0px solid;'>
                 <ul id='metin_ranking_list_content' type='number'>
                     jeżeli to widzisz to coś poszło nie tak
                     
                 </ul>
             </td>
         </tr>
        </table>";
