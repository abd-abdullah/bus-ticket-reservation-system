<?php
require_once ("../classes/Reserved_info.php");
$reserved_info = new Reserved_info();
?>

<?php
	if(isset($_POST["seat"])){

		$check = ($_POST["chk"]);

		if($check==1){
			$reserve = $reserved_info->InsertSeat($_POST);
	    	echo $reserve;
	    }
	    
	    else{
	    	$delete = $reserved_info->DeleteSeat($_POST);
	    	echo $delete;
	    }
	}
?>
