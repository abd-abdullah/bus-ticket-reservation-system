<?php
require_once ("../classes/Passenger_info.php");
?>

<?php
	if(!empty($_POST)){
		$passenger_info = new Passenger_info();
	    $login = $passenger_info->PassengerLogin($_POST);
	    echo $login;
	}
?>
