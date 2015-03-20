<div id='panel_rejestracji' style='color: black; text-align: center;'>
	<form action="" method="POST">
		<table border='0 ' style='text-align: left;  margin: auto;'>		
			<tr>
				<td colspan="2" style='text-align: right'>Login</td>
				<td><input type='text' placeholder="Twój login" id='username' class='input' /></td>
			</tr>
			<tr>
				<td colspan="2" style='text-align: right'>Adres e-mail</td>
				<td><input type='email' placeholder="Twój adres e-mail" id='email' class='input' /></td>
			</tr>	
			<tr>
				<td colspan="2" style='text-align: right'>Hasło</td>
				<td><input type='password' placeholder="Twoje hasło" id='password' class='input' /></td>
			</tr>
			<tr>
				<td colspan="2" style='text-align: right'>Powtórz hasło</td>
				<td><input type='password' placeholder="Powtórzenie hasła" id='repassword' class='input' /></td>
			</tr>
		</table>
		
		<br />

		<input type="checkbox" id="terms" value="read">Zapoznalem się z <a href='terms.html' target="_blank" >regulaminem</a> i akceptuje go.<br /><br />

		<input type='submit' value='Rejestracja'>
	</form>
</div>

<?php
/*
	$database = new db();
	
	if (!empty($_POST['username']) || !empty($_POST['password']) || !empty($_POST['repassword']) || !empty($_POST['email'])) {
	
		$_POST['username'] = clear($_POST['username']);
        $_POST['password'] = clear($_POST['password']);
        $_POST['repassword'] = clear($_POST['repassword']);
        $_POST['email'] = clear($_POST['email']);
										
		if ( ($_POST['race'] = "human") || ($_POST['race'] = "beast") || ($_POST['race'] = "faithful") || ($_POST['race'] = "forest") ){
			if ($_POST['username'] != ""){
				if ($_POST['terms'] == "true"){
					if (strlen($_POST['username']) >= 5 ) {			
						if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) !== false){
							if($database -> count_data('users', '`id`', "`username` = '{$_POST['username']}'") <= 0) {			
								if($database -> count_data('users', '`id`', "`email` = '{$_POST['email']}'") <= 0) {
									if (strlen($_POST['password']) >= 6 ){
										if ($_POST['password'] == $_POST['repassword'] ){
											
											if(USER_RULES::add_user($_POST['username'],codepass($_POST['password']),$_POST['email'],$_POST['race']));
												header("Location: index.php");

										}else{ echo "<p class='error'> Podane hasła różnią się! </p>"; };
									}else{ echo "<p class='error'> Hasło musi mieć conajmniej 6 znaków! </p>"; };
								}else {echo "<p class='error'> E-mail zajęty, spróbuj przypomnieć hasło! </p>"; };
							}else {echo "<p class='error'> Nick zajęty! </p>"; };
						}else{ echo "<p class='error'> Nieprawidłowy e-mail! </p>"; };	
					}else{ echo "<p class='error'> Nick musi mieć conajmniej 5 znaków! </p>"; };
				}else{ echo "<p class='error'> Musisz zaakceptować warunki regulaminu! </p>"; };
			}else{ echo "<p class='error'>Wpisz nick! </p>"; };
		}else{ echo "<p class='error'>Wybierz rasę! </p>"; };
	}
*/

	$_POST['username'] = clear($_POST['username']);
	$_POST['password'] = clear($_POST['password']);
	$_POST['repassword'] = clear($_POST['repassword']);
	$_POST['email'] = clear($_POST['email']);

	$username = $_POST['username'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$email = $_POST['email'];

	if(!empty($username) ||
		!empty($password) ||
		!empty($repassword) ||
		!empty($email))
	{
		$register = new Register($username, $password, $repassword, $email);
	}
?>