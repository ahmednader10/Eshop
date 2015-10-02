<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>eShop</title>
</head>

<body>
<div>
	<?php
	session_start();
	require_once("manage.php");
	$m = new manage();
	$values = $m -> viewHistory($_SESSION['email']);
		

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
	</li><br>
    <?php 
	}
	?>
	</ul>
   </div>
   <br>
   <a href="show_products.php">Back to all products</a>
   <?php 
   if(count($values) == 0){
	   echo "You still haven't purchased any item ";
	   ?>
	   <a href="show_products.php">Buy now</a>
	   <?php
   }
   ?>
   
</body>
</html>