<?php
class DBConnection 
{
	private $server = 'localhost';
	private $username = 'root';
	private $password = '';
	private $DBname = 'eshop';
	
	public function DBConnection()
	{
		$this->DBname='';
		$this->server='';
		$this->password='';
		$this->username='';
	}
	public function Connect()
	{
		$Query = mysql_connect($this->server,$this->username,$this->password);
		if($Query)
		{
			return true;
		}
		else 
		{
			return true;
		}
	}
	public function DBselection()
	{
		if ($this->Connect())
		{
			$Query = mysql_select_db($this->DBname);
			if ($Query)
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