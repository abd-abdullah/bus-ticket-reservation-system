<?php
require("db_connect_for_pdf/connection.php");
session_start(); 	
require('../fpdf/fpdf.php');

$from_date = $_SESSION['fd']=$_GET['fd'];
$to_date =$_SESSION['td']=$_GET['td'];



class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    //$this->Image('agent_img/logo.jpg',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Title
    $this->Cell(276,5,'Ticket Sales Report',0,0,'C');
    // Line break
    $this->Ln();
	$this->SetFont('Arial','',12);
	$this->Cell(276,10,"From ".date('F j, Y', strtotime($_SESSION['fd']))." To ".date('F j, Y', strtotime($_SESSION['td'])),0,0,'C');
	$this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
function headerTable(){
	$this->SetFont('Times','B',12);
	$this->Cell(13,10,'Sl.',1,0,'C');
	$this->Cell(38,10,'Passenger Name',1,0,'C');
	$this->Cell(20,10,'PNR No',1,0,'C');
	$this->Cell(40,10,'Counter Name',1,0,'C');
	$this->Cell(24,10,'Bus Type',1,0,'C');
	$this->Cell(25,10,'Seat No(s)',1,0,'C');
	$this->Cell(25,10,'Contact No',1,0,'C');
	$this->Cell(37,10,'Booking Date',1,0,'C');
	$this->Cell(35,10,'Journey',1,0,'C');
	$this->Cell(21,10,'Total Price',1,0,'C');
    $this->Ln();
}

function viewTable($conn){
	$from_date = $_SESSION['fd'];
	$to_date = $_SESSION['td'];

	$this->SetFont('Times','',11);
	$sql = $conn->prepare("SELECT * FROM tbl_booking_info INNER JOIN tbl_passenger_info ON tbl_booking_info.passenger_id = tbl_passenger_info.id INNER JOIN tbl_trip_info ON tbl_booking_info.trip_id=tbl_trip_info.trip_id INNER JOIN tbl_bus_info ON tbl_trip_info.bus_id = tbl_bus_info.bus_id INNER JOIN tbl_counter_info ON tbl_booking_info.counter_id=tbl_counter_info.counter_id WHERE tbl_booking_info.booking_status=1 AND Date(tbl_booking_info.booking_date) BETWEEN '$from_date' AND '$to_date' ORDER BY `booking_id` DESC");
    $sql->execute();
    $data = $sql->fetchAll();
	$j=1;
	$total = 0;

	foreach($data as $value)
	{ 
	
	$trip_id = $value['trip_id'];
	$pnr_no = $value['pnr_no'];
	$sqlseat = $conn->prepare("SELECT COUNT(`seat_no`) FROM `tbl_booked_seats` WHERE `trip_id`='$trip_id' AND pnr_no='$pnr_no'");
	$sqlseat->execute();
	$dataseat = $sqlseat->fetch(PDO::FETCH_ASSOC);
	
	$sqll = $conn->prepare("SELECT * FROM tbl_booked_seats WHERE trip_id='$trip_id' AND pnr_no='$pnr_no'");
	$sqll->execute();
	$dataa= $sqll->fetchAll();
	$booked_seats = array();
	for ($i=0; $i<count($dataa); $i++) {
		if($dataa[$i]['seat_status'] == 1) {
			array_push($booked_seats, $dataa[$i]['seat_no']);
			}
	}
	
	$total_single = $value['fare']*$dataseat['COUNT(`seat_no`)'];
	$total+=$total_single;
	$booked_seat= implode(',', $booked_seats);
		
	$this->Cell(13,10,$j,1,0,'L');
	$this->Cell(38,10,$value['name'],1,0,'L');
	$this->Cell(20,10,$value['pnr_no'],1,0,'L');
	$this->Cell(40,10,$value['mobile'],1,0,'L');
	$this->Cell(24,10,$value['bus_type'],1,0,'L');
	$this->Cell(25,10,$booked_seat,1,0,'L');
	$this->Cell(25,10,$value['mobile'],1,0,'L');
	$this->Cell(37,10,$value['booking_date'],1,0,'L');
	$this->Cell(35,10,$value['from_city'].'-'.$value['to_city'],1,0,'L');
	$this->Cell(21,10,$total_single."/=",1,0,'L');
    $this->Ln();
	$j++;
	}


	$this->Cell(222,10);
	$this->Cell(35,10,"Total =",1,0,'L');
	$this->Cell(21,10,$total.'/=',1,0,'L');
    $this->Ln(); 

    if($j==1){
		$this->Cell(120,10);
		$this->Cell(35,10,"No Data Found",1,0,'L');
	}
}

}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf-> headerTable();
$pdf-> viewTable($conn);
//$pdf->SetFont('Times','',12);
//for($i=1;$i<=40;$i++)
  //  $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();
?>
