<!DOCTYPE html>
<html>
<link rel="stylesheet" href="foundation.css">
<script type="text/javascript">
  function dropdown(){
    if(document.getElementById('dropmenu').style.display== 'none'){
      document.getElementById('dropmenu').style.display= 'block';
    } else {
      document.getElementById('dropmenu').style.display= 'none';
    }
  }
</script>
 <style type="text/css">

    #list li{
      display: inline;
      margin: 20px;
      color: white;
    }

    #drop:hover > #dropmenu{
      display: block;
    }

    #dropmenu{

      border: 1px solid gray;
      background-color: white;
      border-color: gray;
      border-radius: 0 0 5px 5px;
      margin-top: 8px;
      margin-right: 3px;
     text-align: center;
     display: none;
     box-shadow: 1px 1px gray;
    }

    #title{
            color: white;
   font-size:20px; text-align:center; font-size:20px;background-color:#333333; 
   box-shadow: 0px 2px black;
    }

    .product{
      list-style: none;
      padding: 0;
      margin: 0;
          }

    .flashy{
      text-align: center;
      font-size: 30px;
      background-color: #e6e6e6;
    }

    #edit{
    	position: absolute;
    	left: 40vw;
    	border:1px solid #e6e6e6;
    	box-shadow: 2px 2px #333333;
    	width: 20vw;
    	height: 80vh;
    	line-height: 1em;
    	border-radius: 6px 6px 6px 6px;
    	padding: 2vh;
    	margin-top: 3vh;
    }
    #info{
    	position: absolute;
    	left: 10vw;
    	border:1px solid #e6e6e6;
    	box-shadow: 2px 2px #333333;
    	width: 20vw;
    	line-height: 1em;
    	border-radius: 6px 6px 6px 6px;
    	padding: 2vh;
    	margin-top: 3vh;
    }
  </style>

<head>

  <meta charset="UTF-8">

  <title>eShop</title>

</head>
<body>
<?php
session_start();

if(isset($_SESSION['email'])){
	require_once("manage.php");
	$m = new manage();
	$values = $m -> getCart($_SESSION['email']);
  }else{
    header("location:home.php");
  }
  ?>
  

      <nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="show_products.php">eShop</a></h1>
    </li>
  </ul>

    <!-- Right Nav Section -->
    <ul id="list" style="position:absolute; left:90vw; display:inline; top:10px;">
        
      <li > <img style=" width:2vw; height:3.5vh;" src="<?php $img = mysql_fetch_assoc(mysql_query("Select avatar from users where email = '". $_SESSION["email"]."'"));
            echo implode(" ", $img) ; ?>" >
  </li>
      <li id="drop" onclick="dropdown();" >
         <?php    $uname = mysql_fetch_assoc(mysql_query("Select first_name from users where email = '". $_SESSION["email"]."'"));
            echo $uname['first_name'] ;
          ?>
           <ul id="dropmenu">
              <li>
              <a href="cart.php?action=cart" > 
                
                View Cart <span class ="label"><?php 
                require_once("manage.php");
                $m = new manage();
                $values = $m -> getCart($_SESSION['email']);
                echo count($values);
                ?> </span></a>  
              </li>
              <li><a href="history.php?action=history">History</a></li><br>
              <li><a href="edit_profile.php">Edit Profile</a></li><br>
             <li ><a href="show_products.php"> All Products </a>
              </li><br>
              <li>
                <a name="logout" href="logout.php"> Log out </a>
              </li>
 
      </ul>
     
      </li>
         
    </ul>

    <!-- Left Nav Section -->
    <ul class="left">
      <li style="color:white;"><p style="position:absolute; top:10px;">
    </li>
    </ul>
</nav>

<?php
require_once('DBConnection.php');

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
				if(!$empty ) {
					$Query .= ', ';
				}
				$Query .= 'avatar = "' . $this->newAvatar . '"';
				$empty = false;
			}
			$Query .= ' WHERE email="' . $_SESSION['email'] . '";';
			if(mysql_query($Query)) {
				echo '<h1>Your information has been changed successfully</h1><br>';
				if(isset($this->newEmail)){
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
	'<div id="info">
		<img src="'.$user['avatar'].'"/>
		<h2> Your Current information </h2>
		First Name: ' . $user['first_name'] . '<br>
		Last Name: ' . $user['last_name'] . '<br>
		Email: ' . $user['email'] . '<br>
		</div>';

$notice = '<div id="edit" ><h3  style="text-align:center;">Input only the information you need to change</h3>';

$form = <<<EOT
	
		<form action='edit_profile.php' method='POST' enctype='multipart/form-data'>
			New First Name:<input style="border-radius:5px 5px 5px 5px; " type='text' name='new_first_name'/><br>
			New Last Name:<input type='text' name='new_last_name' style="border-radius:5px 5px 5px 5px; "/><br>
			New E-mail:<input type='text' name='new_email' style="border-radius:5px 5px 5px 5px; "/><br>
			New Password:<input type='password' name='new_password' style="border-radius:5px 5px 5px 5px; "/><br>
			New Password Confirmation:<input type='password' name='new_password_confirmation' style="border-radius:5px 5px 5px 5px; "/><br><br>
			Enter your Password to apply changes :<input type='password' name='old_password' style="border-radius:5px 5px 5px 5px; "/><br>
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type='submit' value='Apply changes' name='submit' style="border-radius:5px 5px 5px 5px; position:absolute; left:5vw; top:73vh; " class="small button"/><br>
		</form>
	</div>
EOT;

echo $information;
echo $notice;
echo $form;

?>
</body>
</html>
