<?php
ob_start();
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="foundation.css">
<head>

  <meta charset="UTF-8">

  <title>eShop</title>
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

    #drop:hover > #dropmenu{
      display: block;
    }

    #dropmenu{

      border: 1px solid black;
      background-color: white;
      border-color: gray;
      border-radius: 0 0 5px 5px;
      margin-top: 9px;
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
  </style>
</head>
</head>

<body>

<div>
 <?php 
 		session_start();
        if(!isset($_SESSION["email"])){
  ?>  
  <h1>Log in</h1>
  <form action="" method="post">
    <input type="email" placeholder="Email" name ="email" id="email"/>
    <input type="password" placeholder="Password" name="password" id="password" />
    <input type="submit" value="Log in" />
  </form>
  <p>New user ? <a href="Register.php">sign up</a> now</p>
</div>
<?php
		}
		?>
  
  <?php
  require_once("LoginValidity.php");
  require_once("products.php");
  $products=new products();
  $productsList = $products->selectAll();
  $user = new LoginValidity();
  if($_POST)
	 {
	  $Email = $_POST["email"];
	  $password = $_POST["password"];
	  if ($user->checkValidity($Email,$password))
	  {
		  echo "Login successful";
		  header("location:show_products.php");
	  }
	  else
	  {
		  echo "please enter correct username and password";
	  }
  }
  if(isset($_SESSION["email"])){
  ?>
  

      <nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="#">My Site</a></h1>
    </li>
  </ul>

    <!-- Right Nav Section -->
    <ul id="list" style="position:absolute; left:90vw; display:inline; top:10px;">
        
      <li ></li>
      <li id="drop" onclick="dropdown();" >
         <?php    $uname = mysql_fetch_assoc(mysql_query("Select first_name from users where email = '". $_SESSION["email"]."'"));
            echo implode(" ", $uname) ;
          ?>
           <ul id="dropmenu">
              <li>
              <a href="cart.php?action=cartl" > 
                
                View Cart <span class ="label"><?php 
                require_once("manage.php");
                $m = new manage();
                $values = $m -> getCart($_SESSION['email']);
                echo count($values);
                ?> </span></a>  
              </li>
              <li><a href="history.php?action=histroy">History</a></li>
             <li ><a href=""> Settings </a>
              </li><br>
              <li>
                <a name="logout" href="home.php?action=logout"> Log out </a>
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

  <?php } ?>
  <div class="row" style="margin-top:10vh;">
<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-3">
  <?php
  
  for($i = 0;$i < count($productsList);$i++)
  {
  ?>
  <li >
     <ul class="pricing-table">
       <li> <p class="title"> <?php echo $productsList[$i]['name'];?></p>
       </li><li class="price">
          <img src="uploads/trollface.png"> 
          <p ><?php echo "$".$productsList[$i]['price'] ;?></p>
        </li>
        <li class="description"><?php echo $productsList[$i]['summary'];?></li>
        <li class="cta-button">
            
      <?php if($productsList[$i]['stock'] > 0){ ?>
      <?php if(isset($_SESSION["email"])){ ?>
      <p><a href="buy.php?<?php echo "pid=" . $productsList[$i]['id'];?>"> Buy</a></p>
      <?php }else { ?>
      <p><a href="home.php?action=login"> Buy</a></p>
      
      <?php } ?>
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

 if(isset($_GET['action']) && $_GET['action']=="login"){
	echo '<script language="javascript">';
			echo 'alert("You Should login first")';
			echo '</script>';
 }
 

 ?>
</body>

</html>