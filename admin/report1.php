<?php
require_once ("../classes/Booking_info.php");
require_once ("../classes/Booked_seat.php");

session_start(); 	
require('../fpdf/fpdf.php');
?>


<?php
	$from_date = $_SESSION['fd']=$_GET['fd'];
	$to_date =$_SESSION['td']=$_GET['td'];

?>

<?php



class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('agent_img/logo.jpg',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Title
    $this->Cell(276,5,'Ticket Sales Report',0,0,'C');
    // Line break
    $this->Ln();
	$this->SetFont('Arial','',12);
	$this->Cell(276,10,$_SESSION['fd']."-->".$_SESSION['td'],0,0,'C');
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

function viewTable(){
	$this->SetFont('Times','',11);
	$booking_info = new Booking_info();
$booked_seat = new Booked_seat();

/*	$id= $_SESSION['agent_id'];
	$sql = $conn->prepare("SELECT * FROM tbl_trip_info,tbl_booking_info,tbl_counter_info,tbl_bus_info WHERE tbl_trip_info.trip_id=tbl_booking_info.trip_id AND tbl_bus_info.bus_id=tbl_trip_info.bus_id AND tbl_booking_info.counter_id=tbl_counter_info.counter_id AND tbl_booking_info.booking_status='approved' AND tbl_trip_info.agent_id='$id' ORDER BY `booking_id` DESC");
    $sql->execute();
    $data = $sql->fetchAll();
	$j=1;*/
	$sold_tkt = $booked_seat->GetAllSoldTkt($_SESSION['fd'],$_SESSION['td']);
	$sold_tkt = mysqli_fetch_all($sold_tkt,MYSQLI_ASSOC);
	if($sold_tkt){
	foreach($sold_tkt as $value)
	{ 
	
	/*$trip_id = $value['trip_id'];
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
	
	$booked_seat= implode(',', $booked_seats);*/
		
	$this->Cell(13,10,'2',1,0,'L');
	$this->Cell(38,10,$value['name'],1,0,'L');
	$this->Cell(20,10,$value['pnr_no'],1,0,'L');
	$this->Cell(40,10,$value['counter_name'],1,0,'L');
	$this->Cell(24,10,$value['bus_type'],1,0,'L');
	$this->Cell(25,10,$booked_seat,1,0,'L');
	$this->Cell(25,10,$value['mobile'],1,0,'L');
	$this->Cell(37,10,$value['booking_date'],1,0,'L');
	$this->Cell(35,10,$value['from_city'].'-'.$value['to_city'],1,0,'L');
	$this->Cell(21,10,$value['fare']*$dataseat['COUNT(`seat_no`)'].'/=',1,0,'L');
    $this->Ln();
	}
} }


}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf-> headerTable();
$pdf-> viewTable();
//$pdf->SetFont('Times','',12);
//for($i=1;$i<=40;$i++)
  //  $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();

?>


