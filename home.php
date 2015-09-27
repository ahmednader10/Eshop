<?php
ob_start();
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Login Form</title>

</head>

<body>

<div>
  <h1>Log in</h1>
  <form action="" method="post">
    <input type="email" placeholder="Email" name ="email" id="email"/>
    <input type="password" placeholder="Password" name="password" id="password" />
    <input type="submit" value="Log in" />
  </form>
</div>

  
  <?php
  require_once("LoginValidity.php");
  $user = new LoginValidity();
  if($_REQUEST)
	 {
	  $Email = $_REQUEST["email"];
	  $password = $_REQUEST["password"];
	  if ($user->checkValidity($Email,$password))
	  {
		  echo "Login successful";
		  header("location:show_products.php");
	  }
	  else
	  {
		  echo "please enter correct username and password";
	  }
  }
  
  ?>
  

</body>

</html>