<?php
require_once('DBConnection.php');

class edit_profile extends DBConnection {
	private $newFirst;
	private $newLast;
	private $newEmail;
	private $newPassword;
	private $newPasswordConfirmation;
	private $newAvatar;

	public function checkEmailValidity() {
		$query = mysql_query('Select * from users where email = ' . $newEmail . ';');
		$number = mysql_num_rows($query);
		if($number != 0) {
			return false;
		}
		if(!filter_var($NewEmail, FILTER_VALIDATE_EMAIL)) {
			return false;
		}
		return true;
	}

	public function checkPasswordValidity() {
		if($newPassword == $newPasswordConfirmation) {
			return true;
		} else {
			return false;
		}
	}

	public function __construct($newFirst, $newLast, $newEmail, $newPassword,
	 $newPasswordConfirmation, $newAvatar) {
	 	$this->newFirst = $newFirst;
	 	$this->newLast = $newLast;
	 	$this->newEmail = $newEmail;
	 	$this->newPassword = $newPassword;
	 	$this->newPasswordConfirmation = $newPasswordConfirmation;
	 	$this->newAvatar = $newAvatar;
	}

}

$form = <<<EOT
	<p>
	<form action='edit_profile.php' method='POST'>
	New First Name:<input type='text' name='new_first_name'/>
	New Last Name:<input type='text' name='new_last_name'/>
	New E-mail:<input type='text' name='new_email'/>
	Old Password:<input type='password' name='old_password'/>
	New Password:<input type='password' name='new_password'/>
	New Password Confirmation:<input type='password' name='new_password_confirmation'/>
	</form>
	</p>
EOT;

if(isset($_POST['submit'])) {
	$newFirst = $_POST['new_first_name'];
	$newLast = $_POST['new_last_name'];
	$newEmail = $_POST['email'];
	$oldPass = $_POST['old_password'];
	$newPass = $_POST['new_password'];
	$newPassConfirmation = $_POST['new_password_confirmation'];
	if(filter_var($email, FILTER_VALIDATE_EMAIL) && $password == $password_confirmation && strlen($password) >= 8) {
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
			echo "<h1>Invalid E-mail, please enter a valid one.</h1><br>";
		} elseif($password != $password_confirmation) {
			echo "<h1>Passwords did not match, please try again.</h1><br>";
		} elseif(strlen($password) < 8) {
			echo "<h1>The Password must be at least 8 characters";
		}
	}
}

echo $form;

?>