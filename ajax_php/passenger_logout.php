<?php
require_once ("../classes/Passenger_info.php");
?>

<?php
	$passenger_info = new Passenger_info();
    $logout = $passenger_info->PassengerLogOut();
    echo $logout;
?>
