<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../libs/Database.php");
include_once ($filepath."/../helpers/Format.php");
?>

<?php
/**
* Admin_info class
*/
class Admin_info
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	/*admin login function*/
	public function AdminLogin($email,$pass){
		$email = $this->test_input($email);
		$pass = $this->test_input(md5($pass));

		if (empty($email) || empty($pass)) {
			$lgmsg = "Username or Password must not be empty !";
			return $lgmsg;
		}

		else{
			$sql = "SELECT * FROM tbl_admin_info WHERE email='{$email}' AND password='{$pass}'";
			$result = $this->db->select($sql);
			
			if($result!=false){
				
			 	$value = $result->fetch_assoc();
			 	
			 	 Session::set("admin_login",true);
			 	 Session::set("admin_role",$value['activation_status']);
			 	 Session::set("id",$value['admin_id']);
			 	 Session::set("name",$value['name']);
			 	 Session::set("email",$value['email']);
			 	 Session::set("img_url",$value['img_url']);
			 	 header('location:dashboard.php');

			 }
			 else{
			 	$lgmsg = "Username or Password not Match!";
			 	return $lgmsg;
			 }
		}
	}

	public function InsertAdmin($data,$file){
		$status = $this->test_input($data['status']);
		$admin_name = $this->test_input($data['admin_name']);
		$admin_email = $this->test_input($data['admin_email']);
		$admin_contact_no = $this->test_input($data['admin_contact']);
		$admin_address = $this->test_input($data['admin_address']);
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

		if (empty($status) || empty($admin_name) || empty($admin_email) ||empty($admin_contact_no) ||empty($admin_address) ||empty($password) || empty($file_name) ){
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
			$check_admin = "SELECT * FROM tbl_admin_info WHERE email = '$admin_email'";
			$result = $this->db->select($check_admin);

			if ($result != false) {
				$msg = "This admin email has already inserted! Try to insert other admin.";
				return $msg;
			}
			
			else{
		    	move_uploaded_file($file_temp, $uploaded_image);
				$sql = "INSERT INTO tbl_admin_info (name,email,phone_number,address,password,img_url, activation_status) VALUES('$admin_name','$admin_email','$admin_contact_no','$admin_address','$password','$uploaded_image','$status')";
		    	$inserted = $this->db->insert($sql);

		    	if ($inserted) {
		    		$msg = "Successfully admin information inserted!";
			    	return $msg;
		    	}
		    	else{
		    		$msg = "Failed to inserted!";
					return $msg;
		    	}
			}
		}
	}

	public function DeleteAdminById($delid){
		$delid = $this->test_input($delid);
		$getquery = "SELECT * from tbl_admin_info where admin_id='$delid'";

	   	$getImg = $this->db->select($getquery);
	   	if ($getImg) {
	    	while ($imgdata = $getImg->fetch_assoc()) {
		    	$delimg = $imgdata['img_url'];
		    	if(file_exists($delimg))
		    	unlink($delimg);
		    	
	    	}
	   	}

		$sql = "DELETE FROM tbl_admin_info WHERE admin_id='$delid'";
		$result = $this->db->delete($sql);
		if ($result) {
			$msg = "Successfully Deleted";
			return $msg;
		}else{
			$msg = "<span class='error'>Failed to Delete.</span>";
			return $msg;
		}

	}

	public function UpdateAdminById($data,$file, $editid){
		$edit_id = $this->test_input($editid);
		$status = $this->test_input($data['status']);
		$admin_name = $this->test_input($data['admin_name']);
		$admin_email = $this->test_input($data['admin_email']);
		$admin_contact_no = $this->test_input($data['admin_contact']);
		$admin_address = $this->test_input($data['admin_address']);
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

		if (empty($status) || empty($admin_name) || empty($admin_email) ||empty($admin_contact_no) ||empty($admin_address) ||empty($password) || empty($file_name) ){
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
			$getquery = "SELECT * from tbl_admin_info where admin_id='$edit_id'";

		   	$getImg = $this->db->select($getquery);
		   	if ($getImg) {
		    	while ($imgdata = $getImg->fetch_assoc()) {
			    	$delimg = $imgdata['img_url'];
			    	if(file_exists($delimg))
			    	unlink($delimg);
		    	}
		   	}

		   	move_uploaded_file($file_temp, $uploaded_image);
			$sql = "UPDATE tbl_admin_info SET name='$admin_name',email='$admin_email',phone_number='$admin_contact_no',address='$admin_address',password='$password', img_url='$uploaded_image', activation_status ='$status' WHERE admin_id='$edit_id' ";
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


	public function UpdateAdminByHim($data,$file, $editid){
		$edit_id = $this->test_input($editid);

		$admin_name = $this->test_input($data['admin_name']);
		$admin_email = $this->test_input($data['admin_email']);
		$admin_contact_no = $this->test_input($data['admin_contact']);
		$admin_address = $this->test_input($data['admin_address']);
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

		if ( empty($admin_name) || empty($admin_email) ||empty($admin_contact_no) ||empty($admin_address) ||empty($password) ){
			$msg = "Fields must not be empty !";
			return $msg;
		}
		else if(empty($file_name)){
			$sql = "UPDATE tbl_admin_info SET name='$admin_name',email='$admin_email',phone_number='$admin_contact_no',address='$admin_address',password='$password' WHERE admin_id='$edit_id' ";
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
			$getquery = "SELECT * from tbl_admin_info where admin_id='$edit_id'";

		   	$getImg = $this->db->select($getquery);
		   	if ($getImg) {
		    	while ($imgdata = $getImg->fetch_assoc()) {
			    	$delimg = $imgdata['img_url'];
			    	if(file_exists($delimg))
			    	unlink($delimg);
		    	}
		   	}

		   	move_uploaded_file($file_temp, $uploaded_image);
			$sql = "UPDATE tbl_admin_info SET name='$admin_name',email='$admin_email',phone_number='$admin_contact_no',address='$admin_address',password='$password', img_url='$uploaded_image' WHERE admin_id='$edit_id' ";
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



	public function GetAdminById($admin_id){
		$sql = "SELECT * from tbl_admin_info WHERE admin_id='$admin_id'";
		$result = $this->db->select($sql);
		return $result;
	}

	public function GetAllAdmin(){
		$sql = "SELECT * from tbl_admin_info ORDER by admin_id ASC";
		$result = $this->db->select($sql);
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