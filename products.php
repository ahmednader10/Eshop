<?php
require_once("DBConnection.php");
class products extends DBConnection
{
	private $tableName = "products";
	private $id;
	private $name;
	private $summary;
	private $price;
	private $stock;
	public function products()
	{
		$this->tableName="products";
		$this->id = "";
		$this->name = "";
		$this->summary="";
		$this->price="";
		$this->stock="";
		
	}
	public function selectAll()
	{
		$array = array();
		if ($this->DBselection())
		{
			$Query="select * from ".$this->tableName;
			$ExcuteQuery = mysql_query($Query);
			
			while($row = mysql_fetch_assoc($ExcuteQuery))
			{
				array_push($array,$row);
			}
		}
		else 
		{
			echo "can't connect to the database";
		}
		return $array;
		
	}

	public function selectByID($id)
	{
		$array = array();
		if ($this->DBselection())
		{
			$Query="select * from products where id =".$id;
			$ExcuteQuery = mysql_query($Query);
			if(! $ExcuteQuery){
				echo "Db error";
			}else{
			while($row = mysql_fetch_assoc($ExcuteQuery))
			{
				array_push($array,$row);
			}
			}
		}
		else 
		{
			echo "can't connect to the database";
		}
		return $array;
		
	}
}