<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<div>
<?php 
  require_once("manage.php");
  session_start();
?>
   <form action="" method="post">
      <select type="number" name="quantity">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
      </select>
      <input type="submit" value="buy" />
    </form>
    <?php
       require_once("manage.php");
      $buying = new Buy();
      if($_REQUEST){
        $buying-> buys(1,$_SESSION["id"],$_REQUEST["quantity"]);
      }
    ?>
          
</div>
</body>
</html>