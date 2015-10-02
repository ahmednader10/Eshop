<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="foundation.css">
<script type="text/javascript">
  function dropdown(){
    if(document.getElementById('dropmenu').style.display== 'none'){
      document.getElementById('dropmenu').style.display= 'block';
    } else {
      document.getElementById('dropmenu').style.display= 'none';
    }
  }
</script>
 <style type="text/css">

    #list li{
      display: inline;
      margin: 20px;
      color: white;
    }

    #drop:hover > #dropmenu{
      display: block;
    }

    #dropmenu{

      border: 1px solid gray;
      background-color: white;
      border-color: gray;
      border-radius: 0 0 5px 5px;
      margin-top: 8px;
      margin-right: 3px;
     text-align: center;
     display: none;
     box-shadow: 1px 1px gray;
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
    
    nav{
      width: 100vw;
    }
  </style>
	<title>eShop</title>
</head>
<body class="container">
		<?php
	session_start();
	require_once("manage.php");
	require_once("products.php");
	$m = new manage();
	$values = $m -> getCart($_SESSION['email']);


	?>
	
      <nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="show_products.php">eShop</a></h1>
    </li>
  </ul>

    <!-- Right Nav Section -->
    <ul id="list" style="position:absolute; left:90vw; display:inline; top:10px;">
        
      <li > <img style=" width:2vw; height:3.5vh;" src="<?php $img = mysql_fetch_assoc(mysql_query("Select avatar from users where email = '". $_SESSION["email"]."'"));
            echo implode(" ", $img) ; ?>" >
  </li>
      <li id="drop" onclick="dropdown();" >
         <?php    $uname = mysql_fetch_assoc(mysql_query("Select first_name from users where email = '". $_SESSION["email"]."'"));
            echo $uname['first_name'] 
          ?>
           <ul id="dropmenu">
              <li>
              <a href="cart.php?action=cart" > 
                
                View Cart <span class ="label"><?php 
                require_once("manage.php");
                $m = new manage();
                $values = $m -> getCart($_SESSION['email']);
                echo count($values);
                ?> </span></a>  
              </li>
              <li><a href="history.php?action=history">History</a></li><br>
             <li ><a href="show_products.php"> All Products </a>
              </li><br>
              <li>
                <a name="logout" href="logout.php"> Log out </a>
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

  
  <?php
   $p = new products();
   $pid = $_GET['pid'];
        $values = $p->selectByID($_GET['pid']);
        ?>

  <div class="row">
<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-1" style="margin-top:3vh;">
   <?php
  for($i = 0;$i < count($values);$i++)
  {

  ?>

    <li >
     <ul class="pricing-table">
       <li class="title"> <p > <?php echo $values[$i]['name'];?></p>
       </li><li class="price">
          <img src="uploads/trollface.png"> 
          <p ><?php echo "$".$values[$i]['price'];?></p>
        </li>
        <li class="description"><?php echo $values[$i]['summary'];?></li>
        <li class="cta-button">
    
    <p><a href="buy.php?action=add&pid=<?php echo $pid ?>"> Add to Cart</a></p></li>
    </ul>
    </li>
    
<?php

  }
?>
</ul>
</div>
<?php	
  
  $m = new manage();
 if(isset($_GET['action']) && $_GET['action']=="add"){
    $m ->addtocart($_SESSION["email"],$pid);

   }


  ?>
      
</div>
</body>
</html>s