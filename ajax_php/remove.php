<?php
require_once ("../classes/Reserved_info.php");
$reserved_info = new Reserved_info();
?>

<?php
	if(isset($_POST["trip_id"])){

	$delete = $reserved_info->DeleteAllSelectedSeats($_POST);
	echo $delete;
}

?>
