<?php include"inc/header.php" ; ?>

<?php
 
if(isset($_POST['btn']))
	{
		$_SESSION['from_city'] = $_POST['from_city'];
		$_SESSION['to_city'] = $_POST['to_city'];
		$_SESSION['journey_date'] = $_POST['journey_date'];
		
	    $Available_bus=$trip_info->GetSearchBus($_SESSION['from_city'],$_SESSION['to_city']);
	    
	}

?>


<style>
	.btn.btn-success:hover,
	.btn.btn-success:focus,
	.btn.btn-success:active,
	.btn.btn-success.active {
	  color: #000;
	  background-color: #0c7f06;
	  border-color: #000;
	}

	.btn.btn-success {
	  color: #000;
	  background-color: #fff;
	  border-color: #000;
	  width:50px;
	}
	.btn-group-toggle{
		margin-top:5px;
	}


		table{border:2px #ccc solid;}
		table tr td{border-right:1px #ccc solid;text-align:center;}
		table tr td:last-child{border-right:0px #ccc solid;}

{border-bottom:1px #000 solid !important;}
		.seatbox{background-color: #209e04; color: white; padding: 5px 15px; text-align: center;text-decoration: none;display: inline-block;font-size: 16px;border-radius: 50%; }
</style>
</head>
<?php include("inc/header_bottom.php"); ?>
<!--- /footer-btm -->
<!--- banner-1 -->
<div class="banner-1 ">
	
</div>
<!--- /banner-1 -->

<!--- bus-tp -->
<div class="bus-tp">
	<div class="container">
		<p>Date of the Trip : <?php echo $_SESSION['journey_date'] ; ?></p>
							
		<h2>Buses from <?php echo $_SESSION['from_city']; ?> to <?php echo $_SESSION['to_city']; ?></h2>
		<div class="clearfix"></div>
	</div>
</div>
		<?php if(isset($sms)){ echo $sms; } ?> 
<!--- /bus-tp -->
<!--- bus-btm -->
<div class="bus-btm">
	<div class="container">
		<ul>
			<li class="trav"><a href="#">Available Buses</a></li>
			<li class="dept"><a href="#">Departure</a></li>
			<li class="arriv"><a href="#">Arrival</a></li>
			<li class="seat"><a href="#">Seats</a></li>
			<li class="fare"><a href="#">Fare</a></li>
				<div class="clearfix"></div>
		</ul>
	</div>
</div>
<!--- /bus-btm -->
<!--- bus-midd -->
<div class="bus-midd" >
	<!---728x90-->
	<div class="container">
	<!--- ul-first  -->
	
	<?php
	if($Available_bus)
	{
		$AllBus = mysqli_fetch_all($Available_bus,MYSQLI_ASSOC);
		$i=1;
	    foreach($AllBus as $value)
	    {
			$trip_id = $value['trip_id'];
			$dataseat=$booked_seat->GetAvailabaleSeat($trip_id, $_SESSION['journey_date']);
			$dataseat = $dataseat->fetch_assoc();
		
	    ?>	
	    
		<ul class="first">
			<li class="trav">
				<div class="bus-ic">
					<img src="images/bus.png" class="img-responsive" alt="">
				</div>							
				
				<div class="bus-txt">
					<h4><?php echo $value['bus_no']; ?></h4>
					<p><?php echo $value['bus_type']; ?></p>
				</div>
				<div class="clearfix"></div>
			</li>
			<li class="dept">
				<div class="bus-ic1">
					<i class="fa fa-clock-o"></i>
				</div>
				<div class="bus-txt1">
					<?php  
				
					$time = $value['departure_time'];                    				
				    ?>						
					<h4><a href="#"><?php echo date('h:i A', strtotime($time)); ?></a></h4>
					<p>Duration</p>
				</div>
				<div class="clearfix"></div>
			</li>
			<li class="arriv">
				<div class="bus-txt2">
					<?php  
				
					$time = $value['arrival_time'];                    				
				    ?>						
					<h4><a href="#"><?php echo date('h:i A', strtotime($time)); ?></a></h4>
					<p>10:00 Hrs</p>
				</div>
			</li>
			
			<li class="seat">
				<div class="bus-ic3">
					<img src="images/seat.png" class="img-responsive" alt="">
				</div>
				<div class="bus-txt3">
					<h4><?php echo $value['no_of_seats']-$dataseat['total']; ?></h4>					
				</div>
				<div class="clearfix"></div>
			</li>
			<li class="fare">
				<div class="bus-txt4">
					<h5>৳. <?php echo $value['fare']; ?></h4>
					
					<?php
						if(Session::get("passenger_login")==true){
					?>
					<a href="" data-toggle="modal" data-target="#seatModal<?php echo $i; ?>" class="view">View Seats</a>
					<?php } 

					else{ ?>

						<a href="" data-toggle="modal" data-target="#myModals" class="view">Login to view Seats</a>
					<?php } ?>
					 

				</div>
					
			</li>
				<div class="clearfix"></div>
				
		</ul>
		<?php
		$i++;
		}
		?>
		
		
	
		<?php
		   
		   	$j=1;
		    foreach($AllBus as $value)
		    {
				
				$counter_data=$counter_info->GetBoardingPoints($_SESSION['from_city']);

			?>
		
			<div class="modal fade" id="seatModal<?php echo $j; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div id= "reload" class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
							<section>
								<div class="modal-body modal-spa">
									<div class="writ">
									  
									<form method="post" action="user_details.php">
									<input type="hidden" name="agent_id" value="<?php //echo $value['agent_id']; ?>"/>

									<input type="hidden" name="bus_id" value="<?php echo $value['bus_id']; ?>"/>
									<input type="hidden" name="trip_id" value="<?php echo $value['trip_id']; ?>"/>
									
									<?php 
										$sqll= $booked_seat->GetAllBookedSeats($value['trip_id']);
										$booked_seats = array();
										if($sqll){
											$dataa = mysqli_fetch_all($sqll,MYSQLI_ASSOC);
											
											for ($i=0; $i<count($dataa); $i++) {
												if($dataa[$i]['seat_status'] == 1) {
													array_push($booked_seats, $dataa[$i]['seat_no']);
												}
											}
										}
									  ?>

									  <?php 
										$res_seat= $booked_seat->GetAllBookedSeats($value['trip_id']);
										$reserved_seats = array();
										if($res_seat){
											$value = mysqli_fetch_all($res_seat,MYSQLI_ASSOC);
											
											for ($i=0; $i<count($value); $i++) {
												if($value[$i]['seat_status'] == 0) {
													array_push($reserved_seats, $value[$i]['seat_no']);
												}
											}
										}
									  ?>
								
								
										<table height="500" width="400" border="0" cellspacing="0" cellpadding="0" align="center">
			                                <tr height="50" class="top">
			                           	        <td style="font-weight:bolder;"> <label  style="width:20px; height:15px; background-color:#FF5A5A" ></label> Booked </td>
			                           	        <td  style="font-weight:bolder;"> <label  style="width:20px; height:15px; background-color:#ffb702" ></label> Reserved </td>
			                           	        <td></td>

			                           	        <td style="font-weight:bolder;"> <label  style="width:20px; height:15px; background-color:#0C7F06" ></label> Selected </td>
			                           	        <td  style="font-weight:bolder;"> <label  style="width:20px; height:15px; background-color:#fff;  border:1px solid #000;" ></label> Available </td>
			                          
			                                </tr>
			                                <tr height="60" class="top">
			                                	<td colspan="4"></td>
			                                	<td > Driver</td>
			                                </tr>
			                                <tr>
			                                	
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("A1", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"   value="A1" <?php if(in_array("A1", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> A1
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("A2", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"   value="A2" <?php if(in_array("A2", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> A2
												 		 </label>
													</div> </td>
												
			                                	<td width="40"></td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("A3", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="A3" <?php if(in_array("A3", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> A3
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("A4", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="A4" <?php if(in_array("A4", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> A4
												 		 </label>
													</div> </td>
			                                </tr>
			                                
			                                <tr>
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("B1", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="B1" <?php if(in_array("B1", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> B1
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("B2", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="B2" <?php if(in_array("B2", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> B2
												 		 </label>
													</div> </td>
												
			                                	<td></td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("B3", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="B3" <?php if(in_array("B3", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> B3
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("B4", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="B4" <?php if(in_array("B4", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> B4
												 		 </label>
													</div> </td>
			                                </tr>
			                                
			                                <tr>
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("C1", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="C1" <?php if(in_array("C1", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> C1
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("C2", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="C2" <?php if(in_array("C2", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> C2
												 		 </label>
													</div> </td>
												
			                                	<td></td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("C3", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="C3" <?php if(in_array("C3", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> C3
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("C4", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="C4" <?php if(in_array("C4", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> C4
												 		 </label>
													</div> </td>
			                                </tr>
			                                
			                                <tr>
			                                		<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("D1", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="D1" <?php if(in_array("D1", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> D1
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("D2", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="D2" <?php if(in_array("D2", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> D2
												 		 </label>
													</div> </td>
												
			                                	<td></td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("D3", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="D3" <?php if(in_array("D3", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> D3
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("D4", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="D4" <?php if(in_array("D4", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> D4
												 		 </label>
													</div> </td>
			                                </tr>

			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("D1", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="E1" <?php if(in_array("E1", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> E1
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("E2", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="E2" <?php if(in_array("E2", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> E2
												 		 </label>
													</div> </td>
												
			                                	<td></td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("E3", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="E3" <?php if(in_array("E3", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> E3
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("E4", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="E4" <?php if(in_array("E4", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> E4
												 		 </label>
													</div> </td>
			                                
			                                <tr>
			                                		<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("F1", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="F1" <?php if(in_array("F1", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> F1
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("F2", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="F2" <?php if(in_array("F2", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> F2
												 		 </label>
													</div> </td>
												
			                                	<td></td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("F3", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="F3" <?php if(in_array("F3", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> F3
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("F4", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="F4" <?php if(in_array("F4", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> F4
												 		 </label>
													</div> </td>
			                                </tr>
			                                
			                                <tr>
			                                		<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("G1", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="G1" <?php if(in_array("G1", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> G1
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("G2", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="G2" <?php if(in_array("G2", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> G2
												 		 </label>
													</div> </td>
												
			                                	<td></td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("G3", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="G3" <?php if(in_array("G3", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> G3
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("G4", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="G4" <?php if(in_array("G4", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> G4
												 		 </label>
													</div> </td>
			                                </tr>
			                                
			                                
			                                <tr>
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("H1", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="H1" <?php if(in_array("H1", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> H1
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("H2", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="H2" <?php if(in_array("H2", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> H2
												 		 </label>
													</div> </td>
												
			                                	<td></td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("H3", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="H3" <?php if(in_array("H3", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> H3
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("H4", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="H4" <?php if(in_array("H4", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> H4
												 		 </label>
													</div> </td>
			                                </tr>
			                                
			                                <tr>
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("I1", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="I1" <?php if(in_array("I1", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> I1
												 		 </label>
													</div> </td>
												
			                                	<td onclick="Abd('#seat_i2','#label_i2')"> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label id="label_i2" <?php if(in_array("I2", $booked_seats)){ ?> disabled style="background-color:red" <?php } elseif(in_array("I2", $reserved_seats)){ ?> disabled style="background-color:#ffb702" <?php } ?> class="btn btn-success " >
												    	<input type="checkbox"   name="seat[]"  id="seat_i2" value="I2" <?php if(in_array("I2", $reserved_seats) || in_array("I2", $booked_seats)){ ?> checked disabled <?php } ?>  > I2
												 		 </label>
												 		
													</div>
												</td>
													 
												
			                                	<td></td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("I3", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="I3" <?php if(in_array("I3", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> I3
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("I4", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="I4" <?php if(in_array("I4", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> I4
												 		 </label>
													</div> </td>
			                                </tr>
			                                
			                                <tr>
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("J1", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="J1" <?php if(in_array("J1", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> J1
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("J2", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="J2" <?php if(in_array("J2", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> J2
												 		 </label>
													</div> </td>
												
			                                	<td></td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("J3", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="J3" <?php if(in_array("J3", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> J3
												 		 </label>
													</div> </td>
												
			                                	<td> <div  class="btn-group-toggle"  data-toggle="buttons">
												  		<label <?php if(in_array("J4", $booked_seats)){ ?> disabled style="background-color:red" <?php } ?> class="btn btn-success" >
												    	<input type="checkbox" name="seat[]"  class="seat" value="J4" <?php if(in_array("J4", $booked_seats)){ ?> checked disabled <?php } ?> autocomplete="off"> J4
												 		 </label>
													</div> </td>
			                                </tr>

			                                
			                                <tr height="50">
			                                	<td colspan="5">
			                                	<select class="form-control dd" name="counter_name">
			                                		<option value="0">---------Select Your Boarding Point------</option>
													<?php
													foreach($counter_data as $vcounter)
													{
													?>
			                                		<option value="<?php echo $vcounter['counter_name'];?>"><?php echo $vcounter['counter_name']; ?></option>
													<?php
													}
													?>
			                                	</select>
			                                	</td>
			                                </tr>
		                                
			                                <tr height="50">
			                                <td colspan="5"><button  name="btn" class="seabtn"> Proceed </button></td>
			                                </tr>
		                                </table>
										</form>
									</div>
								</div>
							</section>
					</div>
				</div>
			</div>		
		  <?php
		  $j++;
		   }
	}   else{
		?>	
			<div class="col-md-8 col-lg-10 col-lg-offset-1">
				<div class="alert alert-danger alert-dismissable">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 	 <div style="text-align:center; font-size:50px;"> <strong>Sorry!</strong> Bus not found on this route.. </div>

				</div>
			</div>
		<?php
	}
		   ?>
		<!--- /ul-first  ---->

	</div>
	<script type="text/javascript">

	function Abd(seat,act){
		var value = $(seat).val();
		var chk='';
		if (!($(act).hasClass("active")))
		{
			  // it is checked
			chk =1;
		}
		else{
			chk =0;
		}

		$.ajax( {
	        url:'Reserved.php',
	        type:'POST',
	        data: {seat:value, chk:chk},
	        dataType:"text", 
        	success: function(res) {
                //alert(res);
        	}
    	});
	}
</script>

	<!---728x90--->
</div>
<!--- /routes ---->
<!--- footer-top ---->
<?php include"inc/footer.php" ; ?>