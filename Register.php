<?php
require('DBConnection.php');

if(isset($_POST['submit'])) {

} else {
	$form = <<<EOT
		<form action="Register.php" method="POST">
		First Name: <input type="text" name="first name"/><br>
		Last Name: <input type="text" name="last name"/><br>
		E-mail: <input type="text" name="email"/><br>
		Password: <input type="password" name="password"/><br>
		Confirm Password: <input type="password" name="password confirmation"/><br>
		<input type="submit" value="Register" name="submit"/>
		</form>
EOT;
	echo $form;
}

?>