<!DOCTYPE html>
<html>
<body>
<?php
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
</body>
</html>


