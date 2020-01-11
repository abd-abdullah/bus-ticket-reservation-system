<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../libs/Database.php");
include_once ($filepath."/../helpers/Format.php");
?>

<?php
/**
* Counter_info class
*/
class Reserved_info
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	//fetch all Bus list
	public function InsertSeat($data){
		$trip_id = $this->test_input($data['trip_id']);
		$bus_id = $this->test_input($data['bus_id']);
		$passenger_id = $this->test_input($data['passenger_id']);
		$journey_date = $this->test_input($data['journey_date']);
	    $seat = $this->test_input($data['seat']);
	    $session_id = $this->test_input($data['session_id']);

		$sql = "INSERT INTO tbl_reserved_seat (trip_id,user_id,session_id,bus_id,`date`,seat_no) VALUES ('$trip_id', '$passenger_id', '$session_id','$bus_id', '$journey_date', '$seat')";
		$result = $this->db->insert($sql);
		return $result;
	}

	public function DeleteSeat($data){
		$trip_id = $this->test_input($data['trip_id']);
		//$bus_id = $this->test_input($data['bus_id']);
		$passenger_id = $this->test_input($data['passenger_id']);
		$journey_date = $this->test_input($data['journey_date']);
	    $seat = $this->test_input($data['seat']);

		$sql = "DELETE FROM tbl_reserved_seat WHERE seat_no='$seat' AND trip_id = '$trip_id' AND `date` = '$journey_date' AND user_id='$passenger_id'";
		$result = $this->db->delete($sql);
		return $result;

	}


	public function DeleteAllSelectedSeats($data){
		$trip_id = $this->test_input($data['trip_id']);
		$session_id = $this->test_input($data['session_id']);
		$passenger_id = $this->test_input($data['passenger_id']);
		$journey_date = $this->test_input($data['journey_date']);

		$sql = "DELETE FROM tbl_reserved_seat WHERE  trip_id = '$trip_id' AND `date` = '$journey_date' AND user_id='$passenger_id' ";
		$result = $this->db->delete($sql);
		return $result;

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