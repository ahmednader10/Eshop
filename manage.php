<?php
	require_once("DBConnection.php");
	class manage extends DBConnection{
		private $user_id;
		private $product_id;
		private $tablename = "Bought";
		private $quantity ;

		public function manage(){
			$this->tablename = "Bought";
		}

		public function addtocart($email,$pid){
			$u = "Select id from users where email = '".$email."'";
			$uid = mysql_query($u);
			$id = mysql_fetch_row($uid);
			$this->user_id = $id[0];
			$this->product_id = $pid;
			if ($this->DBselection())
			{
			$Query1 = "Insert INTO Bought (User_id, Product_id,bought) VALUES (". $id[0] .",".$pid.",false)";
			
			$ExcuteQuery = mysql_query($Query1);
		
			if($ExcuteQuery){
				header("location:cart.php");
			}
			else{
				echo "failed to add to cart";
					echo $id[0];
			echo $pid;
		
			}
		}
		else {
			echo "can't connect to db";
			
			
		}
		}
		public function getCart($email){			
		$array = array();
		if ($this->DBselection())
			{
				$u = "Select id from users where email = '".$email."'";
			$uid = mysql_query($u);
			$id = mysql_fetch_row($uid);

		$query = "Select name,summary,price,b.id from products as p INNER JOIN Bought as b
		on p.id = b.Product_id
		where b.User_id = ".$id[0] ." AND b.bought = false" ;
		$exec = mysql_query($query);
			while($row = mysql_fetch_assoc($exec))
			{
				array_push($array,$row);
			}
		}else{
				echo 'db fail';
		}
		return $array;
	}  
	public function RemoveFromCart($pid){
		$array = array();
		if ($this->DBselection())
			{
				
		$query = "delete from Bought where id = ".$pid;
		$exec = mysql_query($query);
		if($exec){
				header("location:cart.php");
			}
			else{
				echo "failed to remove from cart";
					echo $id[0];
			echo $pid;
		
			}
	}
		else {
			echo "can't connect to db";
			
			
		}
	
	}
	}
?>