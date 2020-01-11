<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../libs/Database.php");
include_once ($filepath."/../helpers/Format.php");
?>

<?php
/**
* Counter_info class
*/
class Agent_info
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	/*public function GetTripAndAgentInfo($agent_id,$trip_id){
		$sql = "SELECT * from tbl_agent_info INNER JOIN tbl_trip_info ON tbl_agent_info.agent_id = tbl_trip_info.agent_id WHERE tbl_trip_info.agent_id = '$agent_id' AND tbl_trip_info.trip_id='$trip_id'";

		$result = $this->db->select($sql);
		return $result;
	}*/

	/*agent login process*/
	public function AgentLogin($email,$pass){
		$email = $this->test_input($email);
		$pass = $this->test_input(md5($pass));

		if (empty($email) || empty($pass)) {
			$lgmsg = "Username or Password must not be empty !";
			return $lgmsg;
		}

		else{
			$sql = "SELECT * FROM tbl_agent_info WHERE email='{$email}' AND password='{$pass}'";
			$result = $this->db->select($sql);

			if($result!=false){
				$value = $result->fetch_assoc();
				if($value['active_status']==1){

				 	 Session::set("agent_login",true);
				 	 Session::set("id",$value['agent_id']);
				 	 Session::set("name",$value['name']);
				 	 Session::set("email",$value['email']);
				 	 Session::set("img_url",$value['img_url']);
				 	 header('location:dashboard.php');
			 	}
				 elseif ($value['active_status']==0){
				 	$lgmsg = "Sorry! Your account has been temporarily blocked.";
				 	return $lgmsg;
				}
			}
			else{
				$lgmsg = "Username or Password not Match!";
			 	return $lgmsg;
			}
		}
	}

	public function InsertAgent($data,$file){
		$counter_id = $this->test_input($data['counter_id']);
		$agent_name = $this->test_input($data['agent_name']);
		$agent_email = $this->test_input($data['agent_email']);
		$agent_contact_no = $this->test_input($data['agent_contact_no']);
		$agent_address = $this->test_input($data['agent_address']);
		$password = $this->test_input(md5($data['password']));

		/*for img with validation*/
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "agent_img/".$unique_image;
	    /*end*/

		if (empty($counter_id) || empty($agent_name) || empty($agent_email) ||empty($agent_contact_no) ||empty($agent_address) ||empty($password) || empty($file_name) ){
			$msg = "Fields must not be empty !";
			return $msg;
		}
		elseif ($file_size >1048576 || $file_size ==0) {
			$msg =  "<span class='error'>Image Size should be less then 1MB!</span>";
			return $msg;
		}
		elseif (in_array($file_ext, $permited) === false) {
			$msg = "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
			return $msg;
		}

		else{
			$check_agent = "SELECT * FROM tbl_agent_info WHERE email = '$agent_email'";
			$result = $this->db->select($check_agent);

			if ($result != false) {
				$msg = "This agent email has already inserted! Try to insert other agent.";
				return $msg;
			}
			
			else{
		    	move_uploaded_file($file_temp, $uploaded_image);
				$sql = "INSERT INTO tbl_agent_info (counter_id,name,email,phone_number,address,password,img_url) VALUES('$counter_id','$agent_name','$agent_email','$agent_contact_no','$agent_address','$password','$uploaded_image')";
		    	$inserted = $this->db->insert($sql);

		    	if ($inserted) {
		    		$msg = "Successfully agent information inserted!";
			    	return $msg;
		    	}
		    	else{
		    		$msg = "Failed to inserted!";
					return $msg;
		    	}
			}
		}
	}

	public function DeleteAgentById($delid){
		$delid = $this->test_input($delid);
		$getquery = "SELECT * from tbl_agent_info where agent_id='$delid'";

	   	$getImg = $this->db->select($getquery);
	   	if ($getImg) {
	    	while ($imgdata = $getImg->fetch_assoc()) {
		    	$delimg = $imgdata['img_url'];
		    	if(file_exists($delimg))
		    	unlink($delimg);
		    	
	    	}
	   	}

		$sql = "DELETE FROM tbl_agent_info WHERE agent_id='$delid'";
		$result = $this->db->delete($sql);
		if ($result) {
			$msg = "Successfully Deleted";
			return $msg;
		}else{
			$msg = "<span class='error'>Failed to Delete.</span>";
			return $msg;
		}

	}

	public function UpdateAgentById($data,$file, $editid){
		$edit_id = $this->test_input($editid);
		$counter_id = $this->test_input($data['counter_id']);
		$agent_name = $this->test_input($data['agent_name']);
		$agent_email = $this->test_input($data['agent_email']);
		$agent_contact_no = $this->test_input($data['agent_contact']);
		$agent_address = $this->test_input($data['agent_address']);
		$password = $this->test_input(md5($data['password']));

		/*for img with validation*/
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "agent_img/".$unique_image;
	    /*end*/

		if (empty($counter_id) || empty($agent_name) || empty($agent_email) ||empty($agent_contact_no) ||empty($agent_address) ||empty($password) || empty($file_name) ){
			$msg = "Fields must not be empty !";
			return $msg;
		}
		elseif ($file_size >1048576 || $file_size ==0) {
			$msg =  "<span class='error'>Image Size should be less then 1MB!</span>";
			return $msg;
		}
		elseif (in_array($file_ext, $permited) === false) {
			$msg = "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
			return $msg;
		}


		else{
			$getquery = "SELECT * from tbl_agent_info where agent_id='$edit_id'";

		   	$getImg = $this->db->select($getquery);
		   	if ($getImg) {
		    	while ($imgdata = $getImg->fetch_assoc()) {
			    	$delimg = $imgdata['img_url'];
			    	if(file_exists($delimg))
			    	unlink($delimg);
		    	}
		   	}

		   	move_uploaded_file($file_temp, $uploaded_image);
			$sql = "UPDATE tbl_agent_info SET counter_id = '$counter_id', name='$agent_name',email='$agent_email',phone_number='$agent_contact_no',address='$agent_address',password='$password', img_url='$uploaded_image' WHERE agent_id='$edit_id' ";
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

	public function UpdateAgentByHim($data,$file, $editid){
		$edit_id = $this->test_input($editid);
		$agent_name = $this->test_input($data['agent_name']);
		$agent_email = $this->test_input($data['agent_email']);
		$agent_contact_no = $this->test_input($data['agent_contact']);
		$agent_address = $this->test_input($data['agent_address']);
		$password = $this->test_input(md5($data['password']));

		/*for img with validation*/
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "agent_img/".$unique_image;
	    /*end*/

		if ( empty($agent_name) || empty($agent_email) ||empty($agent_contact_no) ||empty($agent_address) ||empty($password)){
			$msg = "Fields must not be empty !";
			return $msg;
		}

		else if(empty($file_name)){

			$sql = "UPDATE tbl_agent_info SET name='$agent_name',email='$agent_email',phone_number='$agent_contact_no',address='$agent_address',password='$password' WHERE agent_id='$edit_id' ";
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

		elseif ($file_size >1048576 || $file_size ==0) {
			$msg =  "<span class='error'>Image Size should be less then 1MB!</span>";
			return $msg;
		}
		elseif (in_array($file_ext, $permited) === false) {
			$msg = "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
			return $msg;
		}

		else{
			$getquery = "SELECT * from tbl_agent_info where agent_id='$edit_id'";

		   	$getImg = $this->db->select($getquery);
		   	if ($getImg) {
		    	while ($imgdata = $getImg->fetch_assoc()) {
			    	$delimg = $imgdata['img_url'];
			    	if(file_exists($delimg))
			    	unlink($delimg);
		    	}
		   	}

		   	move_uploaded_file($file_temp, $uploaded_image);
			$sql = "UPDATE tbl_agent_info SET name='$agent_name',email='$agent_email',phone_number='$agent_contact_no',address='$agent_address',password='$password', img_url='$uploaded_image' WHERE agent_id='$edit_id' ";
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


	public function GetAgentById($agent_id){
		$sql = "SELECT * from tbl_agent_info WHERE agent_id='$agent_id'";
		$result = $this->db->select($sql);
		return $result;
	}


	public function GetAllAgentAndCounter()
	{
		$sql = "SELECT * FROM tbl_agent_info INNER JOIN tbl_counter_info ON tbl_agent_info.counter_id = tbl_counter_info.counter_id ORDER BY agent_id ASC";
		$result = $this->db->select($sql);
		return $result;
	}

	public function ChangeStatus($value,$edit_id){

		$sql = "UPDATE tbl_agent_info SET active_status = '$value' WHERE agent_id='$edit_id' ";
		$result = $this->db->update($sql);
		if ($result) {
			if($value="1")
				$msg = "Successfully UnBlocked!";
			else
				$msg = "Successfully Blocked!";
			return $msg;
		}
		else{
			$msg = "<span class='error'>Filed to Updated !.</span>";
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