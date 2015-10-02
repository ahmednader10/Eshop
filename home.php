<?php
ob_start();
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="foundation.css">
<head>

  <meta charset="UTF-8">

  <title>eShop</title>

</head>

<body>

<div>
 <?php 
 		session_start();
        if(!isset($_SESSION["email"])){
  ?>  
  <h1>Log in</h1>
  <form action="" method="post">
    <input type="email" placeholder="Email" name ="email" id="email"/>
    <input type="password" placeholder="Password" name="password" id="password" />
    <input type="submit" value="Log in" />
  </form>
  <p>New user ? <a href="Register.php">sign up</a> now</p>
</div>
<?php
		}
		?>
  
  <?php
  require_once("LoginValidity.php");
  require_once("products.php");

  $products=new products();
  $productsList = $products->selectAll();

  $user = new LoginValidity();
  if($_POST)
	 {
	  $Email = $_POST["email"];
	  $password = $_POST["password"];
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
  if(isset($_SESSION["email"])){
  ?>
  <div>
  	<a href="cart.php?action=cart"> My Cart</a><br>
	<a href="history.php?action=histroy">History</a>
  </div>
  <?php } ?>
  <div class="row">
<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-3">
  <?php
  
  for($i = 0;$i < count($productsList);$i++)
  {
  ?>
  <li style="">
      <img src="troll.png"> 
      <p style="font-size:20px;"> <?php echo $productsList[$i]['name'];?></p>
      <p> <?php echo $productsList[$i]['summary'];?><br>
      price:  <?php echo $productsList[$i]['price'];?></p>
      <?php if($productsList[$i]['stock'] > 0){ ?>
      <?php if(isset($_SESSION["email"])){ ?>
      <a href="buy.php?<?php echo "pid=" . $productsList[$i]['id'];?>"> Buy</a>
      <?php }else { ?>
      <a href="home.php?action=login"> Buy</a>
      
      <?php } ?>
       <?php }else {?>
      <p> Out of Stock </p>
      <?php } ?>
  </li>
   <?php
  }
  ?>
</ul>

</div>

<?php

 if(isset($_GET['action']) && $_GET['action']=="login"){
	echo '<script language="javascript">';
			echo 'alert("You Should login first")';
			echo '</script>';
 }
 ?>
</body>

</html>