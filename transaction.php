
<?php include"inc/header.php" ; ?>






<?php 
	if(isset($_POST['btn']))
	{
		
		$boarding_id = $_POST['boarding'];
		Session::set("counter_id",$_POST['boarding']);
		$passenger_name = Session::get("passenger_name");
		//$seat = Session::get("seat");
	}


 ?>

  <?php 
 	$trip_id = intval($_GET['trip_id']);
 	$user_id = Session::get("passenger_id");
	$journey_date = Session::get("journey_date");
	$counter_id = Session::get("counter_id");
	$total_amount = Session::get("total_amount");
	$session_id = session_id();
  ?>



 <?php 
	$seats= $booked_seat->GetReservedByItself($trip_id,$user_id, $_SESSION['journey_date']);
	$seat_no = array();
	if($seats){
		$value = mysqli_fetch_all($seats,MYSQLI_ASSOC);
		
		for ($i=0; $i<count($value); $i++) {
			array_push($seat_no, $value[$i]['seat_no']);
		}
	}
 ?>


  <?php 

  	if(isset($_POST['confirm']))
		{
			$pnr_no = rand(1000,9999);
			$reference = $_POST['reference'];

			if (!empty($reference)) {
			
			try{

				$inser_booking = $booking_info->InsertBooking($pnr_no,$trip_id,$user_id,$counter_id,$reference,$total_amount,$journey_date);
				if($inser_booking){
					for($i=0;$i<count($value);$i++)
					{
						$seat = $seat_no[$i];
						$insert_booked_seat = $booked_seat->InsertBookedSeats($pnr_no,$trip_id,$user_id,$journey_date,$seat);

						if($insert_booked_seat){
							$data = array("seat"=>$seat,"trip_id"=>$trip_id,"journey_date"=>$journey_date);
							$delete_from_reserved = $reserved_info ->DeleteSeat($data);
						}

					}

					if ($delete_from_reserved) {
						Session::set("pnr_no",$pnr_no);
						@$_SESSION['seats']=$seat_no;
						header('Location: greetings.php?trip_id='.$trip_id);
					}
				}
			}

			catch(PDOException $e)
				{
				echo '<script> alert('."Operation failed:".$e->getMessage().'); </acript>';
				}
	    } else {
			echo '<script> alert("Please! fill up the input"); </acript>';
	    }

	}
   ?>



</head>
<?php include("inc/header_bottom.php"); ?>
<!--- /header-->


<!-- payment -->
<div class="agent">
<!---728x90-->
	<div class="container">
	
	<div class="col-md-7 " >
	 <div>
	    <p> <h3>Hi, <b style="color:red"><?php echo $passenger_name;?>!</b> Your ticket has been reserved!  </h3></p>
	    <h4 style="font-weight: bolder; color:#001a00">Now finish the payment within 3 minutes to confirm your ticket</h4>
	   
	 </div>
	 
	 

	  <?php 
      		$bus_info=$trip_info->GetSearchBusBytripId($trip_id);
      		if($bus_info)
			{
				$data = $bus_info->fetch_assoc();

		?>


		 <?php 

	 	  	$agent_by_counter = $counter_info->GetCounterById($boarding_id);
	 	  	if($agent_by_counter)
			$datacounterPh = $agent_by_counter->fetch_assoc();
		  ?>

			<?php 
				$total_amount = $data['fare']*count($value);
				$_SESSION['total_amount'] = $total_amount;

			 ?>

	 <div>



	 
	    <div class="">
                  <h3 >Total Amount to Be Paid:<span style="color: red" id="display_total_payable"> ৳. <?php echo $total_amount; ?></span> </h3>
         </div>
		 </br>
		 
		 <div class="panel panel-default col-md-6">
             <div class="panel-body"> <h4 style="font-size: 21px; font-weight: bolder; color:#001a00 ">Choose Your Payment Method</h4></div>
        </div>
		
        <div class="clearfix"></div>
		 
		 <div>
		   <ul class="nav nav-tabs">            
             <li class="active"><a data-toggle="tab" href="#menu1">Bkash</a></li>
             <li><a data-toggle="tab" href="#menu2">Credit or Debit Card</a></li>
             <li><a data-toggle="tab" href="#menu3">Internet Banking</a></li>
           </ul>

           <div class="tab-content">
             <div id="menu1" class="tab-pane fade in active">
               <h3>Payment through bKash:</h3>
               <p style="font-weight: bolder; color:#001a00">Pay through bKash to this Merchant Account No: <b style="color:red"><?php echo $datacounterPh['contact_no'];?> </b> and enter reference number to get the confirm ticket</p>
               

            <form class="form-inline" method="post">
 
               <div class="form-group ">               
                 <input required type="text" class="form-control" name="reference" id="" placeholder="bKash Reference No.">
               </div>
               <button type="submit" name="confirm" class="btn btn-primary">Confirm</button>
             </form>
			 </div>
             

             <div id="menu2" class="tab-pane fade">
               <h3 style="color: #331a00"> <b style="color: red">Sorry!!</b> Payment through Credit or Debit Card is still not available.</h3>              
             </div>
             <div id="menu3" class="tab-pane fade">
               <h3 style="color: #331a00"> <b style="color: red">Sorry!!</b> Payment through Internet Banking is still not available.</h3>              
             </div>
           </div>
       </div>
	 
	 </div>
	
	 


	
	</div>
	
		
	<aside id="journey" class="col-md-4 paside agent-right">

          <div class="page_title" style="margin-right:2%;">
              <h3>Your Selected Journey Details</h3>
          </div><br>
		  
		  

          <ul style="margin-left:2%;">
              <!--//// For Eid  /////-->
              <li><b style="font-weight:bolder;">Journey:</b> <?php echo $data['from_city']; ?> - <?php echo $data['to_city']; ?> </li>
              <!--//// For Eid  /////-->
              <li><b style="font-weight:bolder;">Bus No: </b><?php echo $data['bus_no']; ?></li>
              <li><b style="font-weight:bolder;">Date of Journey:</b> <?php  echo date('F j, Y', strtotime(Session::get("journey_date"))); ?></li>
              	<li><b style="font-weight:bolder;">Starting Time:</b> <?php echo date('h:i A', strtotime($data['departure_time'])); ?></li>
              <li><b style="font-weight:bolder;">Seat No(s):</b> <span> <?php echo implode(',', $seat_no);  ?></span></li>
              <li><b style="font-weight:bolder;">Ticket Price Per Seat: </b> <span><?php echo $data['fare'];?> BDT</span></li>
              <li><b style="font-weight:bolder;">Boarding at: </b> <?php echo $datacounterPh['counter_name'];?></li>
          
        </ul>

    </aside>


    <?php } ?>
						
	
		<div class="clearfix"></div>
	
		 
		
			
		 
	</div>


<script type="text/javascript">

	/*To deselect all selected seats after 3 minutes*/
	function reload(){
		var trip_id = '<?php echo $trip_id; ?>';
		var passenger_id = '<?php echo $user_id; ?>';
		var journey_date = '<?php echo $journey_date; ?>';
		var session_id = '<?php echo $session_id; ?>';

		$.ajax( {
		        url:'ajax_php/remove.php',
		        type:'POST',
		        data: {trip_id:trip_id,passenger_id:passenger_id, journey_date:journey_date,session_id:session_id},
		        dataType:"text", 
	        	success: function(res) {
	                alert("Your session has closed! Try again with new seats");
	                window.location.replace("index.php");
	        	}
	    	});
	}

	 setInterval(function(){
         reload();
      },300000);

</script>
	


<?php include"inc/footer.php" ; ?>