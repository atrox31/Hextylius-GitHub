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
		$GALERIA = $database->get_data("news", "*", false, " '1' = '1' LIMIT 3");

        echo "<div id='slider1_container' style='position: relative; top: 0px; left: 0px; width: 600px; height: 300px; margin: auto;'>
                 <div u='slides' style='cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; width: 600px; height: 300px;'>";
        while($SINGLE_IMAGE = mysql_fetch_array($GALERIA)){
            if ($SINGLE_IMAGE["image"] == ""){
                $GRAFIKA = $SINGLE_IMAGE['kind'] . ".png";
            }else{
                $GRAFIKA =  $SINGLE_IMAGE["image"];
            }
            echo '
                <div>
                    <img u="image" src="grafika/'.$GRAFIKA.'" />
                    <div u="caption" t="MCLIP|B" style="position: absolute; top: 250px; left: 0px;
                        width: 600px; height: 50px;">
                        <div style="position: absolute; top: 0px; left: 0px; width: 600px; height: 50px;
                            background-color: Black; opacity: 0.5; filter: alpha(opacity=50);">
                        </div>
                        <div style="position: absolute; top: 0px; left: 0px; width: 600px; height: 50px;
                            color: White; font-size: 16px; font-weight: bold; line-height: 50px; text-align: center;">
                            
                            <span><h3 style="margin:0px; padding:0px;">'.$SINGLE_IMAGE["title"].'</h3>';
                            for($i=0; $i<=60; $i++){
                                echo $SINGLE_IMAGE["content"][$i];
                            }
                            echo '
                        </div>
                    </div>
                </div>
            ';
            /*
            echo "
                <a href='{$SINGLE_IMAGE['kind']}.index.php?ekran=post&id={$SINGLE_IMAGE['id']}' target='_blank'>
                    <img u='image' id='img_{$SINGLE_IMAGE['id']}' src='grafika/";
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
                */
        }

        // zmiana apostrofu dla tehgo że w kodzie występuje dużo znaków $
        echo '</div></div>
        <script type="text/javascript">
             jQuery(document).ready(function ($) {
            var _CaptionTransitions = [];
            _CaptionTransitions["L"] = { $Duration: 800, x: 0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["R"] = { $Duration: 800, x: -0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["T"] = { $Duration: 800, y: 0.6, $Easing: { $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["B"] = { $Duration: 800, y: -0.6, $Easing: { $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["TL"] = { $Duration: 800, x: 0.6, y: 0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["TR"] = { $Duration: 800, x: -0.6, y: 0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["BL"] = { $Duration: 800, x: 0.6, y: -0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["BR"] = { $Duration: 800, x: -0.6, y: -0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };

            _CaptionTransitions["WAVE|L"] = { $Duration: 1500, x: 0.6, y: 0.3, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseInWave }, $Opacity: 2, $Round: { $Top: 2.5} };
            _CaptionTransitions["MCLIP|B"] = { $Duration: 600, $Clip: 8, $Move: true, $Easing: $JssorEasing$.$EaseOutExpo };

            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                $CaptionSliderOptions: {                            //[Optional] Options which specifies how to animate caption
                    $Class: $JssorCaptionSlider$,                   //[Required] Class to create instance to animate caption
                    $CaptionTransitions: _CaptionTransitions,       //[Required] An array of caption transitions to play caption, see caption transition section at jssor slideshow transition builder
                    $PlayInMode: 1,                                 //[Optional] 0 None (no play), 1 Chain (goes after main slide), 3 Chain Flatten (goes after main slide and flatten all caption animations), default value is 1
                    $PlayOutMode: 3                                 //[Optional] 0 None (no play), 1 Chain (goes before main slide), 3 Chain Flatten (goes before main slide and flatten all caption animations), default value is 1
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);
            });
</script>';
        
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