
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
    <h1> stock: <?php echo $values[$i]['stock'];?></h1>
    <a href="buy.php?action=add&pid=<?php echo $pid ?>"> Add to Cart</a>
    
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
          
</div>
</body>
</html>