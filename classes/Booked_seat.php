<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../libs/Database.php");
include_once ($filepath."/../helpers/Format.php");
?>

<?php
/**
* Counter_info class
*/
class Booked_seat
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function GetAllBookedSeats($trip_id,$date){
		$sql = "SELECT * FROM tbl_booked_seats WHERE `trip_id`='$trip_id' and date ='$date'";
		$result = $this->db->select($sql);
		return $result;
	}

	public function GetAllReservedSeats($trip_id,$user_id,$date){
		$sql = "SELECT seat_no FROM tbl_booked_seats WHERE `trip_id` = '$trip_id' AND `date` = '$date'
				UNION
				SELECT seat_no FROM tbl_reserved_seat  WHERE `trip_id` ='$trip_id' AND `date` = '$date' AND `user_id` != '$user_id'";
		$result = $this->db->select($sql);
		return $result;
	}

	public function GET_AllReservedSeats($trip_id,$date){
		$sql = "SELECT seat_no FROM tbl_booked_seats WHERE `trip_id` = '$trip_id' AND `date` = '$date'
				UNION
				SELECT seat_no FROM tbl_reserved_seat  WHERE `trip_id` ='$trip_id' AND `date` = '$date'";
		$result = $this->db->select($sql);
		return $result;
	}



	public function GetReservedByItself($trip_id,$user_id,$date){
		$sql = "SELECT seat_no FROM tbl_reserved_seat  WHERE `trip_id` ='$trip_id' AND `date` = '$date' AND `user_id` = '$user_id'";
		$result = $this->db->select($sql);
		return $result;
	}

	public function GetAvailabaleSeat($trip_id,$date){
	
	$sql = "SELECT 
			SUM(temp.total) as total
			FROM
			(SELECT COUNT(*) As total FROM tbl_booked_seats WHERE trip_id = '$trip_id' and date = '$date'
				UNION ALL
				SELECT COUNT(*) As total FROM
				tbl_reserved_seat WHERE
				trip_id = '$trip_id' and date = '$date') temp";

	$result = $this->db->select($sql);
	return $result;
	}


	public function InsertBookedSeats($pnr_no,$trip_id,$user_id,$journey_date,$seat){
		$pnr_no = $this->test_input($pnr_no);
		$trip_id = $this->test_input($trip_id);
		$user_id = $this->test_input($user_id);
		$journey_date = $this->test_input($journey_date);
		$seat = $this->test_input($seat);

		$sql = "INSERT INTO tbl_booked_seats (pnr_no,trip_id,passenger_id,seat_no,date) VALUES ('$pnr_no', '$trip_id','$user_id', '$seat', '$journey_date')";
		$result = $this->db->insert($sql);
		return $result;
	}


	public function BookedSeatsByPnr($pnr_no,$user_id,$trip_id){
		$pnr_no = $this->test_input($pnr_no);
		$trip_id = $this->test_input($trip_id);
		$user_id = $this->test_input($user_id);

		$sql = "SELECT * FROM tbl_booked_seats WHERE `pnr_no`='$pnr_no' AND passenger_id='$user_id' AND trip_id ='$trip_id'";
		$result = $this->db->select($sql);
		return $result;
	}

	public function BookedSeatsForPrint($pnr_no){
		$pnr_no = $this->test_input($pnr_no);
		// $trip_id = $this->test_input($trip_id);
		// $user_id = $this->test_input($user_id);

		$sql = "SELECT * FROM tbl_booked_seats WHERE `pnr_no`='$pnr_no'";
		$result = $this->db->select($sql);
		return $result;
	}

/*
	public function GetAllSoldTkt($from_date,$to_date){
		$from_date = strtotime($from_date);
		$from_date = strtotime($to_date);
		$sql = "SELECT * FROM tbl_booking_info INNER JOIN tbl_passenger_info ON tbl_booking_info.passenger_id = tbl_passenger_info.id INNER JOIN tbl_trip_info ON tbl_booking_info.trip_id=tbl_trip_info.trip_id INNER JOIN tbl_bus_info ON tbl_trip_info.bus_id = tbl_bus_info.bus_id INNER JOIN tbl_counter_info ON tbl_booking_info.counter_id=tbl_counter_info.counter_id";
		$result = $this->db->select($sql);
		return $result;
	}
*/



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