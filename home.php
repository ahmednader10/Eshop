<?php
ob_start();
?>
<!DOCTYPE html>
<html>

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
</div>

  
  <?php
  require_once("LoginValidity.php");
  require_once("products.php");
	$products=new products();
	$productsList = $products->selectAll();
	?>
	<table border="1">
	  <tr>
		<td>Name</td>
		<td>summary</td>
		<td>Price</td>
		<td>Availability in Stock</td>
	  </tr>
	  <?php
	  
	  for($i = 0;$i < count($productsList);$i++)
	  {
	  ?>
	  <tr>
		  <td><?php echo $productsList[$i]['name'];?></td>
		  <td><?php echo $productsList[$i]['summary'];?></td>
		  <td><?php echo $productsList[$i]['price'];?></td>
		  <td><?php echo $productsList[$i]['stock'];?></td>
	  </tr>
	  <?php
	  }
	  ?>
	</table>
    <?php
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