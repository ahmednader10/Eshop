<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">

  <title>eShop</title>

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
    <li><a href="cart.php?action=remove&pid=<?php echo $values[$i]["id"]; ?>">Remove From Cart</a></li>
	
	<?php 
	}
	?>
	</ul>
    <a href="cart.php?action=buy">Checkout</a>

</div>

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