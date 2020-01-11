<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../libs/Database.php");
include_once ($filepath."/../helpers/Format.php");
?>

<?php
/**
* index class
*/
class Bus_info
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function GetBusById($bus_id){
		$sql = "SELECT * from tbl_bus_info WHERE bus_id='$bus_id'";
		$result = $this->db->select($sql);
		return $result;
	}

	public function GetAllBuses(){
		$sql = "SELECT COUNT(*) AS total FROM tbl_bus_info";

		$result = $this->db->select($sql);
		return $result;
	}

	public function InsertBus($data,$file){
		$bus_no = $this->test_input($data['bus_no']);
		$bus_type = $this->test_input($data['bus_type']);

		/*for img with validation*/
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "img/".$unique_image;
	    /*end*/

		if (empty($bus_no) || empty($bus_type) || empty($file_name) ){
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
			$check_bus = "SELECT * FROM tbl_bus_info WHERE bus_no = '$bus_no'";
			$result = $this->db->select($check_bus);

			if ($result != false) {
				$msg = "This Bus has already inserted! Try to insert other Bus.";
				return $msg;
			}
			
			else{
		    	move_uploaded_file($file_temp, $uploaded_image);
				$sql = "INSERT INTO tbl_bus_info (bus_no,bus_type,img_bus) VALUES('$bus_no','$bus_type','$uploaded_image')";
		    	$inserted = $this->db->insert($sql);

		    	if ($inserted) {
		    		$msg = "Successfully Bus information inserted!";
			    	return $msg;
		    	}
		    	else{
		    		$msg = "Failed to inserted!";
					return $msg;
		    	}
			}
		}
	}

	public function GetAllBus(){
		$sql = "SELECT * FROM tbl_bus_info ORDER BY bus_id ASC";
		$result = $this->db->select($sql);
		return $result;
	}

	public function DeleteBusById($delid){
		$delid = $this->test_input($delid);
		$getquery = "SELECT * from tbl_bus_info where bus_id='$delid'";

	   	$getImg = $this->db->select($getquery);
	   	if ($getImg) {
	    	while ($imgdata = $getImg->fetch_assoc()) {
		    	$delimg = $imgdata['img_bus'];
		    	if(file_exists($delimg))
		    	unlink($delimg);
	    	}
	   	}

		$sql = "DELETE FROM tbl_bus_info WHERE bus_id='$delid'";
		$result = $this->db->delete($sql);
		if ($result) {
			$msg = "Successfully Deleted";
			return $msg;
		}else{
			$msg = "<span class='error'>Failed to Delete.</span>";
			return $msg;
		}

	}

	public function UpdateBusById($data,$file, $editid){
		$bus_no = $this->test_input($data['bus_no']);
		$bus_type = $this->test_input($data['bus_type']);
		$edit_id = $this->test_input($editid);

		/*for img with validation*/
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "img/".$unique_image;
	    /*end*/

		if (empty($bus_no) || empty($bus_type) || empty($file_name) ){
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
			$getquery = "SELECT * from tbl_bus_info where bus_id='$edit_id'";

		   	$getImg = $this->db->select($getquery);
		   	if ($getImg) {
		    	while ($imgdata = $getImg->fetch_assoc()) {
			    	$delimg = $imgdata['img_bus'];
			    	if(file_exists($delimg))
			    	unlink($delimg);
		    	}
		   	}

		   	move_uploaded_file($file_temp, $uploaded_image);
			$sql = "UPDATE tbl_bus_info SET bus_no = '$bus_no', bus_type='$bus_type', img_bus='$uploaded_image' WHERE bus_id='$edit_id' ";
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