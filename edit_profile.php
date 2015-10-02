<title>eShop</title>
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
				if(isset($newEmail)){
					$_SESSION['email'] = $this->newEmail;
				}
			} else {
				echo '<h1>Something went wrong!!</h1><br>';
				echo mysql_error();
			}
		} else {
			echo '<h1>Cannot connect to the Database</h1><br>';
		}
	}

}

if(isset($_POST['submit'])) {
	$newFirst = $_POST['new_first_name'];
	$newLast = $_POST['new_last_name'];
	$newEmail = $_POST['new_email'];
	$oldPass = $_POST['old_password'];
	$newPass = $_POST['new_password'];
	$newPassConfirmation = $_POST['new_password_confirmation'];
	
	//upload info
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	 $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	}
	if($uploadOk == 1) {
		$newAvatar = $target_file;
	} else {
		$newAvatar = '';
	}

	$edit = new edit_profile($newFirst, $newLast, $newEmail, $newPass, $newAvatar);
	if($edit->checkEmailValidity() && $edit->checkPasswordValidity($newPassConfirmation) && $edit->checkOldPassword($oldPass)) {
		if($newFirst != '' || $newLast != '' || $newEmail != '' || $newPass != '' || $newAvatar != ''){
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

$DB = new edit_profile('', '', '', '', '');
$DB->DBselection();
$query = 'SELECT * FROM users WHERE email="' . $_SESSION['email'] . '";';
$user = mysql_fetch_assoc(mysql_query($query));

if($user['avatar'] != null) {
	$avatar = '<img style=" width:2vw; height:3.5vh;" src="' . $user['avatar'] . '" >';
} else {
	$avatar = 'No avatar assigned';
}

$information = 
	"<p>
	First Name: " . $user['first_name'] . "<br>
	Last Name: " . $user['last_name'] . "<br>
	Email: " . $user['email'] . "<br>
	Avatar: " . $avatar . "<br>
	</p>";

$notice = '<h3>Input only the information you need to change</h3>';

$form = <<<EOT
	<p>
	<div class="row">
		<form action='edit_profile.php' method='POST' enctype='multipart/form-data'>
		New First Name:<input type='text' name='new_first_name'/><br>
		New Last Name:<input type='text' name='new_last_name'/><br>
		New E-mail:<input type='text' name='new_email'/><br>
		New Password:<input type='password' name='new_password'/><br>
		New Password Confirmation:<input type='password' name='new_password_confirmation'/><br><br>
		Enter your Password to apply changes :<input type='password' name='old_password'/><br>
		Upload New Avatar:<input type="file" name="fileToUpload" id="fileToUpload"/><br>
		<input type='submit' value='Apply changes' name='submit'/><br>
		</form>
	</div>
	</p>
EOT;

echo $information;
echo $notice;
echo $form;

?>