<?php	
    $id = $_SESSION['agent_id']; 
	$sql = $conn->prepare("SELECT `tbl_trip_info`.*, `tbl_bus_info`.*, tbl_cities.city_name FROM `tbl_trip_info` LEFT JOIN `tbl_bus_info` ON `tbl_trip_info`.`bus_id` = `tbl_bus_info`.`bus_id` LEFT JOIN `tbl_cities` ON `tbl_trip_info`.`from_city` = `tbl_cities`.`city_id`  WHERE tbl_trip_info.agent_id='$id' ORDER BY `trip_id` DESC");
	$sql->execute();
	$data = $sql->fetchAll();
		
    //echo "<pre>";print_r($data);exit;
		 
		  if(isset($_POST['delete']))
		 {
			$id = $_POST['trip_id'];
			//echo $_POST['img_url']; exit;
			   $sql = $conn->prepare("delete from tbl_trip_info where trip_id='$id'");
			   $execute = $sql->execute();
			   if($execute)
			   {					 
					 $sms = '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong> Counter information has been successfully deleted!</strong> </div>';
			   }  else {
					  $sms = '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Counter information delete unsuccessfull ! </div>';
			   }
		 }
?>



<script type="text/javascript">
		  function confirmation() {
		  return confirm('Are you sure you want to do this?');
			}
</script>
		
    <section class="content-header">
      <h1> Trip Information</h1>
	  
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
          <div class="box">
            <div class="box-header with-border"style="text-align:center;">
              <h3 class="box-title" style="font-weight: bolder;" >All Trip Inforamtion</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th>Sl.</th>
                  <th>Bus No.</th>                                          
                  <th>Bus Type</th>                                          
                  <th>From</th>
                  <th>To</th>
                  <th>Fare</th>
                  <th>Date</th>
                  <th>Departure</th>
                  <th>Arrival</th>                                            
                  <th>Seat Book</th>
                </tr>
				
		   <?php
		   
		   	$i=1;
		    foreach($data as $value)
		    {
		    ?>
			    <tr>
                  <td> <h5><?php echo $i; ?></h5></td>                                           
                  <td><h5><?php echo $value['bus_no']; ?></h5></td>                                           
                  <td><h5><?php echo $value['bus_type']; ?></h5></td>                                           
                  <td><h5><?php echo  $value['from_city']; ?></h5></td>                                           
                  <td><h5><?php echo  $value['to_city']; ?></h5></td>                                           
                  <td><h5>৳. <?php echo  $value['fare']; ?></h5></td>                                           
                  <td><h5><?php echo  $value['date']; ?></h5></td>                                           
                  <td><h5><?php echo date('h:i A', strtotime($value['departure_time'])); ?></h5></td>                                           
                  <td><h5><?php echo date('h:i A', strtotime($value['arrival_time'])); ?></h5></td> 
                  <td class="center">							
												
					<a class="btn btn-xs btn-success" href="" data-toggle="modal" data-target="#seatModal<?php echo $i; ?>">
                        <i class="fa fa-building"></i> seat book
                    </a>					
												
				 </td>
                </tr>
				
				<?php
				$i++;
				}
				?>

              </table>
            </div>
            
        </div>
        </div>
       
      </div>
      <!-- /.box -->
	  
	  <!-----Modal------->
	  
	  	  <?php
		   
		   	$j=1;
		    foreach($data as $value)
		    {
				
			?>
			
	     <div class="modal fade" id="seatModal<?php echo $j; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>                
                <h4 class="modal-title">Bus Seat Layout</h4>
              </div>
              <div class="modal-body">
			  <?php 
				$sqll = $conn->prepare("SELECT * FROM tbl_booked_seats WHERE trip_id='".$value['trip_id']."'");
				$sqll->execute();
				$dataa= $sqll->fetchAll();
				//$dataa= $sqll->fetch(PDO::FETCH_ASSOC);
				//echo "<pre>";print_r($dataa);
				//echo $dataa[0];
				$booked_seats = array();
				for ($i=0; $i<count($dataa); $i++) {
					if($dataa[$i]['seat_status'] == 1) {
						array_push($booked_seats, $dataa[$i]['seat_no']);
					}
				}
				
				//print_r($booked_seats); exit;
				//foreach($booked_seats as $value){echo "$value".',';}
			  ?>
                <form method="post" action="index.php?page=booking_details">
				     <input type="hidden" name="agent_id" value="<?php echo $value['agent_id']; ?>"/>
				     <input type="hidden" name="bus_id" value="<?php echo $value['bus_id']; ?>"/>
				     <input type="hidden" name="trip_id" value="<?php echo $value['trip_id']; ?>"/>
				     <input type="hidden" name="counter_id" value="<?php echo $counter_id; ?>"/>
								
								
				    <table height="500" width="400" border="0" cellspacing="0" cellpadding="0" align="center">
			              <tr height="60" class="top">
			              	<td colspan="3" style="font-weight:bolder;"> <i class="fa fa-check-square-o"></i> Already Booked </td>
			              	<td colspan="2"> Driver</td>
			              </tr>
			               
			               <tr>
			                   <td> <div class="seatbox">A1 <input type="checkbox" name="seat[]" value="A1"
				     		       <?php if(in_array("A1", $booked_seats)){ ?> checked disabled <?php } ?>></div> </td>
				     		
			                    <td><div class="seatbox">A2 <input type="checkbox"  name="seat[]" value="A2"
				     		       <?php if(in_array("A2", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
				     		
			                    <td width="40"></td>
				     		
			                    <td><div class="seatbox">A3 <input type="checkbox" name="seat[]" value="A3"
				     		        <?php if(in_array("A3", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">A4 <input type="checkbox" name="seat[]" value="A4"
							        <?php if(in_array("A4", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
			               </tr>
			                                
			                <tr>
			                    <td><div class="seatbox">B1 <input type="checkbox" name="seat[]" value="B1" 												
									<?php if(in_array("B1", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">B2 <input type="checkbox" name="seat[]" value="B2"
									<?php if(in_array("B2", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td></td>
												 
			                    <td><div class="seatbox">B3 <input type="checkbox" name="seat[]" value="B3" 
									<?php if(in_array("B3", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">B4 <input type="checkbox" name="seat[]" value="B4" 
									<?php if(in_array("B4", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
			               </tr>
			                                
			                <tr>
			                    <td><div class="seatbox">C1 <input type="checkbox" name="seat[]" value="C1"
									<?php if(in_array("C1", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">C2 <input type="checkbox" name="seat[]" value="C2"
									<?php if(in_array("C2", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td></td>
												
			                    <td><div class="seatbox">C3 <input type="checkbox" name="seat[]" value="C3"
									<?php if(in_array("C3", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">C4 <input type="checkbox" name="seat[]" value="C4"
									<?php if(in_array("C4", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
			                </tr>
			                                
			                <tr>
			                    <td><div class="seatbox">D1 <input type="checkbox" name="seat[]" value="D1"
									<?php if(in_array("D1", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">D2 <input type="checkbox" name="seat[]" value="D2"
									<?php if(in_array("D2", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td></td>
												
			                    <td><div class="seatbox">D3 <input type="checkbox" name="seat[]" value="D3"
									<?php if(in_array("D3", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">D4 <input type="checkbox" name="seat[]" value="D4"
									<?php if(in_array("D4", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
			                </tr>
			                                
			                <tr>
			                    <td><div class="seatbox">E1 <input type="checkbox" name="seat[]" value="E1"
									<?php if(in_array("E1", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">E2 <input type="checkbox" name="seat[]" value="E2"
									<?php if(in_array("E2", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td></td>
												
			                    <td><div class="seatbox">E3 <input type="checkbox" name="seat[]" value="E3"												
									<?php if(in_array("E3", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">E4 <input type="checkbox" name="seat[]" value="E4"
									<?php if(in_array("E4", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
			                </tr>
			                                
			                <tr>
			                    <td><div class="seatbox">F1 <input type="checkbox" name="seat[]" value="F1"												
									<?php if(in_array("F1", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">F2 <input type="checkbox" name="seat[]" value="F2"
									<?php if(in_array("F2", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td></td>
												
			                    <td><div class="seatbox">F3 <input type="checkbox" name="seat[]" value="F3"												
									<?php if(in_array("F3",$booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">F4 <input type="checkbox" name="seat[]" value="F4"
									<?php if(in_array("F4", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
			                </tr>
			                                
			                <tr>
			                    <td><div class="seatbox">G1 <input type="checkbox" name="seat[]" value="A3"
									<?php if(in_array("G1", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">G2 <input type="checkbox" name="seat[]" value="G2"
									<?php if(in_array("G2", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td></td>
												
			                    <td><div class="seatbox">G3 <input type="checkbox"  name="seat[]" value="G3"
									<?php if(in_array("G3", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">G4 <input type="checkbox" name="seat[]" value="G4"
									<?php if(in_array("G4", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
			                </tr>
			                                
			                <tr>
			                    <td><div class="seatbox">H1 <input type="checkbox" name="seat[]" value="H1"
									<?php if(in_array("H1", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">H2 <input type="checkbox" name="seat[]" value="H2"
									<?php if(in_array("H2", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td></td>
												
			                    <td><div class="seatbox">H3 <input type="checkbox" name="seat[]" value="H3"
									<?php if(in_array("H3", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">H4 <input type="checkbox" name="seat[]" value="H4"
									<?php if(in_array("H4", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
			                </tr>
			                                
			                <tr>
			                    <td><div class="seatbox">I1 <input type="checkbox" name="seat[]" value="I1"
									<?php if(in_array("I1", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">I2 <input type="checkbox" name="seat[]" value="I2"
									<?php if(in_array("I2", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td></td>    
												
			                    <td><div class="seatbox">I3 <input type="checkbox" name="seat[]" value="I3"
									<?php if(in_array("I3", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">I4 <input type="checkbox" name="seat[]" value="I4"
									<?php if(in_array("I4", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
			                </tr>
			                                
			                <tr class="top">
			                    <td><div class="seatbox">J1 <input type="checkbox" name="seat[]" value="j1"
									<?php if(in_array("J1", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">J2 <input type="checkbox" name="seat[]" value="j2"
									<?php if(in_array("J2", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td></td>
												
			                    <td><div class="seatbox">J3 <input type="checkbox" name="seat[]" value="J3"
									<?php if(in_array("J3", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
												
			                    <td><div class="seatbox">J4 <input type="checkbox" name="seat[]" value="J4"
									<?php if(in_array("J4", $booked_seats)){ ?> checked disabled <?php } ?>></div></td>
			                </tr>
											
								                                
			                <tr height="50" >
			                    <td colspan="5"><button  name="proceed" class="btn btn-primary"> Proceed To Reservation </button></td>
			                </tr>			                                

		            </table>
				
				</form>

     
              </div>
			  

            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
		
		<?php
		$j++;	
		}			
		?>

    </section>
    <!-- /.content -->
  </div>
