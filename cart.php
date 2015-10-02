<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="foundation.css">

	<title></title>
</head>
<body>
<div>
	<?php
	session_start();
	require_once("manage.php");
	$m = new manage();
	$values = $m -> getCart($_SESSION['email']);
	// $u = "Select id from users where email = '".$_SESSION['email']."'";
	// 		$uid = mysql_query($u);
	// 		$id = mysql_fetch_row($uid);
	// 		$query = "Select * from products 
	// 		Join Bought where User_id 
	// 		"

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
	<div class="row" style="margin-top:10vh;">
			<table style="position:absolute; left:30vw; width:40vw; ">
				<tr scope="column">
					<th scope="row">
						Product
					</th>
					<th scope="row">
						Stock
					</th>
					<th scope="row">
						Price
					</th>

				</tr>
			<?php

			  for($i = 0;$i < count($values);$i++)
		  {
			?><tr scope="column">
				
			<td scope="row">
				<?php echo  $values[$i]['name'];?>
			</td>
			<td scope="row">
				<?php  echo $values[$i]['stock'];?>
			</td>
			<td scope="row">
				<?php echo $values[$i]['price'];?>
			</td>
			<?php 
			}
			?>
			</tr>
			</table>
		
		
	</div>
	<a href="#"> Checkout </a>

</div>
</body>
</html>