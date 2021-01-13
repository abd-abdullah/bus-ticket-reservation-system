<?php
/**
* Counter_info class
*/
class Complain extends  BaseClass
{
	
	//fetch all Bus list
	public function GetAllCity(){
		$sql = "SELECT DISTINCT city_name FROM tbl_cities ORDER BY city_name ASC";
		$result = $this->db->select($sql);
		return $result;
	}

}

?>