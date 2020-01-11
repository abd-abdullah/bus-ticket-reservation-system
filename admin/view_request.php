<?php
	$booking_id = $_GET['id'];
  $booked_information = $booking_info->GetBookedByPnr($booking_id);
  $data = $booked_information->fetch_assoc();
  //echo '<script>alert('.$data.')</script>';
?>


<?php 
	$seats= $booked_seat->BookedSeatsByPnr($data['pnr_no'],$data['passenger_id'],$data['trip_id'] );
	$seat_no = array();
	if($seats){
		$value = mysqli_fetch_all($seats,MYSQLI_ASSOC);
		
		for ($i=0; $i<count($value); $i++) {
			array_push($seat_no, $value[$i]['seat_no']);
		}
	}
 ?>

?>

<?php 
	if(isset($_POST['cancel']))
		{ 
		    $pnr_no = $_POST['pnr_no']; 
			$cancel_tkt = $booking_info->CancelTkt($pnr_no);
                       
			$sms = '<div class="alert alert-success alert-dismissable" style="text-align:center; font-size:25px;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>'.$cancel_tkt.'</strong> </div>';
		}
		
		 
	if(isset($_POST['delete']))
		 { 
		       $pnr_no = $_POST['pnr_no'];
			  $delete_tkt = $booking_info->DeleteTkt($pnr_no);
                       
			$sms = '<div class="alert alert-success alert-dismissable" style="text-align:center; font-size:25px;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>'.$delete_tkt.'</strong> </div>';
		 }

	


//dj

		if(isset($_POST['approve']))
		{
		    $pnr_no = $_POST['pnr_no'];
			$Approve = $booking_info->ApproveTkt($pnr_no);


			$bus_type= $data['bus_type'];
			$from_city= $data['from_city'];
			$to_city= $data['to_city'];
			$bus_name= $data['bus_no'];
			$journey_date= $data['journey_date'];
			$departure_time= $data['departure_time'];
			$boarding= $data['counter_name'];
				
            $passenger_email= $data['email'];		
            $passenger_name= $data['name'];		

			if($Approve)
			   {	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
					try {
						//Server settings
						//$mail->SMTPDebug = 2;                                 // Enable verbose debug output
						$mail->isSMTP();                                      // Set mailer to use SMTP
						$mail->Host = 'ssl://smtp.gmail.com';                       // Specify main and backup SMTP servers
						$mail->SMTPAuth = true;                               // Enable SMTP authentication
						$mail->Username = 'onlineticketbd83@gmail.com';                 // SMTP username
						$mail->Password = 'aslam14103148';                           // SMTP password
						$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
						$mail->Port = 465;                                    // TCP port to connect to
						$mail->SMTPOptions = array(
							'ssl' => array(
								'verify_peer' => false,
								'verify_peer_name' => false,
								'allow_self_signed' => true
							)
						);

						//Recipients
						$mail->setFrom('onlineticketbd83@gmail.com', 'Onlineticketbd');
						$mail->addAddress($passenger_email, $passenger_name);     // Add a recipient					
						$mail->addReplyTo('info@example.com', 'Information');
						$mail->addCC('cc@example.com');
						$mail->addBCC('bcc@example.com');

						//Attachments
						//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
						//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

						//Content
						$mail->isHTML(true);                                  // Set email format to HTML
						$mail->Subject = 'Booking Confirmation';
						$mail->Body    = 'Hello! '.$passenger_name.', your booking has been confirmed.You can now print your ticket with your PNR No. <br />Your PNR No: '.$pnr_no.'<br>Journey: '.$from_city.' to '.$to_city.'<br>Bus Name: '.$bus_name.'<br>Bus Type: '.$bus_type.'<br>Seats: '.implode(',', $seat_no).'<br>Journey Date: '.$journey_date.'<br>Departure Time: '.$departure_time.'<br>Boarding Point: '.$boarding;
						
						$mail->AltBody = 'Congratulations! Your booking has been confirmed.';

						$mail->send();
						//echo 'Message has been sent';
						} catch (Exception $e) {
							echo 'Message could not be sent.';
							echo 'Mailer Error: ' . $mail->ErrorInfo;
						} 
		   
					$sms = '<div class="alert alert-success alert-dismissable" style="text-align:center; font-size:25px;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong> Booking Request Approved!</strong> </div>';
					
			   }  else {
					  $sms = '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> unsuccessfull ! </div>';
			   }
		}	














 ?>



<script type="text/javascript">
		  function confirmation() {
		  return confirm('Are you sure you want to delete this request?');
			}
</script>
		
    <section class="content-header">
      <h1> Booking Information</h1>
	  
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		
		<?php if(isset($sms)){echo $sms;} ?>
		
        <div class="box-body">
		
          <div class="col-md-12">

            
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
			<div class="panel-heading" style="background-color:#232d4f; height: 40px;"><p style="font-size:20px;color:white;">Passenger Details</p></div>

			
			<form  method="post" action="">
			
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
						
                    </table> <br />
					
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				<div class="panel-heading" style="background-color:#44495b; height: 40px;"><p style="font-size:20px;color:white;">Booking Details</p></div>
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
                            <td><?php echo  $data['journey_date']; ?></td>
                      
                        </tr>	

						<tr>
							<th>Bus No:</th>
                            <td><?php echo  $data['bus_no']; ?></td>
							<th>Bus Type:</th>
                            <td><?php echo  $data['bus_type']; ?></td>
                      
                        </tr>						
						
						<tr>
                            <th>From City:</th>
                            <td><?php echo  $data['from_city']; ?></td>
							<th>To City:</th>
                            <td><?php echo  $data['to_city']; ?></td>
                      
                        </tr>

						<tr>

							<th>Boarding Point:</th>
                            <td><?php echo  $data['counter_name']; ?></td>
							<th>Seat No(s):</th>
                            <td><?php echo implode(',', $seat_no) ?></td>
                      
                        </tr>						
						
						<tr>

							<th>ticket price:</th>
                            <td>৳. <?php echo $data['fare'];?></td>
							<th>Starting Time:</th>
                            <td><?php echo date('h:i A', strtotime($data['departure_time'])); ?> </td>
                      
                        </tr>	

						<tr>

							<th>Total Amount Payable:</th>
                            <td>৳. <?php echo $data['fare']*count($value);?></td>
							<th>Current Booking Status:</th>
                            <td><?php if ( $data['booking_status'] == 0){echo "pending";} elseif( $data['booking_status'] == 1){echo "approved";} elseif( $data['booking_status'] ==2){echo "cancelled";}?></td>
							
                        </tr>							
						
				
						
                </table>
				
			
				<div class=" col-md-offset-2">
				
				<input type="hidden" name="trip_id" value="<?php echo $data['trip_id']; ?>">
				<input type="hidden" name="pnr_no" value="<?php echo $data['pnr_no']; ?>">	
				<button type="submit" name="approve" class="btn btn-lg btn-success"><i class="fa fa-check-square"></i> Approve Request</button>
				<button type="submit" name="cancel" class="btn btn-lg btn-warning"><i class="fa fa-window-close"></i> Cancel Request</button>
				<button type="submit" name="delete" class="btn btn-lg btn-danger" onclick="return confirmation()"><i class="fa fa-trash-o"></i> Delete Request</button>

				
               </div>
			   
			   </form>

        </div>
       
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
