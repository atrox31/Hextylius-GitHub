<?php

if(isset($_POST['email'])){
	$_POST['email'] = clear($_POST['email']);

	$database = new db('fassh114_1');
	if($EMAIL = $database -> get_data("users", "*", true, "`email` = '{$_POST['email']}'")){
		
		header("location: '" . this_url() . "&email=send'");

	}else{
		echo "<p class='error'>Nie znaleziono adresu email w bazie!</p>";
	}
}
if($_GET['email'] == 'send'){
	echo "Email został wysłany, sprawdź maila - ewentualnie przeszukaj folder spam :(";
}else{
	echo "Podaj email a dostaniesz dalsze instrukcje zmiany hasła<br />
	<input type='email' id='email'/>
	<input type='button' value='wyślij' onClick=\"post('" . this_url() . "', {email: \$('#email').val() })\"  ";
}
