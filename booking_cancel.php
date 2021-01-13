<?php
require("admin/db_connect_for_pdf/connection.php");


		$pnr_no= $_POST['pnr_no'];
		//$passenger_contact= $_POST['passenger_contact'];
		
		$sql = $conn->prepare("SELECT * FROM tbl_booking_info,tbl_passenger_info, tbl_trip_info, tbl_booked_seats,tbl_counter_info,tbl_bus_info WHERE tbl_booking_info.passenger_id = tbl_passenger_info.id AND tbl_booking_info.trip_id=tbl_trip_info.trip_id AND tbl_booking_info.pnr_no=tbl_booked_seats.pnr_no AND tbl_booking_info.counter_id=tbl_counter_info.counter_id AND tbl_booking_info.pnr_no='$pnr_no'");
		$sql->execute();		
		$data = $sql->fetch(PDO::FETCH_ASSOC);	
	   //echo "<pre>";print_r($data);exit;
		
		$sqll = $conn->prepare("SELECT tbl_booked_seats.seat_no FROM tbl_booking_info,tbl_booked_seats WHERE tbl_booking_info.pnr_no=tbl_booked_seats.pnr_no AND tbl_booked_seats.pnr_no='$pnr_no'");
		$sqll->execute();
		$dataa= $sqll->fetchAll();

		$booked_seats = array();
		for ($i=0; $i<count($dataa); $i++) {
				array_push($booked_seats, $dataa[$i]['seat_no']);
			
		}				

		$bookedseat= implode(',', $booked_seats);

?>

<script type="text/javascript">
		  function confirmation() {
		  return confirm('Are you sure you want to cancel your booking?');
			}
</script>

<?php include"inc/header.php";?>
</head>
<?php include("inc/header_bottom.php"); ?>

<!--- /footer-btm ---->
<!--- banner-1 ---->
<div height="50px">
	<?php if(isset($msg)) echo $msg; ?>
</div>
<!--- /banner-1 ---->
<div class="agent">

<div class="bus-btm">

	<div class="container">
	<?php
		if ($data['booking_status'] == 1)
	   {

	?>

          <div class="col-md-12">

			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
			<div class="panel-heading" style="background-color:green; height: 60px;"><h4 style="font-size:30px;color:white; text-align: center;">Your Booking Details</h4></div>
	
		
			
                        <tr>
                            <th>Passenger Name:</th>
                            <td><?php echo  $data['name']; ?></td>
							 <th>Address:</th>
                            <td><?php echo  $data['address']; ?></td> 
                      
                        </tr>
						
                        <tr>
                            <th>Contact No:</th>
                            <td><?php echo  $data['mobile']; ?></td>
						   <th>Email:</th>
						   <td><?php echo  $data['email']; ?></td> 							
                        </tr> 					

                         <tr>
                            <th>PNR No:</th>
                            <td><?php echo  $data['pnr_no']; ?></td>
							<th>Booking Date:</th>
                            <td><?php echo  $data['booking_date']; ?></td>
                      
                        </tr>                        
						
						<tr>
                            <th>Reference No:</th>
                            <td><?php echo  $data['reference_no']; ?></td>
							<th>Journey Date:</th>
                            <td><?php echo  $data['date']; ?></td>
                      
                        </tr>	

						<tr>
						
							<th>From City:</th>
                            <td><?php echo  $data['from_city']; ?></td>
							<th>To City:</th>
                            <td><?php echo  $data['to_city']; ?></td>

                        </tr>						
						
						<tr>
							<th>Bus Type:</th>
                            <td><?php echo  $data['bus_type']; ?></td>
							<th>Boarding Point:</th>
                            <td><?php echo  $data['counter_name']; ?></td>                      
                        </tr>

						<tr>
							<th>Seat No(s):</th>
                            <td><?php echo $bookedseat;  ?></td>
							<th>Starting Time:</th>
                            <td><?php echo date('h:i A', strtotime($data['departure_time'])); ?> </td>
                      
                        </tr>						
						
						<tr>
							<th>Total Amount Paid:</th>
                            <td>৳. <?php echo $total = $data['fare']*count($dataa);?> </td>
							<th>ticket price:</th>
                            <td>৳. <?php echo $data['fare'];?></td>
                      
                        </tr>	

						<tr>
							<th>Total Amount Refundable:</th>

							<?php 
							$journey_date = $data['journey_date'];
							$journey_time = $data['departure_time'];
								$journey_date_time = date('Y-m-d H:i:s', strtotime("$journey_date $journey_time"));

								$start = $journey_date_time;
								$end = date('Y-m-d H:i:s');
								$ts1 = strtotime($start);
								$ts2 = strtotime($end);     
								$seconds_diff = $ts1 - $ts2;                            
								$time = ($seconds_diff/3600);

														              
							if($time >=48){
							 	$refund = $total*0.80;
							 }
							 else if($time >=2){
							 	$refund = $total*0.60;
							 }

							 else if($time>=0.25){
							 	$refund = $total*0.50;
							 }
							 else{
							 	$refund = 0;
							 }

							 ?>
							
                            <td>৳. <?php echo $refund; ?></td>

							<th>Current Booking Status:</th>


                            <td><?php if ( $data['booking_status'] == 0){echo "pending";} elseif( $data['booking_status'] == 1){echo "approved";} elseif( $data['booking_status'] == 2){echo "cancelled";}?></td>
							
                        </tr>							
						
				
						
                </table>
				


				<?php 
					if(isset($_POST['cancel'])){
						$cancel_insert = $cancel_request->cancelRequest($_POST);
						
						$msg = $cancel_insert;
				
						echo '<script>alert("'.$msg.'");</script>';
					}
				 ?>

				<form class="form-inline"  method="post" action="">
				
				<?php 
					if($time >=48){
				?>
					<p style="font-weight: bolder; color:#001a00"> You have <?php echo round($time,2); ?> Hours left.<you></you>You will get 80% refund. Total = <?php echo $refund;?></p><br />

				<?php
					}
					else if($time>=2){
				 ?>

				 <p style="font-weight: bolder; color:#001a00"> You have <?php echo round($time,2); ?> Hours left.<you></you>You will get 60% refund. Total = <?php echo $refund;?></p><br />

				 <?php
					}
					else if($time>=0.25){
				 ?>

				 <p style="font-weight: bolder; color:#001a00"> You have <?php echo round($time,2); ?> Hours left.<you></you>You will get 50% refund. Total = <?php echo $refund;?></p><br />

				  <?php
					}
					else{
				 ?>

				 <p style="font-weight: bolder; color:#001a00"> You have <?php echo round($time,2); ?> Hours left.<you></you>So you cannot cancel this ticket. Read the policy! </p><br />
				 <?php } ?>

				
				<?php if($time>0.25){ ?>
				<h3>Enter bKash No:</h3>

				<p style="font-weight: bolder; color:#001a00"> Enter your bKash account number through which <you></you> want to get refund. </p>  

				<input type="hidden" name="pnr_no" value="<?php echo $data['pnr_no']; ?>">	
				<input type="hidden" name="counter_id" value="<?php echo $data['counter_id']; ?>">	
                <div class="form-group ">               
                 <input required type="text" class="form-control input-lg" name="bkash_no" id="" placeholder="bKash Account No.">
                </div>
				<button type="submit" name="cancel" class="btn btn-lg btn-warning" onclick="return confirmation()"><i class="fa fa-window-close"></i> Cancel Booking</button>	
				<?php } ?>		
			   
			   </form>

        </div>
		
		 <?php
		 
	     }elseif($data['booking_status'] == 2){
		 ?>
	       <div class="col-md-8 col-lg-10 col-lg-offset-1">
				<div class="alert alert-danger alert-dismissable">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 <div style="text-align:center; font-size:40px;"> <strong>Sorry!</strong> Your Booking request was cancelled.</div>
				</div>
			</div>
		 
	     <?php	
		 
	     }elseif($sql->rowCount()>0){
		 ?>
	       <div class="col-md-8 col-lg-10 col-lg-offset-1">
				<div class="alert alert-danger alert-dismissable">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 <div style="text-align:center; font-size:40px;"> <strong>Sorry!</strong> Your Booking request is not approved yet.</div>
				</div>
			</div>
		 
	     <?php		 
	     } else{
		?>	
			<div class="col-md-8 col-lg-10 col-lg-offset-1">
				<div class="alert alert-danger alert-dismissable">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 <div style="text-align:center; font-size:40px;"> <strong>Sorry!</strong> Your Booking Details not Found. </div>
				</div>
			</div>
		<?php
		 }
		 ?>
			
		 
	</div>
	
	<!---728x90--->
</div>

</div>
<!--- /agent ---->
<?php include"inc/footer.php" ; ?>