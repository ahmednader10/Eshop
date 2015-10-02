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
		<h1 style="text-align:center; background-color:#e6e6e6; color:white;" > Enter your information below to register </h1>
		<p>
		<div class="row">
			<form action="Register.php" method="POST" enctype="multipart/form-data">
			First Name:<div style="width=20vw;"> <input type="text" name="first_name" required/> <br></div>
			Last Name: <input type="text" name="last_name" required/><br>
			E-mail: <input type="text" name="email" required/><br>
			Password: <input type="password" name="password" required/><br>
			Confirm Password: <input type="password" name="password_confirmation" required/><br>
			Upload Profile Picture:<input type="file" name="fileToUpload" id="fileToUpload">

			<input type="submit" value="Register" name="submit"/>
			</form>
		</div>
		</p>
EOT;

		if(isset($_POST['submit'])) {
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$password_confirmation = $_POST['password_confirmation'];

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

			if(filter_var($email, FILTER_VALIDATE_EMAIL) && $password == $password_confirmation && strlen($password) >= 8) {
				$email = strtolower($email);
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

				if ($this->DBselection()){
					$Query = "INSERT INTO users (first_name, last_name, password, email , avatar) VALUES ('" . $first_name ."', '" . $last_name .
						"', '" . $password ."', '" . $email . "','".$target_file."')";
					if(mysql_query($Query)) {
						 if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
					    } else {
					        echo "Sorry, there was an error uploading your file.";
					    }
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
	}
}
	$Register = new Register();
	$Register->regist();
?>