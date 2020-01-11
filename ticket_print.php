
<?php
require('fpdf/fpdf.php');
require_once ("classes/Booking_info.php");
require_once ("classes/Booked_seat.php");
$booking_info = new Booking_info();
$booked_seat = new Booked_seat();
?>

<?php
if(isset($_POST['btn_print'])){
    $pnr_no= $_POST['pnr_no'];
    //$passenger_contact= $_POST['passenger_contact'];
	}
	
	$booked_information = $booking_info->GetBookedForPrint($pnr_no);

	if($booked_information){
	$data = $booked_information->fetch_assoc();
	
	
	$seats = $booked_seat->BookedSeatsForPrint($pnr_no);
	$seat_no = array();
	if($seats){
		$value = mysqli_fetch_all($seats,MYSQLI_ASSOC);
		
		for ($i=0; $i<count($value); $i++) {
			array_push($seat_no, $value[$i]['seat_no']);
		}
	}

			
	$booked_seat= implode(',', $seat_no);	
  	$total_price=$data['fare']*count($seat_no); 
	//"<pre>";print_r($booked_seat);
		
if ($data['booking_status'] == 1)
 {
$pdf= new FPDF('P', 'mm', 'A4');

$pdf->AddPage();
//$this->Image('agent/agent_img/logo.jpg',10,6,30);
$pdf-> Cell(65);
$pdf->SetFont('Arial','B','20');
$pdf->Write(8,'Online Bus Ticket');
$pdf->Ln();
$pdf->SetFont('Arial','',12,1);
$pdf-> Cell(75);
$pdf->Write(7,$data['bus_no']);
$pdf->Write(5, '______________________________________________________________________________');
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B','16');
$pdf->Cell(185,15,'Journey Details',1,1);
$pdf->SetFont('Arial','','12');
$pdf->Cell(65,10,'PNR No:',1,0);
$pdf->SetFont('Arial','','12');
$pdf->Cell(120,10,$data['pnr_no'],1,1);
$pdf->Cell(65,10,'Bus Name:',1,0);
$pdf->Cell(120,10,$data['bus_no'],1,1);
$pdf->Cell(65,10,'Bus Type:',1,0);
$pdf->Cell(120,10,$data['bus_type'],1,1);
$pdf->Cell(65,10,'Journey Date:',1,0);
$pdf->Cell(120,10,$data['journey_date'],1,1);
$pdf->Cell(65,10,'Departure From:',1,0);
$pdf->Cell(120,10,$data['from_city'].' at '.date('h:i A', strtotime($data['departure_time'])),1,1);
$pdf->Cell(65,10,'Arrival To:',1,0);
$pdf->Cell(120,10,$data['to_city'].' at '.date('h:i A', strtotime($data['arrival_time'])),1,1);
$pdf->Cell(65,10,'Seat No(s):',1,0);
$pdf->Cell(120,10,$booked_seat,1,1);

$pdf->Ln();
$pdf->SetFont('Arial','B','16');
$pdf->Cell(185,15,'Passenger and Booking Details',1,1);
$pdf->SetFont('Arial','','12');
$pdf->Cell(65,10,'Passenger Name:',1,0);
$pdf->Cell(120,10,$data['name'],1,1);
$pdf->Cell(65,10,'Contact No:',1,0);
$pdf->Cell(120,10,$data['mobile'],1,1);
$pdf->Cell(65,10,'Ticket Price:',1,0);
$pdf->Cell(120,10,$data['fare'].' BDT',1,1);
$pdf->Cell(65,10,'Booking Total:',1,0);
$pdf->Cell(120,10,$total_price.' BDT',1,1);

$pdf-> Cell(0);
$pdf->SetFont('Arial','B','12');
$pdf->Write(8,'Notes:');
$pdf->SetFont('Times','',8,1);
$pdf->Write(5, '__________________________________________________________________________________________________________________________________');
$pdf->Ln();
$pdf->SetFont('Times','',11,1);
$pdf->Cell(65,5,'* Seats booked under this ticket are not transferable.',0,1);
$pdf->Cell(65,5,'* This ticket is valid only for the seat number and bus service specified herein.',0,1);
$pdf->Cell(65,5,'* This ticket should be carried during the journey by the passenger whose name is mentioned above.',0,1);
$pdf->Cell(65,5,'* Please keep the ticket safely till the end of the journey.',0,1);
$pdf->Cell(65,5,'* Please show the ticket at the time of checking.',0,1);
$pdf->Cell(65,5,'* Corporation reserves the rights to change/cancel the class of service.',0,1);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf-> Cell(50);
$pdf->SetFont('Arial','B','12');
$pdf->Write(8,'Thank you for choosing our service!');
	
$pdf->Output();

} 

elseif($data['booking_status'] == 2){
	
	echo "Your Booking was cancelled. ";
	
?>
	<a href="index.php">Back to Home</a>
<?php
  }

elseif($data['booking_status'] == 0){
	
	echo "Your Booking request is still pending. ";
?>
  <a href="index.php">Back to Home</a>
  
<?php

}


else {
	echo "Sorry! Ticket Not Found.";
	?>
	<a href="index.php">Back to Home</a>
	
<?php
}
}
else{
	echo "Sorry! Ticket Not Found.";
?>
	<a href="index.php">Back to Home</a>

<?php }
?>