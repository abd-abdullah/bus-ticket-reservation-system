<?php include"inc/header.php" ; ?>
</head>
<?php include("inc/header_bottom.php"); ?>

<!--- /footer-btm -->
<!--- banner-1 -->
<div class="banner-1 ">
	<div class="container">
		<h1> Ensuring Your Best Experience </h1>
	</div>
</div>
<!--- /banner-1 -->

<!--- agent -->
<div class="agent">
<!---728x90-->
	<div class="container">
	
	<div class="col-md-7 " >
	 <div>
	    <p> <h3>Hi, <b style="color:red"><?php echo Session::get("passenger_name");?>!</b> Thank you for your booking!  </h3></p>
	    <p> <h4>Your PNR Number is: <b style="color:red"><?php echo Session::get("pnr_no");?></b> </h4></p>
	    <p style="color:#001a00; text-align: justify;">After varifing your information and reference number from our end, we will send you a confirmation email. Once you recieve the confirmation email, you will be able to print your ticket. You are suggested to reserve your PNR number above for ticket printing. </p>
	    <p style="color:#001a00">Thank you for choosing our service!</p>		   
	 </div>	
	</div>
	
		
	<aside id="journey" class="col-md-4 paside agent-right">

              <div class="page_title" style="margin-right:2%;">
                  <h3>Your Selected Journey Details</h3>
              </div><br>
			  
			  
			  

              <ul style="margin-left:2%;">
              	 <?php 
              		$Available_bus=$trip_info->GetSearchBusBytripId(intval($_GET['trip_id']));
              		if($Available_bus)
					{
						$data = $Available_bus->fetch_assoc();

              	 ?>

                  <!--//// For Eid  /////-->
                  <li><b style="font-weight:bolder;">Journey:</b> <?php echo Session::get("from_city"); ?> - <?php echo Session::get("to_city"); ?> </li>
                  <!--//// For Eid  /////-->
                  <li><b style="font-weight:bolder;">Bus No: </b><?php echo $data['bus_no']; ?></li>
                  <li><b style="font-weight:bolder;">Date of Journey:</b> <?php echo date('F j, Y', strtotime(Session::get("journey_date")));?></li>
                  <li><b style="font-weight:bolder;">Starting Time:</b> <?php echo date('h:i A', strtotime($data['departure_time'])); ?></li> 
                  <li><b style="font-weight:bolder;">Seat No(s):</b> <span> <?php echo implode(',', $_SESSION['seats']);  ?></span></li>
                  <li><b style="font-weight:bolder;">Ticket Price Per Seat: </b> <span><?php echo $data['fare'];?> BDT</span></li>
                  <li><b style="font-weight:bolder;">Total Trip Price: </b> <span><?php echo Session::get("total_amount");?> BDT</span></li>
                  <?php } ?>
              
            </ul>

    </aside>
						
	
		<div class="clearfix"></div>
	
		 
		
			
		 
	</div>
	
	<!--728x90-->
</div>
<!-- /agent -->

<!--- footer-top -->
<?php include"inc/footer.php" ; ?>