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

?>