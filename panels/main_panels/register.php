<div id='panel_rejestracji' style='color: black; text-align: center;'>

	<?php
		// Usuwanie z danych wprowadzonych przez użytkownika niepotrzebnych znaków
		if( isset($_POST['username']) ||
			isset($_POST['password']) ||
			isset($_POST['repassword']) ||
			isset($_POST['email']))
		{
			$username = clear($_POST['username']);
			$password = clear($_POST['password']);
			$repassword = clear($_POST['repassword']);
			$email = clear($_POST['email']);
			
			$register = new Register($username, $password, $repassword, $email);

		}
	?>

	<form action=<?php echo "'" . $GLOBALS['SUBDOMEN'] . "." . "index.php?ekran=" . $_GET['ekran'] . "'"; ?> method="POST">
		<table border='0 ' style='text-align: left;  margin: auto;'>		
			<tr>
				<td colspan="2" style='text-align: right'>Login</td>
				<td><input type='text' placeholder="Twój login" name='username' class='input' /></td>
			</tr>
			<tr>
				<td colspan="2" style='text-align: right'>Adres e-mail</td>
				<td><input type='email' placeholder="Twój adres e-mail" name='email' class='input' /></td>
			</tr>	
			<tr>
				<td colspan="2" style='text-align: right'>Hasło</td>
				<td><input type='password' placeholder="Twoje hasło" name='password' class='input' /></td>
			</tr>
			<tr>
				<td colspan="2" style='text-align: right'>Powtórz hasło</td>
				<td><input type='password' placeholder="Powtórzenie hasła" name='repassword' class='input' /></td>
			</tr>
		</table>
		
		<br />
			<input type="checkbox" name="terms" value="read">Zapoznalem się z <a href='terms.html' target="_blank" >regulaminem</a> i akceptuje go.<br /><br />
			<input type='submit' value='Rejestracja'>
	</form>
</div>