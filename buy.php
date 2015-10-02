
<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">

  <title>eShop</title>

</head>
<body>
<div>
<?php 
  require_once("manage.php");
  require_once("products.php");
  session_start();
 // session_destroy();
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
    
    <a href="buy.php?action=add&pid=<?php echo $pid ?>"> Add to Cart</a><br>
    
<?php

  }
	
  // if(isset($_REQUEST['buy'])){
  //   $u = "Select id from users where email = '".$email."'";
  //     $uid = mysql_query($u);
  //     $id = mysql_fetch_row($uid);
  //   $query = "insert into Bought (user_id =".$id[0].", product_id =".$pid.", bought =false)";
  //   $exec = mysql_query($query);
  //   if(!$exec){
  //     echo "failed";
  //   }
  //   else {
  //     echo "success";
  //   }
  // }
  // 
  require_once("manage.php");
  $m = new manage();
 if(isset($_GET['action']) && $_GET['action']=="add"){
//   $insert = "Insert into Bought VALUES(".$_SESSION["id"].",".$pid.",false)";
//   $exec = mysql_query($insert);
//   if($exec){
//     if($db-> DBselection()){
//       echo "success";
//     }
//     }else{
//       echo "failed";
//     }
    $m ->addtocart($_SESSION['email'],$pid);

   }


  ?>
    <a href="show_products.php">Back to all products</a>      
</div>
</body>
</html>