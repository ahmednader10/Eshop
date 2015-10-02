<!DOCTYPE html>
<html>
<link rel="stylesheet" href="foundation.css">

<head>
<script type="text/javascript">
  function dropdown(){
    if(document.getElementById('dropmenu').style.display== 'none'){
      document.getElementById('dropmenu').style.display= 'block';
    } else {
      document.getElementById('dropmenu').style.display= 'none';
    }
  }
</script>
  <meta charset="UTF-8">

  <title>eShop</title>
  <style type="text/css">

    #list li{
      display: inline;
      margin: 20px;
      color: white;
    }

    #dropmenu{
      background-color: white;
      margin-top: 20px;
     text-align: center;
     display: none;
    }

  </style>
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
  </ul>

    <!-- Right Nav Section -->
    <ul id="list" style="position:absolute; left:90vw; display:inline; top:10px;">
        
      <li ><a href="#"><img src="troll.png"></a></li>
      <li id="drop" onclick="dropdown();">
         <?php    $uname = mysql_fetch_assoc(mysql_query("Select first_name from users where email = '". $_SESSION["email"]."'"));
            echo implode(" ", $uname) ;
          ?>
           <ul id="dropmenu">
              <li>
              <a href="cart.php"> View Cart <br></a>  
              </li>
              <li>
                <a name="logout" href="home.php"> Log out<br> </a>
              </li>
              <li>
                <a href=""> Settings </a>
              </li>
      </ul>
     
      </li>
         
    </ul>

    <!-- Left Nav Section -->
    <ul class="left">
      <li style="color:white;"><p style="position:absolute; top:10px;">
    </li>
    </ul>
</nav>
<div class="row">
<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-3" style="margin-top:10vh;">
  <?php
  
  for($i = 0;$i < count($productsList);$i++)
  {
  ?>
  <li style="">
      <img src="/opt/lampp/htdocs/eshop/Eshop/troll.png"> 
      <p style="font-size:20px;"> <?php echo $productsList[$i]['name'];?></p>
      <p> <?php echo $productsList[$i]['summary'];?>
      stock:  <?php echo $productsList[$i]['stock'];?>  price:  <?php echo $productsList[$i]['price'];?></p>
      <a href="buy.php?<?php echo "pid=" . $productsList[$i]['id'];?>"> Buy</a>
  </li>
   <?php
  }
  ?>
</ul>

</div>
</body>
</html>

