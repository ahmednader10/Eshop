<!DOCTYPE html>
<html>
<body>

<?php
session_start();
require_once("products.php");
$products=new products();
$productsList = $products->selectAll();
?>

<nav>
  <ul>
    <li>

      <h1> <?php 
      $uname = mysql_fetch_assoc(mysql_query("Select first_name from users where email = '". $_SESSION["email"]."'"));
      echo implode(" ", $uname) ;?></h1>
    </li>
  </ul>
</nav>
<table border="1">
  <?php
  
  for($i = 0;$i < count($productsList);$i++)
  {
  ?>
  <tr>
      <td><?php echo $productsList[$i]['name'];?><br>
      <?php echo $productsList[$i]['summary'];?></td>
      <td><?php echo $productsList[$i]['price'];?></td>
      <td><?php echo $productsList[$i]['stock'];?></td>
      <td><a href="buy.php?pid=<?php echo $productsList[$i]['id']; ?>"> buy</a></td>
  </tr>
  <?php
  }
  ?>
</table>
</body>
</html>

