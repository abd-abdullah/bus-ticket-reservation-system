<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../libs/Database.php");
include_once ($filepath."/../helpers/Format.php");
?>

<?php
/**
* index class
*/
class City
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	//fetch all Bus list
	public function GetAllCityByUniqueName(){
		$sql = "SELECT DISTINCT city_name FROM tbl_cities ORDER BY city_name ASC";
		$result = $this->db->select($sql);
		return $result;
	}

	public function GetAllCity(){
		$sql = "SELECT * FROM tbl_cities ORDER BY city_name ASC";
		$result = $this->db->select($sql);
		return $result;
	}

	public function GetACityById($city_id){
		$sql = "SELECT * FROM tbl_cities ORDER BY city_name ASC";
		$result = $this->db->select($sql);
		return $result;
	}


	public function InsertCity($data){
		$city_name = $this->test_input($data['city_name']);
		if (empty($city_name))
		{
			$msg = "Fields must not be empty !";
			return $msg;
		}

		else{
			$check_city = "SELECT * FROM tbl_cities WHERE city_name='$city_name'";
			$result = $this->db->select($check_city);

			if ($result != false) {
				$msg = "This City already inserted! Try to insert other cities.";
				return $msg;
			}
			
			else{
				$sql = "INSERT INTO tbl_cities(city_name) VALUES('$city_name')";
			    $inserted = $this->db->insert($sql);

			    if ($inserted) {
			    	$msg = "Successfully City inserted!";
				    return $msg;
			    }else{
			    	$msg = "Failed to inserted!";
					return $msg;
			    }
			}
		}
	}

	public function DeleteCityById($delid){
		$delid = $this->test_input($delid);

		$sql = "DELETE FROM tbl_cities WHERE city_id='$delid'";
		$result = $this->db->delete($sql);
		if ($result) {
			$msg = "Successfully Deleted";
			return $msg;
		}else{
			$msg = "<span class='error'>Failed to Delete.</span>";
			return $msg;
		}

	}

	public function UpdateCityById($name, $editid){
		$city_name = $this->test_input($name);
		$edit_id = $this->test_input($editid);

		if (empty($edit_id) or empty($city_name)) {
			$msg = "<span class='error'>Field must not be empty.</span>";
			return $msg;
		}
		else{
			$check_city = "SELECT * FROM tbl_cities WHERE city_name='$city_name'";
			$result = $this->db->select($check_city);

			if ($result != false) {
				$msg = "This City already inserted! Try to insert other cities.";
				return $msg;
			}

			else{
				$sql = "UPDATE tbl_cities SET city_name = '$city_name' WHERE city_id='$edit_id' ";
				$result = $this->db->update($sql);
				if ($result) {
					$msg = "Successfully Updated";
					return $msg;
				}
				else{
					$msg = "<span class='error'>Filed to Updated !.</span>";
					return $msg;
				}
			}
		}
		
	}



	public function test_input($data){
		$data =trim($data);
		$data =stripslashes($data);
		$data =htmlspecialchars($data);
		$data = $this->fm->validation($data);
		$data = mysqli_real_escape_string($this->db->link, $data);


		return $data;
	}
}

?>