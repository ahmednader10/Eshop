<!DOCTYPE html>
<html>
<link rel="stylesheet" href="foundation.css">
<head>

  <meta charset="UTF-8">

  <title>eShop</title>

</head>
<body>

<?php
session_start();
require_once("products.php");
$products=new products();
$productsList = $products->selectAll();
?>
      <nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="#">My Site</a></h1>
    </li>
     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>

  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
        <?php 
        if($_SESSION["email"]){
  ?>  
      <li class="active"><a href="#">avatar</a></li>
      <li class="has-dropdown">
        <a href="#">
         
         <?php    $uname = mysql_fetch_assoc(mysql_query("Select first_name from users where email = '". $_SESSION["email"]."'"));
            echo implode(" ", $uname) ;
          ?>
          </a>
        <ul class="dropdown">
          <li><a href="#">View Cart</a></li>
          <li class="active"><a href="#">Log out</a></li>
          <li class="active"><a href="#">Settings</a></li>
        </ul>
      </li>
          <?php
          }else{
           ?>
            <li class="has-dropdown">
        <a href="#"> Guest </a>
        <ul class="dropdown">
          <li><a href="#">View Cart</a></li>
          <li class="active"><a href="#">Log out</a></li>
          <li class="active"><a href="#">Settings</a></li>
        </ul>
      </li>
     
           <?php
          }
        ?>
    </ul>

    <!-- Left Nav Section -->
    <ul class="left">
      <li style="color:white;"><p style="position:absolute; top:10px;">
      <?php 
        if($_SESSION["email"]){
             $uname = mysql_fetch_assoc(mysql_query("Select first_name from users where email = '". $_SESSION["email"]."'"));
            echo implode(" ", $uname) ;
          }else{
            echo "Guest!";
          }
        ?>
      </p>
    </li>
    </ul>
  </section>
</nav>
<?php
if( !empty( $_REQUEST['message'] ) )
{
    echo sprintf( '<p>%s</p>', $_REQUEST['message'] );
}
?>
<div>
<a href="cart.php?action=cart"> My Cart</a><br>
<a href="history.php?action=histroy">History</a>

</div>
<div class="row">
<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-3">
  <?php
  
  for($i = 0;$i < count($productsList);$i++)
  {
  ?>
  <li style="">
      <img src="troll.png"> 
      <p style="font-size:20px;"> <?php echo $productsList[$i]['name'];?></p>
      <p> <?php echo $productsList[$i]['summary'];?><br>
      price:  <?php echo $productsList[$i]['price'];?></p>
      <?php if($productsList[$i]['stock'] > 0){ ?>
      <a href="buy.php?<?php echo "pid=" . $productsList[$i]['id'];?>"> Buy</a>
      <?php }else {?>
      <p> Out of Stock </p>
      <?php } ?>
  </li>
   <?php
  }
  ?>
</ul>

</div>
<?php
if(isset($_GET['action']) && $_GET['action']=="histroy"){
	$m ->viewHistory($_SESSION["email"]);
}

?>
</body>
</html>

