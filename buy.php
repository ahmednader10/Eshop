
<!DOCTYPE html>
<html>
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
        $values = $p->selectByID($_GET['pid']);
 
  for($i = 0;$i < count($values);$i++)
  {

  ?>

    <h1><?php       echo $values[$i]['name'];
     ?></h1>
     <h2><?php echo $values[$i]['summary']; ?></h2>
    <h1> price: <?php echo $values[$i]['price'];?></h1>
    <h1> stock: <?php echo $values[$i]['stock'];?></h1>
<?php
  }
  ?>
  </div>
   <form action="" method="post">
      <input type="submit" name="buy" value="buy" />
    </form>
    <?php
       require_once("manage.php");
     $buying = new manage();
     if(isset($_REQUEST['buy'])){
       $buying-> addtocart($_GET['pid'],$_SESSION["id"]);
     }
    ?>
          
</div>
</body>
</html>