<?php
include_once ($_SERVER['DOCUMENT_ROOT']."libs/Database.php");
include_once ($_SERVER['DOCUMENT_ROOT']."helpers/Format.php");

/**
* Counter_info class
*/
class Complain
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	//fetch all Bus list
	public function GetAllCity(){
		$sql = "SELECT DISTINCT city_name FROM tbl_cities ORDER BY city_name ASC";
		$result = $this->db->select($sql);
		return $result;
	}

}

?>