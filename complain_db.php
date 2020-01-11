<?php

require("db_connect/connection.php");
if(isset($_POST['c_submit'])){
	$com_nam=$_POST['com_nam'];
	$com_email=$_POST['com_email'];
	$subject=$_POST['subject'];
	$description=$_POST['description'];
	
	if(!empty($com_nam) && !empty($com_email) && !empty($subject) && !empty($description)){
		$data = array($com_nam,$com_email,$subject,$description);
		$sql = "insert into tbl_complain(com_nam,com_email,subject,description)values(?,?,?,?)";
		$stmt = $conn->prepare($sql);
		$end = $stmt->execute($data);
		if ($end) {
			 echo "Complain Saved!";
			} else {
			 echo "Complain not Saved!";
			}
	} else{
		
		echo "Fillup all the required fields!";
	}
	
}


?>