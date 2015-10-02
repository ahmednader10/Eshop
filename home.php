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
  <h1>Log in</h1>
  <form action="" method="post">
    <input type="email" placeholder="Email" name ="email" id="email"/>
    <input type="password" placeholder="Password" name="password" id="password" />
    <input type="submit" value="Log in" />
  </form>
  <a href="Register.php">Sign Up</a>
</div>

  
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
  
  ?>
  
  <div class="row">
<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-3">
  <?php
  
  for($i = 0;$i < count($productsList);$i++)
  {
  ?>
  <li style="">
      <img src="/opt/lampp/htdocs/eshop/Eshop/troll.png"> 
      <p style="font-size:20px;"> <?php echo $productsList[$i]['name'];?></p>
      <p> <?php echo $productsList[$i]['summary'];?>
      stock:  <?php echo $productsList[$i]['stock'];?>  price:  <?php echo $productsList[$i]['price'];?></p>
      <a href="buy.php?<?php echo "pid=" . $productsList[$i]['id'];?>"> Buy</a>
  </li>
   <?php
  }
  ?>
</ul>

</div>

  

</body>

</html>