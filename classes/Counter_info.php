<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../libs/Database.php");
include_once ($filepath."/../helpers/Format.php");
?>

<?php
/**
* Counter_info class
*/
class Counter_info
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	//fetch all Bus list
	public function GetBoardingPoints($from_city){
		$sql = "SELECT * FROM tbl_counter_info WHERE `city_name`='$from_city'";
		$result = $this->db->select($sql);
		return $result;
	}

	public function GetCounterById($counter_id){
		$sql = "SELECT * from tbl_counter_info WHERE counter_id='$counter_id'";
		$result = $this->db->select($sql);
		return $result;
	}

	public function GetAllCounter(){
		$sql = "SELECT * FROM tbl_counter_info ORDER BY city_name ASC";
		$result = $this->db->select($sql);
		return $result;
	}

	/*editing*/
	public function InsertCounter($data){
		$counter_name = $this->test_input($data['counter_name']);
		$city_name = $this->test_input($data['city_name']);
		$contact_no = $this->test_input($data['contact_no']);
		$location_counter = $this->test_input($data['location_counter']);
		if (empty($counter_name) || empty($city_name)  || empty($contact_no) || empty($location_counter) )
		{
			$msg = "Fields must not be empty !";
			return $msg;
		}

		else{
			$check_counter = "SELECT * FROM tbl_counter_info WHERE counter_name = '$counter_name' AND contact_no = '$contact_no'";
			$result = $this->db->select($check_counter);

			if ($result != false) {
				$msg = "This Counter phone number and name already inserted! Try to insert other cities.";
				return $msg;
			}
			
			else{
				$sql = "INSERT INTO tbl_counter_info (city_name,counter_name,contact_no,location_counter) VALUES('$city_name','$counter_name', '$contact_no','$location_counter')";
			    $inserted = $this->db->insert($sql);

			    if ($inserted) {
			    	$msg = "Successfully Counter information inserted!";
				    return $msg;
			    }else{
			    	$msg = "Failed to inserted!";
					return $msg;
			    }
			}
		}
	}

	public function DeleteCounterById($delid){
		$delid = $this->test_input($delid);


		$sql = "DELETE FROM tbl_counter_info WHERE counter_id='$delid'";
		$result = $this->db->delete($sql);
		if ($result) {
			$msg = "Successfully Deleted";
			return $msg;
		}else{
			$msg = "<span class='error'>Failed to Delete.</span>";
			return $msg;
		}

	}

	public function UpdateCounterById($data, $editid){
		$counter_name = $this->test_input($data['counter_name']);
		$city_name = $this->test_input($data['city_name']);
		$contact_no = $this->test_input($data['contact_no']);
		$location_counter = $this->test_input($data['location_counter']);
		$edit_id = $this->test_input($editid);

		if (empty($counter_name) || empty($city_name)  || empty($contact_no) || empty($location_counter) )
		{
			$msg = "Fields must not be empty !";
			return $msg;
		}

	/*	else{
			$check_counter = "SELECT * FROM tbl_counter_info WHERE counter_name = '$counter_name' AND contact_no = '$contact_no'";
			$result = $this->db->select($check_counter);

			if ($result != false) {
				$msg = "This Counter phone number and name already inserted! Try to insert other cities.";
				return $msg;
			}*/

		

		else{
			$sql = "UPDATE tbl_counter_info SET city_name = '$city_name', counter_name='$counter_name', contact_no='$contact_no', location_counter='$location_counter' WHERE counter_id='$edit_id' ";
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