<?php include"inc/header.php" ; ?>
</head>
<?php include("inc/header_bottom.php"); ?>

<!--- /footer-btm ---->
<!--- banner-1 ---->
<div class="banner-1 ">
	<div class="container">
		<h1> Ensuring Your Best Experience </h1>
	</div>
</div>
<!--- /banner-1 ---->
<div class="agent">

<div class="bus-btm">

	<div class="container">

          <div class="col-md-12">
			<div style="font-size:25px; text-align:center;"> <?php if(isset($sms)){ echo $sms; } ?> </div>

			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
			<div class="panel-heading" style="background-color:green; height: 60px;"><h4 style="font-size:30px;color:white; text-align: center;">Your Booking Details</h4></div>
	
			<form  method="post" action="Privacy.php">
			
                        <tr>
                            <th>Passenger Name:</th>
                            <td><?php echo  $data['passenger_name']; ?></td>
							 <th>Gender:</th>
                            <td><?php echo  $data['passenger_gender']; ?></td> 
                      
                        </tr>
						
                        <tr>
                            <th>Contact No:</th>
                            <td><?php echo  $data['passenger_contact']; ?></td>
						   <th>Email:</th>
						   <td><?php echo  $data['passenger_email']; ?></td> 							
                        </tr> 					

                         <tr>
                            <th>Booking No:</th>
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
						
							<th>Bus Type:</th>
                            <td><?php echo  $data['bus_type']; ?></td>
							<th>From City:</th>
                            <td><?php echo  $data['from_city']; ?></td>
                      
                        </tr>						
						
						<tr>
							<th>To City:</th>
                            <td><?php echo  $data['to_city']; ?></td>
							<th>Boarding Point:</th>
                            <td><?php echo  $data['counter_name']; ?></td>                      
                        </tr>

						<tr>
							<th>Seat No(s):</th>
                            <td><?php echo $booked_seat;  ?></td>
							<th>Starting Time:</th>
                            <td><?php echo date('h:i A', strtotime($data['departure_time'])); ?> </td>
                      
                        </tr>						
						
						<tr>
                            <th>Current Booking Status:</th>
                            <td><?php if ( $data['booking_status'] == 'pending'){echo "pending";} elseif( $data['booking_status'] == 'approved'){echo "approved";} elseif( $data['booking_status '] == 'cancelled'){echo "cancelled";}?></td>
							<th>ticket price:</th>
                            <td>৳. <?php echo $data['fare'];?></td>
                      
                        </tr>	

						<tr>

							<th>Total Amount Paid:</th>
                            <td>৳. <?php echo  $data['fare']*4;?> </td>
							
							<th>Total Amount Refundable:</th>
                            <td>৳. <?php $subtotal= $data['fare']*4; echo $subtotal-$subtotal*0.15; ?></td>
							
                        </tr>							
						
				
						
                </table>
				
			
				<div class=" col-md-offset-5">
				<a href="index.php" class="btn btn-lg btn-success"><i class="glyphicon glyphicon-chevron-left"></i> Back to home page</a>
               </div>
			   
			   </form>

        </div>
		
		 
		 
	</div>
	
	<!---728x90--->
</div>
</div>
<!--- /agent ---->

<!--- footer-top ---->
<?php include"inc/footer.php" ; ?>