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
	// $u = "Select id from users where email = '".$_SESSION['email']."'";
	// 		$uid = mysql_query($u);
	// 		$id = mysql_fetch_row($uid);
	// 		$query = "Select * from products 
	// 		Join Bought where User_id 
	// 		"

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
		<?php echo $values[$i]['price'];?>
	</li>
	<li>
		<?php  echo $values[$i]['stock'];?>
	</li>
	<?php 
	}
	?>
	</ul>

</div>
</body>
</html>