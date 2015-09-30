<?php
	class Buy {
		private $user_id;
		private $product_id;
		private $tablename = "Bought";
		private $quantity ;
		public function buys($uid,$pid,$quantity){
			$stock = "Select stock FROM products WHERE id =". $pid;
			$this->user_id = $uid;
			$this->product_id = $pid;
			$this->quantity = $quantity;
			$Query1 = "Insert INTO Bought (User_id, Product_id, quantity) VALUES (". $uid .",".$pid.",".$quantity.")";
			$Query2 = "Update products SET stock=".$stock-$quantity. "WHERE id=1";
			$ExcuteQuery = mysql_query($Query1);
			
			$ExcuteQuery2 = mysql_query($Query2);

			if(ExcuteQuery1){
				header("location:show_products.php");
			}
			
		}
	}
  ?>