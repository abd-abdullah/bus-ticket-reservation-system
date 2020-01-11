<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../libs/Database.php");
include_once ($filepath."/../helpers/Format.php");
?>

<?php
/**
* Counter_info class
*/
class Booking_info
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	//fetch all Bus list
	public function GetAllSoldTkt(){
		$sql = "SELECT COUNT(*) AS total FROM tbl_booking_info WHERE booking_status =1";
		$result = $this->db->select($sql);
		return $result;
	}

	public function GetAllPendingTkt(){
		$sql = "SELECT COUNT(*) AS total FROM tbl_booking_info WHERE booking_status =0";
		$result = $this->db->select($sql);
		return $result;
	}

	public function InsertBooking($pnr_no,$trip_id,$user_id,$boarding_id,$reference,$total_amount,$journey_date){
		$pnr_no = $this->test_input($pnr_no);
		$trip_id = $this->test_input($trip_id);
		$user_id = $this->test_input($user_id);
		$counter_id = $this->test_input($boarding_id);
		$reference = $this->test_input($reference);
		$total_amount = $this->test_input($total_amount);
		$journey_date = $this->test_input($journey_date);

		$sql = "INSERT INTO tbl_booking_info (pnr_no,trip_id,counter_id,passenger_id,reference_no,total_amount,journey_date) VALUES ('$pnr_no', '$trip_id', '$counter_id','$user_id', '$reference',$total_amount, '$journey_date')";
		$result = $this->db->insert($sql);
		return $result;
	}

	public function GetAllBookingWithUser(){
		$sql = "SELECT * FROM tbl_booking_info INNER JOIN tbl_passenger_info ON tbl_booking_info.passenger_id = tbl_passenger_info.id ORDER BY booking_id DESC";
		$result = $this->db->select($sql);
		return $result;
	}


	public function GetBookedByPnr($booking_id){
		$sql = "SELECT * FROM tbl_booking_info INNER JOIN tbl_passenger_info ON tbl_booking_info.passenger_id = tbl_passenger_info.id INNER JOIN tbl_trip_info ON tbl_booking_info.trip_id=tbl_trip_info.trip_id INNER JOIN tbl_bus_info ON tbl_trip_info.bus_id = tbl_bus_info.bus_id INNER JOIN tbl_counter_info ON tbl_booking_info.counter_id=tbl_counter_info.counter_id WHERE tbl_booking_info.booking_id = '$booking_id'";
		$result = $this->db->select($sql);
		return $result;
	}


	public function GetBookedForPrint($pnr){
		$sql = "SELECT * FROM tbl_booking_info INNER JOIN tbl_passenger_info ON tbl_booking_info.passenger_id = tbl_passenger_info.id INNER JOIN tbl_trip_info ON tbl_booking_info.trip_id=tbl_trip_info.trip_id INNER JOIN tbl_bus_info ON tbl_trip_info.bus_id = tbl_bus_info.bus_id INNER JOIN tbl_counter_info ON tbl_booking_info.counter_id=tbl_counter_info.counter_id WHERE tbl_booking_info.pnr_no = '$pnr'";
		$result = $this->db->select($sql);
		return $result;
	}



	public function CancelTkt($pnr){
		$pnr_no = $this->test_input($pnr);

		$sql = "UPDATE tbl_booked_seats,tbl_booking_info SET tbl_booked_seats.seat_status=0,tbl_booking_info.booking_status=2 WHERE tbl_booked_seats.pnr_no=tbl_booking_info.pnr_no AND tbl_booking_info.pnr_no='$pnr_no'";

		$result = $this->db->update($sql);
		if ($result) {
			$msg = "Ticket cancelled!";
			return $msg;
		}
		else{
			$msg = "<span class='error'>Filed to Updated !.</span>";
			return $msg;
		}
		
	}


	public function DeleteTkt($pnr){
		$pnr_no = $this->test_input($pnr);

		$sql = "DELETE tbl_booking_info , tbl_booked_seats  FROM tbl_booking_info  INNER JOIN tbl_booked_seats WHERE tbl_booking_info.pnr_no= tbl_booked_seats.pnr_no and tbl_booked_seats.pnr_no = '$pnr_no'";

		$result = $this->db->Delete($sql);
		if ($result) {
			$msg = "Ticket Deleted!";
			return $msg;
		}
		else{
			$msg = "<span class='error'>Filed to Updated !.</span>";
			return $msg;
		}
		
	}


	public function ApproveTkt($pnr){
		$pnr_no = $this->test_input($pnr);

		$sql = "UPDATE tbl_booked_seats,tbl_booking_info SET tbl_booked_seats.seat_status='1',tbl_booking_info.booking_status=1 WHERE tbl_booked_seats.pnr_no=tbl_booking_info.pnr_no && tbl_booking_info.pnr_no='$pnr_no'";

		$result = $this->db->update($sql);
		if ($result) {
			return true;
		}
		else{
			return false;
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