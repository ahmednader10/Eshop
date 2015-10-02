<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="foundation.css">

	<title></title>
</head>
<body>
<div>
	<?php
	session_start();
	require_once("manage.php");
	$m = new manage();
	$values = $m -> getCart($_SESSION['email']);


	?>
	<ul>
	<?php
	  for($i = 0;$i < count($values);$i++)
  {
	?>
	<li>
		<?php echo  $values[$i]['name'];?>
	</li>
    <li>
		<?php echo  $values[$i]['summary'];?>
	</li>
	<li>
		<?php echo $values[$i]['price'];?>
	</li>
    <li><a href="cart.php?action=remove&pid=<?php echo $values[$i]["id"]; ?>">Remove From Cart</a></li><br>
	
	<?php 
	}
	?>
	</ul>
    <?php
	if(count($values) >0){
	?>
    <a href="cart.php?action=buy">Checkout</a><br>
    <a href="show_products.php">Add another item to cart</a>
	<?php } ?>
</div>
<?php 
   if(count($values) == 0){
	   echo "Your Cart is still empty ";
	   ?>
	   <a href="show_products.php">Add items to your cart now</a>
	   <?php
   }
   ?>

<?php
if(isset($_GET['action']) && $_GET['action']=="remove"){
	$m ->RemoveFromCart($_GET['pid']);
}
if(isset($_GET['action']) && $_GET['action']=="buy"){
	$m ->PurchaseCart($_SESSION['email']);
}
?>
</body>
</html>