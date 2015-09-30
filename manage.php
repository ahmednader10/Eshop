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
		public function getCart($id)
	{			
		$array = array();
		if ($this->DBselection())
			{
		$query = "Select * from products Join Bought  
		where user_id = ".$id ;
		$exec = mysql_query($query);
		if(! $exec){
				echo "Db error";
			}else{
			while($row = mysql_fetch_assoc($exec))
			{
				array_push($array,$row);
			}
			}
		}else{
			echo 'db fail';
		}
		return $array;
	}  
	}

	
?>