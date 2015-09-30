<?php
	require_once("DBConnection.php");
	class manage extends DBConnection{
		private $user_id;
		private $product_id;
		private $tablename = "Bought";
		private $quantity ;
		public function addtocart($uid,$pid){
			$this->user_id = $uid;
			$this->product_id = $pid;
			if ($this->DBselection())
			{
			$Query1 = "Insert INTO Bought (User_id, Product_id,bought) VALUES (". $uid .",".$pid.",0)";
			
			$ExcuteQuery = mysql_query($Query1);
		
			if(mysql_query($Query1 )){
				header("location:cart.php");
			}
			else{
				echo "failed to buy product";
			}
		}
		else {
			echo "can't connect to db";
			echo $uid;
			echo $pid;
			
			
		}
		}
	}
  ?>