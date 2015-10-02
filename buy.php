
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="foundation.css">

<head>
  <title></title>
</head>
<body>
<div>
<?php 
  require_once("manage.php");
  require_once("products.php");
  session_start();
?>
  <div>
  <?php
   $p = new products();
   $pid = $_GET['pid'];
        $values = $p->selectByID($_GET['pid']);
        ?>

  </div>
   <?php
  for($i = 0;$i < count($values);$i++)
  {

  ?>

    <h1><?php     
      echo $values[$i]['name'];
     ?></h1>
     <h2><?php echo $values[$i]['summary']; ?></h2>
    <h1> price: <?php echo $values[$i]['price'];?></h1>
    <h1> stock: <?php echo $values[$i]['stock'];?></h1>
    <a href="buy.php?action=add&pid=<?php echo $pid ?>"> Add to Cart</a>
    
<?php

  }

  require_once("manage.php");
  $m = new manage();
 if(isset($_GET['action']) && $_GET['action']=="add"){
    $m ->addtocart($_SESSION["email"],$pid);

   }


  ?>
          
</div>
</body>
</html>