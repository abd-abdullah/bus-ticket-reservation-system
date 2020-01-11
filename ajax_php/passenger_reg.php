<?php
require_once ("../classes/Passenger_info.php");
?>

<?php
	if(!empty($_POST)){
		$passenger_info = new Passenger_info();
	    $passenger_insert = $passenger_info->PassengerReg($_POST);
	    echo $passenger_insert;
	}
?>
