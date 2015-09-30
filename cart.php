<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div>
	<?php
	session_start();
	require_once("manage.php");
	$u = new manage();
	$cart = $u->getCart($_SESSION["id"]);
	?>
	<table>
		<?php 

		if(count($cart) > 0){
		for($i = 0;$i < count($cart);$i++)
  	{

	?>
		<tr>
			<td>
				<?php echo $cart[$i]['name']; ?>
			</td>
						<td>
				<?php echo $cart[$i]['price']; ?>
			</td>
						<td>
				<?php echo $cart[$i]['stock']; ?>
			</td>
		</tr>

	<?php }
	} else{
	 	echo "Empty Cart";
	 }
	?>
	</table>

</div>
</body>
</html>