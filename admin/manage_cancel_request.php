<?php
	$sql = $conn->prepare("SELECT * FROM tbl_cancel_request, tbl_booking_info WHERE tbl_cancel_request.pnr_no=tbl_booking_info.pnr_no AND tbl_booking_info.counter_id='$counter_id' ORDER BY tbl_cancel_request.request_id DESC");
	$sql->execute();
	$data = $sql->fetchAll();
		
	$sqlseat = $conn->prepare("SELECT tbl_booking_info.pnr_no,tbl_booked_seats.seat_no FROM tbl_booking_info INNER JOIN tbl_booked_seats ON tbl_booking_info.pnr_no=tbl_booked_seats.pnr_no WHERE tbl_booking_info.counter_id='$counter_id'");
	$sqlseat->execute();
	$seatdata = $sqlseat->fetchAll();
	
	if(isset($_POST['delete']))
		 { 
			   $sqlautoDel = $conn->prepare("DELETE FROM tbl_booking_info WHERE tbl_booking_info.booking_status='pending' AND tbl_booking_info.booking_date < DATE_SUB(NOW(), INTERVAL 1 minute);");
	           $execute = $sql->execute();
			   if($execute)
			   {					 
					 $sms = '<div class="alert alert-success alert-dismissable" style="text-align:center; font-size:25px;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong> Booking Request Deleted!</strong> </div>';
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
      <h1>Manage Booking Cancellation Requests</h1>
	  
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
              <h3 class="box-title" style="font-weight: bolder;" >All Booking Cancellation Requests</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th>Sl.</th>
                  <th>PNR No</th>                                          
                  <th>Passenger Name</th>                                             
                  <th>Email</th>
                  <th>Contact No</th>
                  <th>Booking Date</th>
                  <th>Cancel Date</th>
                  <th>Request Status</th>                                                      
                  <th>Action</th>

                </tr>
		   <?php
		  
		    $i=1;
		    foreach($data as $value)
		    { 
			 //foreach($seatdata as $v){ foreach($v as $c){} }
		    ?>
                		 
			<form  method="post" action="">
			    <tr>
                  <td><h5><?php echo $i; ?></h5></td>                                           
                  <td><h5><?php echo $value['pnr_no']; ?></h5></td>                                           
                  <td><h5><?php echo  $value['passenger_name']; ?></h5></td>                                                                                    
                  <td><h5><?php echo  $value['passenger_email']; ?></h5></td>                                           
                  <td><h5><?php echo  $value['passenger_contact']; ?></h5></td>                                           
                  <td><h5><?php echo  $value['booking_date']; ?> </h5></td>                                           
                  <td><h5><?php echo  $value['cancel_date']; ?> </h5></td>                                           
                  <td><?php if ( $value['cancel_status'] == 'approved'){ ?><a class="btn btn-xs btn-success"><span class="glyphicon glyphicon-check"></span> approved</a><?php }elseif( $value['cancel_status'] == 'pending'){?><a class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-off"></span> pending</a><?php }elseif( $value['cancel_status'] == 'cancelled'){?><a class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove-sign"></span> cancelled</a><?php }?></td>                                           
				  <td><a href="index.php?page=view_cancel_request&id=<?php echo $value['pnr_no']; ?>" class="btn btn-xs btn-info"><i class="fa fa-clock-o"></i> View details</a></td>	

                </tr>
								
				<?php
			    $i++;
				}
				?>

              </table> <br />
			  
			  <button type="submit" name="delete" class="btn btn-lg btn-danger col-md-offset-9" onclick="return confirmation()"><i class="fa fa-trash-o"></i> Delete Old Request</button>
			  </form>
				
            </div>
            
        </div>
        </div>
       
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
