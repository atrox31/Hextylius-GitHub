<?php
/*
 * NAZWA:   Status fassh114_1a Minecraft BETA 1.1
 * RODZAJ:  MINECRAFT
 * OPIS:    Wyświetla status fassh114_1a minecraft oraz ilość graczy dostępnych na fassh114_1ze. (online / max)
 * OSTATNIA AKTUALIZACJA: 24-02-2015
 */
class MCServerStatus {
 
    public $server;
    public $online, $motd, $online_players, $max_players;
    public $error = "OK";
 
    function __construct($url, $port = '25565') {
 
        $this->server = array(
            "url" => $url,
            "port" => $port
        );
 
        if ( $sock = @stream_socket_client('tcp://'.$url.':'.$port, $errno, $errstr, 1) ) {
 
            $this->online = true;
 
            fwrite($sock, "\xfe");
            $h = fread($sock, 2048);
            $h = str_replace("\x00", '', $h);
            $h = substr($h, 2);
            $data = explode("\xa7", $h);
            unset($h);
            fclose($sock);

            //if (sizeof($data) == 7) {
                for($i = 0; $i<=sizeof($data)-3; $i++){
                    $this->motd .= $data[$i];   
                }
                
                $this->online_players = (int) $data[sizeof($data) - 2];
                $this->max_players = (int) $data[sizeof($data) - 1];
            /*} else {
                $this->error = "Cannot retrieve server info.";
            }*/
 
        }
        else {
            $this->online = false;
            $this->error = "Cannot connect to server.";
        }
        if($this->error != "OK"){
            echo $this->error;
        }
    }
 
}
    $serwer = new MCServerStatus("46.250.186.211");
    echo "<h4 style='margin:1px;'>STATUS SERWERA<br/> </h4>";
    if($serwer->online){
        echo "<span style='color:green;'>ONLINE</span><br />{$serwer->online_players} / {$serwer->max_players}";
    }else{
        echo "<span style='color:red;'>OFFLINE</span>";
    }
	//echo "STATUS fassh114_1A:<br />fassh114_11: <span style='color:green;'>ONLINE</span><br />fassh114_12: <span style='color:green;'>ONLINE</span><br />fassh114_13: <span style='color:red;'>OFFLINE</span><br />";
?>