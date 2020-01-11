<?php
	require_once "libs/Session.php";
	Session::init();
	require_once "libs/Database.php";
	require_once "helpers/Format.php";
	$db = new Database();
	$fm = new Format();

	spl_autoload_register(function($class){
		require_once "classes/".$class.".php";
	});

?>

<?php
	$bus_info = new Bus_info();
 	$counter_info = new Counter_info();
 	$admin_info = new Admin_info();
 	$agent_info = new Agent_info();
 	$passenger_info = new Passenger_info();
 	$booked_seat = new Booked_seat();
 	$booking_info = new Booking_info();
 	$cancel_request = new Cancel_request();
 	$city = new City();
 	$complain = new Complain();
 	$reserved_info = new Reserved_info();
 	$trip_info = new Trip_info();
?>

<!DOCTYPE HTML>
<html>
<head>
<title> ONLINE TICKET RESERVATION SYSTEM </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
 <link href="css/truebus.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>