<?php
require_once("DBConnection.php");
class LoginValidity extends DBConnection
{
	private $tableName = "users";
	private $email;
	private $id;
	private $password;
	public function LoginValidity()
	{
		$this->email = '';
		$this->password = '';
		$this->id = '';
		$this->tableName = "users";
	}
	public function setData($ID,$Email,$password)
	{
		$this->id = $ID;
		$this->email = $Email;
		$this->password=$password;
	}
	public function SelectAllData()
	{
		$Array = array();
		if ($this->DBselection())
		{
			$Query = "Select * from ".$this->tableName;
			$ExcuteQuery = mysql_query($Query);
			
			while($row = mysql_fetch_assoc($ExcuteQuery))
			{
				array_push($Array,$row);
			}
		}
		else 
		{
			echo "can't connect to the database";
		}
		return $Array;
		
	}
	public function checkValidity($Email,$password)
	{
		if ($this->DBselection())
		{
			$Query = "Select * from ".$this->tableName." where email = '".$Email."' and password = '".$password."'";
			$ExcuteQuery = mysql_query($Query);
			$row = mysql_fetch_assoc($ExcuteQuery);
			if ($row)
			{
				return true;	
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
		
	}
	
}
?>