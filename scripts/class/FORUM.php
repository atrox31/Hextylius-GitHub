<?php
class FORUM{

	public static function show_threads( $CATEOGRY_ID, $START_FROM = 0, $LIMIT_THREAD = 8){
		$database = new db("fassh114_1");
		$THREADS = $database -> get_data("forum_threads", "*", false, "`category` = '{$CATEOGRY_ID}' ORDER BY last_answer DESC");
			
			$POSTION = 0;
            while($THREAD = mysql_fetch_array($THREADS)){

            	if($POSTION >= $START_FROM && $POSTION < ($START_FROM + $LIMIT_THREAD) ){
            		$AUTHOR = $database -> get_data("users", "*", true, "`id` = '{$THREAD['author']}'");
                	$TO_DISPLAY .= "  <div class=' post" . ($POSTION % 2) . "'>
                                            <table style='width: 100%'>
                                                <tr>
                                                    <td>
                                                        {$AUTHOR['nick']}
                                                    </td>
                                                    <td style='text-align:right;' >
                                                        <h3 onClick='document.location = \"{$GLOBALS['SUBDOMEN']}.index.php?ekran=forum&cat={$CATEOGRY_ID}&post={$THREAD['id']}&page=1\";' >{$THREAD['name']}</h3>
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
               
                $POSTION++;           
            }

            
        if($TO_DISPLAY != ""){
            echo $TO_DISPLAY;
        }else{
            echo "Brak wątków!";
        }
    }

    public static function create_new_thread(){
    	if($_POST['post'] == "add"){
    		FORUM::draw_respond(true);
    	}else{
    		if($_POST['post'] != "" && $_POST['text'] != ""){
	    		$THREAD_NAME = clear( $_POST['post'] );
				$FIRST_CONTENT = clear( $_POST['text'] );
				$CATEGORY = clear( $_GET['cat'] );

	    		$database = new db("fassh114_1");

	    		$CATEGORY_EXISTS = $database -> get_data( "forum_category", "*", true, "`id` = '{$CATEGORY}'", true);
	    		if($CATEGORY_EXISTS){

	    			$database -> insert_data("forum_threads", 
	    				"`author`, `last_answer`, `open`, `name`, `category`",
	    				"'{$_SESSION['user_id']}',	    				
	    				 '" . time() . "',
	    				 'true',
	    				 '{$THREAD_NAME}',
	    				 '{$CATEGORY}'
	    				");
	    			
	    			$THREAD_ID = $database -> get_last_id();

	    			$database -> insert_data("posts", "thread, author, time_add, content", "'{$THREAD_ID}', '{$_SESSION['user_id']}', '" . time() . "', '{$FIRST_CONTENT}'");

	    			page_refresh();
	    		}else{
	    			echo "<span class='error'>Idź Pan w chuj z takim kombinowaniem...</span>";
	    		}
    		}else{
    			echo "<span class='error'>Uzupełnij treść.</span>";
    		}
    	}
    }

    public static function show_post( $POST_ID, $LIMIT = 10){
    	$database = new db("fassh114_1");

    	$POST_NO = 0;
		$POSTS = $database -> get_data("posts", "*", false, "`thread` = '{$POST_ID}' ORDER BY time_add ASC");
		$TO_DISPLAY = "";
//
		//if(mysql_fetch_assoc($POSTS)){
				while($DATA_POST = mysql_fetch_assoc($POSTS)){
					$AUTHOR = $database -> get_data("users", "*", true, "`id` = '{$DATA_POST['author']}'");
					$RANK = $database -> get_data("rank", "*", true, "`id` = '{$AUTHOR['rank']}'");

					if($POST_NO >= (($_GET['page']-1)*$LIMIT) && $POST_NO < ($_GET['page']*$LIMIT) ){

						$TO_DISPLAY .= "<div class='post post" . ($POST_NO % 2) . "' >
											<table style='width: 100%'>
												<tr>";

							$TO_DISPLAY .= "<td style='text-align: center; width: 200px;'>
												<h3>{$AUTHOR['nick']}</h3>
												<img src='grafika/avatar/{$AUTHOR['avatar']}.png' /><br />
												<span style='color: #{$RAND['color']}'>{$RANK['name']}</span><br />
												<input type='button' value='Napisz' />
											</td>";

							$TO_DISPLAY .= "<td><p style='text-align: left;'>" . $DATA_POST['content'] . "</p>
												";
							$TO_DISPLAY .= "
											</td>
										</tr>
										<tr>
											<td colspan='2' style='text-align: right;'>" . date("Y-m-d H:i", $DATA_POST['time_add']) . "<br />
											<input type='button' value='Odpowiedz' />
												<input type='button' value='Zgłoś' />
												<input type='button' value='Cytuj' /></td>";

						$TO_DISPLAY .= "		</tr>
											</table>
										</div>";
					}
					$POST_NO++;
				}

		if($TO_DISPLAY != ""){
            echo $TO_DISPLAY;
        }else{
            echo "Wątek nie odnaleziony!";
        }


			// odpowiedź
			if($_GET['page'] == 1+floor(--$POST_NO / $LIMIT)){
				FORUM::draw_respond();
			}

			echo "<div style='text-align:center; margin: auto'>";
				for($i=1; $i<= 1+floor($POST_NO / $LIMIT); $i++){
					echo "[";
					if($i != $_GET['page']){
						echo "<a href='{$GLOBALS['SUBDOMEN']}.index.php?ekran=forum&cat={$_GET['cat']}&post={$POST_ID}&page={$i}' >{$i}</a>";
					}else{
						echo $i;
					}
					echo "] ";
				}
			echo "</div>";
		//}else{
		//	echo "Nie odnaleziono wątku!";
		//}

		
    }

    public static function draw_respond( $DRAW_HEDER = false ){
    	echo "<div>
					<form action='" . this_url() . "' method='post' >";

    	if( $DRAW_HEDER ){
    		echo "Temat wątku<br /><input type='text' name='post' /><br />";
    	}

    	echo "Treśc postu<br />
						<textarea rows='6' cols='50' name='text'></textarea><br />
						<input type='submit' value='Wyslij'/> 
					</form>
				</div>";
    }

}
?>