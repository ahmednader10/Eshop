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
			$Query2 = "update products set stock= stock-1 where id =".$pid;
			
			$ExcuteQuery = mysql_query($Query1);
			$ExcuteQuery2 = mysql_query($Query2);
		
			if($ExcuteQuery && $ExcuteQuery2){
				header("location:cart.php");
			}
			else{
				echo "failed to add to cart";
			
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
	public function viewHistory($email){			
		$array = array();
		if ($this->DBselection())
			{
				$u = "Select id from users where email = '".$email."'";
			$uid = mysql_query($u);
			$id = mysql_fetch_row($uid);

		$query = "Select name,summary,price,b.id from products as p INNER JOIN Bought as b
		on p.id = b.Product_id
		where b.User_id = ".$id[0] ." AND b.bought = true" ;
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
	public function PurchaseCart($email){			
		
		if ($this->DBselection())
			{
				$u = "Select id from users where email = '".$email."'";
			$uid = mysql_query($u);
			$id = mysql_fetch_row($uid);

		$query = "update Bought set bought=true where User_id = ". $id[0];
		$exec = mysql_query($query);
			if($exec){
				$message="Items purchased successfully";
				header("location:show_products.php?message={$message}");
			}
			else{
				echo "failed to add to cart";
		
			}
		}else{
				echo 'db fail';
		}
	
	}  
	public function RemoveFromCart($pid){
		$array = array();
		if ($this->DBselection())
			{
			$p = "Select Product_id from Bought where id = ".$pid;
			$id = mysql_query($p);
			$p_id = mysql_fetch_row($id);
			$id = $p_id[0];	
		$query = "delete from Bought where id = ".$pid;
		$Query2 = "update products set stock= stock+1 where id =".$id;
		$exec = mysql_query($query);
		$exec2 = mysql_query($Query2);
		if($exec && $exec2){
			
				header("location:cart.php");
			}
			else{
				echo "failed to add to cart";
		
			}
	}
		else {
			echo "can't connect to db";
			
			
		}
	
	}
	}
?>