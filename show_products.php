<!DOCTYPE html>
<html>

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

      border: 3px solid black;
      background-color: white;
      border-color: gray;
      border-radius: 5px 5px 5px 5px;
      margin-top: 20px;
     text-align: left;
     display: none;
    }

    #title{
            color: white;
   font-size:20px; text-align:center; font-size:20px;background-color:#333333; 
   box-shadow: 0px 2px black;
    }

    .product{
      list-style: none;
      padding: 0;
      margin: 0;
          }

    .flashy{
      text-align: center;
      font-size: 30px;
      background-color: #e6e6e6;
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
        
      <li ><a href="#"><img src="<?php    $uname = mysql_fetch_assoc(mysql_query("Select avatar from users where email = '". $_SESSION["email"]."'"));
            echo implode(" ", $img) ;
          ?>"></a></li>
      <li id="drop" onclick="dropdown();">
         <?php    $uname = mysql_fetch_assoc(mysql_query("Select first_name from users where email = '". $_SESSION["email"]."'"));
            echo implode(" ", $uname) ;
          ?> <span class="glyphicon glyphicon-chevron-down"></span>
           <ul id="dropmenu">
              <li>
              <a href="cart.php"> View Cart 
              <span class="label"> 
                <?php 
                require_once("manage.php");
                $m = new manage();
                $values = $m -> getCart($_SESSION['email']);
                echo count($values);
                ?>
                </span> <br></a>  
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
<div>
<a href="cart.php?action=cart"> My Cart</a><br>
<a href="history.php?action=histroy">History</a>

</div>
<div class="row">
<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-3" style="margin-top:10vh;">
  <?php
  
  for($i = 0;$i < count($productsList);$i++)
  {
  ?>
  <li >
     <ul class="pricing-table">
       <li> <p class="title"> <?php echo $productsList[$i]['name'];?></p>
       </li><li class="price">
          <img src="troll.png"> 
          <p ><?php echo $productsList[$i]['price'];?></p>
        </li>
        <li class="description"><?php echo $productsList[$i]['summary'];?></li>
        
        <li class="cta-button">
            <?php if($productsList[$i]['stock'] > 0){ ?>
            <a href="buy.php?<?php echo "pid=" . $productsList[$i]['id'];?>"> Buy</a>
            <?php }else {?>
            <p> Out of Stock </p>
            <?php } ?>
        </li>
     </ul>
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

