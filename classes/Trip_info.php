
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../libs/Database.php");
include_once ($filepath."/../helpers/Format.php");
?>

<?php
/**
* Counter_info class
*/
class Trip_info
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function GetSearchBus($from_city,$to_city){
		$sql = "SELECT * FROM tbl_trip_info INNER JOIN tbl_bus_info ON tbl_trip_info.bus_id = tbl_bus_info.bus_id WHERE  tbl_trip_info.from_city='$from_city' AND tbl_trip_info.to_city='$to_city' ORDER by departure_time ASC";

		$result = $this->db->select($sql);
		return $result;
	}

	public function GetSearchBusBytripId($trip_id){
		$sql = "SELECT * FROM tbl_trip_info INNER JOIN tbl_bus_info ON tbl_trip_info.bus_id = tbl_bus_info.bus_id WHERE tbl_trip_info.trip_id='$trip_id'";

		$result = $this->db->select($sql);
		return $result;
	}

	
	//fetch all Bus list

	public function GetAllTrip(){
		$sql = "SELECT * FROM tbl_trip_info ORDER BY departure_time ASC";
		$result = $this->db->select($sql);
		return $result;
	}

	public function InsertTrip($data){
		$bus_id = $this->test_input($data['bus_id']);
		$from_city = $this->test_input($data['from_city']);
		$to_city = $this->test_input($data['to_city']);
		$fare = $this->test_input($data['fare']);
		$dept_time = $this->test_input($data['dept_time']);
		$arrival_time = $this->test_input($data['arrival_time']);
		if (empty($bus_id) || empty($from_city)  || empty($to_city) || empty($fare) || empty($dept_time) || empty($arrival_time) )
		{
			$msg = "Fields must not be empty !";
			return $msg;
		}

		else{
			$check_trip = "SELECT * FROM tbl_trip_info WHERE bus_id = '$bus_id' AND from_city = '$from_city'";
			$result = $this->db->select($check_trip);

			if ($result != false) {
				$msg = "This trip has already inserted! Try to insert other cities.";
				return $msg;
			}
			
			else{
				$sql = "INSERT INTO tbl_trip_info (bus_id,from_city,to_city,fare,departure_time,arrival_time) VALUES('$bus_id','$from_city', '$to_city','$fare', '$dept_time','$arrival_time')";
			    $inserted = $this->db->insert($sql);

			    if ($inserted) {
			    	$msg = "Successfully trip information inserted!";
				    return $msg;
			    }else{
			    	$msg = "Failed to inserted!";
					return $msg;
			    }
			}
		}
	}

	public function UpdateTripById($data, $editid){
		$edit_id = $this->test_input($editid);
		$bus_id = $this->test_input($data['bus_id']);
		$from_city = $this->test_input($data['from_city']);
		$to_city = $this->test_input($data['to_city']);
		$fare = $this->test_input($data['fare']);
		$dept_time = $this->test_input($data['dept_time']);
		$arrival_time = $this->test_input($data['arrival_time']);
		if (empty($bus_id) || empty($from_city)  || empty($to_city) || empty($fare) || empty($dept_time) || empty($arrival_time) )
		{
			$msg = "Fields must not be empty !";
			return $msg;
		}

		else{
			$sql = "UPDATE tbl_trip_info SET bus_id = '$bus_id', from_city='$from_city', to_city='$to_city', fare='$fare',departure_time ='$dept_time', arrival_time = '$arrival_time' WHERE trip_id='$edit_id' ";
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


	public function GetAllTripAndBus(){
		$sql = "SELECT * FROM tbl_trip_info INNER JOIN tbl_bus_info ON tbl_trip_info.bus_id=tbl_bus_info.bus_id";
		$result = $this->db->select($sql);
		return $result;
	}

	public function GetAllTripAndBusByTripId($id){
		$sql = "SELECT * FROM tbl_trip_info INNER JOIN tbl_bus_info ON tbl_trip_info.bus_id=tbl_bus_info.bus_id WHERE tbl_trip_info.trip_id ='$id'";
		$result = $this->db->select($sql);
		return $result;
	}

	public function DeleteTripById($delid){
		$delid = $this->test_input($delid);

		$sql = "DELETE FROM tbl_trip_info WHERE trip_id='$delid'";
		$result = $this->db->delete($sql);
		if ($result) {
			$msg = "Successfully Deleted";
			return $msg;
		}else{
			$msg = "<span class='error'>Failed to Delete.</span>";
			return $msg;
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