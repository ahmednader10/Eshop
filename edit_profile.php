<?php
require_once('DBConnection.php');
session_start();

class edit_profile extends DBConnection {
	private $newFirst;
	private $newLast;
	private $newEmail;
	private $newPassword;
	private $newAvatar;

	public function __construct($newFirst, $newLast, $newEmail, $newPassword, $newAvatar) {
	 	$this->newFirst = $newFirst;
	 	$this->newLast = $newLast;
	 	$this->newEmail = $newEmail;
	 	$this->newPassword = $newPassword;
	 	$this->newAvatar = $newAvatar;
	}

	public function checkEmailValidity() {
		if($this->newEmail == '') {
			return true;
		}
		$this->DBselection();
		$query = mysql_query('SELECT * FROM users WHERE email ="' . $this->newEmail . '";');
		$number = mysql_num_rows($query);
		if($number != 0) {
			return false;
		}
		if(!filter_var($this->newEmail, FILTER_VALIDATE_EMAIL)) {
			return false;
		}
		return true;
	}

	public function checkPasswordValidity($confirmation) {
		if($this->newPassword == $confirmation && (strlen($this->newPassword) >= 8 || strlen($this->newPassword) == 0)) {
			return true;
		} else {
			return false;
		}
	}

	public function checkOldPassword($oldPass) {
		if($this->DBselection()) {
			$query = 'SELECT * FROM users WHERE email="' . $_SESSION['email'] . '";';
			$user = mysql_fetch_assoc(mysql_query($query));
			if($user['password'] == $oldPass) {
				return true;
			} else {
				return false;
			}
		} else {
			echo mysql_error();
			return false;
		}
	}

	public function edit() {
		if($this->DBselection()) {
			$Query = 'UPDATE users SET ';
			$empty = true;
			if($this->newFirst != '') {
				if(!$empty) {
					$Query .= ', ';
				}
				$Query .= 'first_name = "' . $this->newFirst . '"';
				$empty = false;
			}
			if($this->newLast != '') {
				if(!$empty) {
					$Query .= ', ';
				}
				$Query .= 'last_name = "' . $this->newLast . '"';
				$empty = false;
			}
			if($this->newEmail != '') {
				if(!$empty) {
					$Query .= ', ';
				}
				$Query .= 'email = "' . $this->newEmail . '"';
				$empty = false;
			}
			if($this->newPassword != '') {
				if(!$empty) {
					$Query .= ', ';
				}
				$Query .= 'password = "' . $this->newPassword . '"';
				$empty = false;
			}
			if($this->newAvatar != '') {
				if(!$empty) {
					$Query .= ', ';
				}
				$Query .= 'avatar = "' . $this->newAvatar . '"';
				$empty = false;
			}
			$Query .= ' WHERE email="' . $_SESSION['email'] . '";';
			if(mysql_query($Query)) {
				echo '<h1>Your information has been changed successfully</h1><br>';
				$_SESSION['email'] = $this->newEmail;
			} else {
				echo '<h1>Something went wrong!!</h1><br>';
				echo mysql_error();
			}
		} else {
			echo '<h1>Cannot connect to the Database</h1><br>';
		}
	}

}

$form = <<<EOT
	<p>
	<form action='edit_profile.php' method='POST'>
	New First Name:<input type='text' name='new_first_name'/><br>
	New Last Name:<input type='text' name='new_last_name'/><br>
	New E-mail:<input type='text' name='new_email'/><br>
	New Password:<input type='password' name='new_password'/><br>
	New Password Confirmation:<input type='password' name='new_password_confirmation'/><br><br>
	Enter your Password to apply changes :<input type='password' name='old_password'/><br>
	<input type='submit' value='Apply changes' name='submit'/><br>
	</form>
	</p>
EOT;

if(isset($_POST['submit'])) {
	$newFirst = $_POST['new_first_name'];
	$newLast = $_POST['new_last_name'];
	$newEmail = $_POST['new_email'];
	$oldPass = $_POST['old_password'];
	$newPass = $_POST['new_password'];
	$newPassConfirmation = $_POST['new_password_confirmation'];
	$edit = new edit_profile($newFirst, $newLast, $newEmail, $newPass, '');
	if($edit->checkEmailValidity() && $edit->checkPasswordValidity($newPassConfirmation) && $edit->checkOldPassword($oldPass)) {
		if($newFirst != '' || $newLast != '' || $newEmail != '' || $newPass != ''){
			$edit->edit();
		} else {
			echo '<h1>no changes to apply</h1>';
		}
	} else {
		if(!$edit->checkEmailValidity()) {
			echo '<h1>Email not valid</h1><br>';
		}
		if(!$edit->checkPasswordValidity($newPassConfirmation)) {
			echo '<h1>New password invalid</h1><br>';
		}
		if(!$edit->checkOldPassword($oldPass)) {
			echo '<h1>Incorrect Password</h1><br>';
		}
	}
}

echo $form;

?>