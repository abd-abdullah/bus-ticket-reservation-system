<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../libs/Session.php");
Session::init();
include_once ($filepath."/../libs/Database.php");
include_once ($filepath."/../helpers/Format.php");
?>

<?php
/**
* Passenger_info class
*/
class Passenger_info
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function PassengerReg($data){
		$name = $this->test_input($data['name']);
		$address = $this->test_input($data['address']);
		$email = $this->test_input($data['email']);
		$phone = $this->test_input($data['mob']);
	    $pass = $this->test_input(md5($data['password']));

	    //check empty value
	    if (empty($name) or empty($email) or empty($address) or empty($phone) or empty($pass))
		{
			$msg = "Fields must not be empty !";
			return $msg;
		}
		
		else{
			$ckemail = "SELECT * FROM tbl_passenger_info WHERE email='$email'";
			$result = $this->db->select($ckemail);
			if ($result != false) {
				$msg = "This email already registered !";
				return $msg;
			}else{
				 $sql = "INSERT INTO tbl_passenger_info(name,address,email,mobile,password) VALUES('$name','$address','$email','$phone','$pass')";
			    $inserted = $this->db->insert($sql);
			    if ($inserted) {
			    	$msg = "Registration successfully Login to continue!";
				    return $msg;
			    }else{
			    	$msg = "Registration failed !";
					return $msg;
			    }
			}
		}
		
	}

	//validation
	public function test_input($data){
		$data =trim($data);
		$data =stripslashes($data);
		$data =htmlspecialchars($data);
		$data = $this->fm->validation($data);
		$data = mysqli_real_escape_string($this->db->link, $data);


		return $data;
	}

	public function PassengerLogin($data){
		$email = $this->test_input($data['email']);
		$pass = $this->test_input(md5($data['password']));

		if (empty($email) || empty($pass)) {
			$lgmsg = "Username or Password must not be empty !";
			return $lgmsg;
		}

		else{
			$sql = "SELECT * FROM tbl_passenger_info WHERE email='{$email}' AND password='{$pass}'";
			$result = $this->db->select($sql);
			
			if($result!=false){
				
			 	$value = $result->fetch_assoc();
			 	
			 	 Session::set("passenger_login",true);
			 	 Session::set("passenger_id",$value['id']);
			 	 Session::set("passenger_name",$value['name']);
			 	 Session::set("passenger_email",$value['email']);
			 	 Session::set("passenger_phone",$value['mobile']);
			 	 Session::set("passenger_address",$value['address']);
			 	 return true;
			 }
			 else{
			 	$lgmsg = "Username or Password not Match!";
			 	return $lgmsg;
			 }
		}
	}

	public function PassengerLogOut(){
		Session::UnsetKey("passenger_login");
		Session::UnsetKey("passenger_id");
		Session::UnsetKey("passenger_name");
		Session::UnsetKey("passenger_email");
		Session::UnsetKey("passenger_phone");
		Session::UnsetKey("passenger_address");
		return true;
	}


	public function GetAllCity(){
		$sql = "SELECT DISTINCT city_name FROM tbl_cities ORDER BY city_name ASC";
		$result = $this->db->select($sql);
		return $result;
	}

}

?>