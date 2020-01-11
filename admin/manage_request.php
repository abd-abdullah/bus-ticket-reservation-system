<?php
  $AllBooking = $booking_info->GetAllBookingWithUser();
  $data = mysqli_fetch_all($AllBooking,MYSQLI_ASSOC);
  
?>

   
?>



<script type="text/javascript">
		  function confirmation() {
		  return confirm('Are you sure you want to do this?');
			}
</script>
		
    <section class="content-header">
      <h1>Manage Booking Requests</h1>
	  
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
              <h3 class="box-title" style="font-weight: bolder;" >All Booking Requests</h3>
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
                  <td><h5><?php echo  $value['name']; ?></h5></td>                                                                                    
                  <td><h5><?php echo  $value['email']; ?></h5></td>                                           
                  <td><h5><?php echo  $value['mobile']; ?></h5></td>                                           
                  <td><h5><?php echo  $value['booking_date']; ?> </h5></td>                                           
                  <td><?php if ( $value['booking_status'] == 1){ ?><a class="btn btn-xs btn-success"><span class="glyphicon glyphicon-check"></span> approved</a><?php }elseif( $value['booking_status'] == 0){?><a class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-off"></span> pending</a><?php }elseif( $value['booking_status'] == '2'){?><a class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove-sign"></span> cancelled</a><?php }?></td>                                           
				  <td><a href="dashboard.php?page=view_request&id=<?php echo $value['booking_id']; ?>" class="btn btn-xs btn-info"><i class="fa fa-clock-o"></i> View details</a></td>	

                </tr>
								
				<?php
			    $i++;
				}
				?>

              </table> <br />
			  
			  </form>
				
            </div>
            
        </div>
        </div>
       
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
