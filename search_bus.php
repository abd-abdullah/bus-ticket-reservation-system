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


 <script type="text/javascript">
      $(document).ready(function(){
      
        function auto(){
          
          $.ajax({
            type: 'post',
            url: 'ajax_php/book_seat.php',
           // data: {value: value},
            success: function (data) {
            	//alert("yes");
            	id_numbers = JSON.parse(data);
            	if(id_numbers.includes("A3")){
            		$(".set2").html("N");
            		//alert(id_numbers);

            	}
             
            }
          });

      };

      setInterval(function(){   
           auto();   
           }, 1000); 

    });
    </script>

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
			<li style="width:200px;"><a href="#">Available Buses</a></li>
			<li style="width:180px;"><a href="#">Departure</a></li>
			<li style="width:180px;"><a href="#">Arrival</a></li>
			<li style="width:150px;"><a href="#">Seats</a></li>
			<li style="width:200px;"><a href="#">4 Seats Togather</a></li>
			<li style="width:200px;"><a href="#">Fare</a></li>
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
			<li style="width:200px;">
				<div class="bus-ic">
					<img src="images/bus.png" class="img-responsive" alt="">
				</div>							
				
				<div class="bus-txt">
					<h4><?php echo $value['bus_no']; ?></h4>
					<p><?php echo $value['bus_type']; ?></p>
				</div>
				<div class="clearfix"></div>
			</li>
			<li style="width:180px;">
				<div class="bus-ic1">
					<i class="fa fa-clock-o"></i>
				</div>
				<div class="bus-txt1">
					<?php  
				
					$time = $value['departure_time'];                    				
				    ?>						
					<h4><a href="#"><?php echo date('h:i A', strtotime($time)); ?></a></h4>
					<!-- <p>Duration</p> -->
				</div>
				<div class="clearfix"></div>
			</li>
			<li style="width:180px;">
				<div class="bus-txt2">
					<?php  
				
					$time = $value['arrival_time'];                    				
				    ?>						
					<h4><a href="#"><?php echo date('h:i A', strtotime($time)); ?></a></h4>
					<!-- <p>10:00 Hrs</p> -->
				</div>
			</li>
			
			<li style="width:150px;">
				<div class="bus-ic3">
					<img src="images/seat.png" class="img-responsive" alt="">
				</div>
				<div class="bus-txt3">
					<h4><?php echo $value['no_of_seats']-$dataseat['total']; ?></h4>					
				</div>
				<div class="clearfix"></div>
			</li>


				<li style="width:200px;">
				<div class="bus-txt3">
					

					<?php 
						$sqll= $booked_seat->GET_AllReservedSeats($value['trip_id'], $_SESSION['journey_date']);
						$booked_seats = array();
						if($sqll){
							$dataa = mysqli_fetch_all($sqll,MYSQLI_ASSOC);
							
							for ($i=0; $i<count($dataa); $i++) {
								
									array_push($booked_seats, $dataa[$i]['seat_no']);
								
							}
						}
					?>

			<?php 



					  	if((!(in_array("A1", $booked_seats)) && !(in_array("A2", $booked_seats)) && !(in_array("A3", $booked_seats)) && !(in_array("A4", $booked_seats))) || (!(in_array("B1", $booked_seats)) && !(in_array("B2", $booked_seats)) && !(in_array("B3", $booked_seats)) && !(in_array("B4", $booked_seats))) || (!(in_array("C1", $booked_seats)) && !(in_array("C2", $booked_seats)) && !(in_array("C3", $booked_seats)) && !(in_array("C4", $booked_seats))) ||(!(in_array("D1", $booked_seats)) && !(in_array("D2", $booked_seats)) && !(in_array("D3", $booked_seats)) && !(in_array("D4", $booked_seats))) ||(!(in_array("E1", $booked_seats)) && !(in_array("E2", $booked_seats)) && !(in_array("E3", $booked_seats)) && !(in_array("E4", $booked_seats))) ||(!(in_array("F1", $booked_seats)) && !(in_array("F2", $booked_seats)) && !(in_array("F3", $booked_seats)) && !(in_array("F4", $booked_seats))) ||(!(in_array("G1", $booked_seats)) && !(in_array("G2", $booked_seats)) && !(in_array("G3", $booked_seats)) && !(in_array("G4", $booked_seats))) ||(!(in_array("H1", $booked_seats)) && !(in_array("H2", $booked_seats)) && !(in_array("H3", $booked_seats)) && !(in_array("H4", $booked_seats))) ||(!(in_array("I1", $booked_seats)) && !(in_array("I2", $booked_seats)) && !(in_array("I3", $booked_seats)) && !(in_array("I4", $booked_seats))) ||(!(in_array("J1", $booked_seats)) && !(in_array("J2", $booked_seats)) && !(in_array("J3", $booked_seats)) && !(in_array("J4", $booked_seats)))){
					   ?>

						<h4 style="color: blue"><strong><?php echo "Available"; ?></strong></h4>

						<?php } else { ?>

						
						<h4 style="color: red"><strong><?php echo "Not Available"; ?></strong></h4>

						<?php } ?>

						</div>
				<div class="clearfix"></div>
			</li>


			<li style="width:200px;">
				<div class="bus-txt4">
					<h5>৳. <?php echo $value['fare']; ?></h4>
					
					<?php
						if(Session::get("passenger_login")==true){
					?>
					<a href="seat_view.php?trip_id=<?php echo $value['trip_id'] ?>&bus_id=<?php echo $value['bus_id']; ?>" target="_blank" class="view">View Seats</a>
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
		alert(chk);

		$.ajax( {
	        url:'ajax_php/reserved.php',
	        type:'POST',
	        data: {seat:value, chk:chk},
	        dataType:"text", 
        	success: function(res) {
                alert(res);
        	}
    	});
	}
</script>

	<!---728x90--->
</div>
<!--- /routes ---->
<!--- footer-top ---->
<?php include"inc/footer.php" ; ?>