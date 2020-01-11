<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../libs/Database.php");
include_once ($filepath."/../helpers/Format.php");
?>

<?php
/**
* Counter_info class
*/
class Cancel_request
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


	public function Cancel_Request($data){
		$pnr_no = $this->test_input($data['pnr_no']);
		$counter_id = $this->test_input($data['counter_id']);
		$bkash_no = $this->test_input($data['bkash_no']);

		if (empty($pnr_no) || empty($counter_id) || empty($bkash_no)  )
		{
			$msg = "Fields must not be empty !";
			return $msg;
		}

		else{
			$Check_cancel = "SELECT * FROM tbl_cancel_request WHERE pnr_no='$pnr_no'";
			$result = $this->db->select($Check_cancel);

			if ($result != false) {
				$msg = "Your have alraedy resquest for cancel. Wait for approval. or contact with us! ";
				return $msg;
			}
			
			else{
				$sql = "INSERT INTO tbl_cancel_request(pnr_no,counter_id,bkash_no) VALUES('$pnr_no','$counter_id','$bkash_no')";
			    $inserted = $this->db->insert($sql);

			    if ($inserted) {
			    	$msg = "Your Cancel_Request is succesfully donw. Wait for confirmation";
				    return $msg;
			    }else{
			    	$msg = "Failed to cancel! contact menually";
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