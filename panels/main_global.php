<?php
	// zawsze nadawaj ekran
	if (!isset($_GET['ekran'])) { header("Location: index.php?ekran=main"); };
	
        // logika
        
	// rysowanie menu gracza
	echo "<div class='general_content' style='border:0px;'>";
       
        // tabelka z podstronami
        echo "<table style='margin: auto; height:100%; border-spacing: 20px;'>"
        . "     <tr>"
        . "         <td style='text-align: center;'  class='panel_content'>"
        . "             <img src='grafika/metin2_norm.png' id='metin2' class='image_to_hover'/>"
        . "         </td>"
        . "         <td style='text-align: center;' class='panel_content'>"
        . "             <img src='grafika/tibia_norm.png' id='tibia'  class='image_to_hover'/>"
        . "         </td>"
        . "         <td style='text-align: center;' class='panel_content'>"
        . "             <img src='grafika/minecraft_norm.png' id='minecraft'  class='image_to_hover'/>"
        . "         </td>"
        . "     </tr>"
        . "   </table>";
        
        echo "</div>";
        
        // galeria z newsami
        echo "<div class='general_content'>";
        // TU BĘDZIE SKRYPT Z GALERIĄ
        //echo "<div style='width:90%; height: 90%; text-align: center;' > GALERIA </div>";
        $database = new db("fassh114_1");
		$GALERIA = $database->get_data("news", "*", false, " '1' = '1' LIMIT 3", true);
        echo "<div id='coin-slider' style='margin:auto;'>";
        while($SINGLE_IMAGE = mysql_fetch_array($GALERIA)){
            echo "
                <a href='{$SINGLE_IMAGE['kind']}.index.php?ekran=post&id={$SINGLE_IMAGE['id']}' target='_blank'>
                    <img id='img_{$SINGLE_IMAGE['id']}' src='grafika/";
            if ($SINGLE_IMAGE["image"] == ""){
                echo $SINGLE_IMAGE['kind'] . ".png";
            }else{
                echo $SINGLE_IMAGE["image"];
            }

            echo "' >
                    <span><h3 style='margin:0px; padding:0px;'>{$SINGLE_IMAGE["title"]}</h3>";
					for($i=0; $i<=60; $i++){
						$SINGLE_IMAGE["content"][$i];
					}
			echo "</span>
                </a>";
        }
        echo "</div><script type='text/javascript'>
    $(document).ready(function() {
        $('#coin-slider').coinslider({ width: 600, height: 400, navigation: true, delay: 5000 });
    });
</script>";
        
	echo "</div>";

        // skrypt kolorujący łądnie grafiki po najechaniu myszą
	echo "<script>
                $('.image_to_hover')
                    .mouseover(function() {
                        $( this ).attr('src','grafika/'+ $(this).attr('id') +'.png');
                    })
                    .mouseout(function() {
                        $( this ).attr('src','grafika/'+ $(this).attr('id') +'_norm.png');
                    })
                    .click( function() {
                        window.location = $(this).attr('id')+'.index.php?ekran=news';
                    });
            </script>";
?>