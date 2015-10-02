<!DOCTYPE html>
<html>
<link rel="stylesheet" href="foundation.css">
<head>

  <meta charset="UTF-8">

  <title>eShop</title>

</head>
<body>
</body>
</html>
<?php
require_once('DBConnection.php');

class Register extends DBConnection{
	
	public function regist(){
		$form = <<<EOT
		<h1> Enter your information below to register </h1>
		<p>
			<form action="Register.php" method="POST">
			First Name: <input type="text" name="first_name" required/> <br>
			Last Name: <input type="text" name="last_name" required/><br>
			E-mail: <input type="text" name="email" required/><br>
			Password: <input type="password" name="password" required/><br>
			Confirm Password: <input type="password" name="password_confirmation" required/><br>
			<input type="submit" value="Register" name="submit"/>
			</form>
		</p>
EOT;

		if(isset($_POST['submit'])) {

			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$password_confirmation = $_POST['password_confirmation'];

			if(filter_var($email, FILTER_VALIDATE_EMAIL) && $password == $password_confirmation) {
				$email = strtolower($email);
				
				if ($this->DBselection()){
					$Query = "insert into users (first_name, last_name, password, email) values ('" . $first_name ."', '" . $last_name ."', '" . $password ."', '" . $email . "')";
					if(mysql_query($Query)) {
						echo "<h1>You have been registered successfully!</h1>";
						header('location: home.php');
					} else {
						echo "<h1>Unable to register, please report this bug to any of our contact information.";
					}
				} else {
					echo "<h1>Cannot connect to the Database!!</h1>";
				}
			} else {
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					echo "<h1>Invalid E-mail, please enter a valid one.</h1><br>" . $form;
				} elseif($password != $password_confirmation) {
					echo "<h1>Passwords did not match, please try again.</h1><br>" . $form;
				}
			}

		} else {
			echo $form;
		}	
	}
}
	$Register = new Register();
	$Register->regist();
?>