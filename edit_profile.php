<?php
require_once('DBConnection.php');

class edit_profile extends DBConnection {
	private $newFirst;
	private $newLast;
	private $newEmail;
	private $newPassword;
	private $newPasswordConfirmation;
	private $newAvatar;

	public function __construct($newFirst, $newLast, $newEmail, $newPassword,
	 $newPasswordConfirmation, $newAvatar) {
	 	$this->newFirst = $newFirst;
	 	$this->newLast = $newLast;
	 	$this->newEmail = $newEmail;
	 	$this->newPassword = $newPassword;
	 	$this->newPasswordConfirmation = $newPasswordConfirmation;
	 	$this->newAvatar = $newAvatar;
	}

	public function checkEmailValidity() {
		if($newEmail == '') {
			return true;
		}
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

	public function edit() {
		if($this->DBselection()) {
			$Query = 'UPDATE users SET ';
			$empty = true;
			if($newFirst != '') {
				if(!$empty) {
					$Query .= ', ';
				}
				$Query .= 'first_name = ' . $newFirst;
				$empty = false;
			}
			if($newLast != '') {
				if(!$empty) {
					$Query .= ', ';
				}
				$Query .= 'last_name = ' . $newLast;
			} 
		} else {
			echo '<h1>Cannot connect to the Database</h1>';
		}
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
	$userQuery = 'SELECT * FROM users WHERE email = ' . $_SESSION['email'] . ';';
	$user = mysql_fetch_assoc(mysql_query($userQuery));
	$realOldPass = $user['password'];
	if($this->checkEmailValidity && $this->checkPasswordValidity && strlen($password) >= 8 && $oldPass == $realOldPass) {
		if($newFirst != '' || $newLast != '' || $newEmail != '' || $newPass != ''){
			$edit = new edit_profile($newFirst, $newLast, $newEmail, $newPass, $newPassConfirmation);
			$edit->edit();
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