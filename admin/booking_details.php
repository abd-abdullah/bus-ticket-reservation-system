<?php
    	  
		$agent_id = $_POST['agent_id'];
		$bus_id = $_POST['bus_id'];
		$trip_id = $_POST['trip_id'];
		$counter_id = $_POST['counter_id'];
		$seat = $_POST['seat'];
		//echo "<pre>";print_r($seat);exit;
		
		if (!empty($seat)){  		
		$_SESSION['agent_id']=$agent_id;
		$_SESSION['bus_id']=$bus_id;
		$_SESSION['trip_id']=$trip_id;
		$_SESSION['counter_id']=$counter_id;
		$_SESSION['seat']=$seat;
		$_SESSION['pnr_no']= rand();

	    $sql = $conn->prepare("SELECT * FROM tbl_trip_info,tbl_agent_info,tbl_counter_info WHERE tbl_agent_info.agent_id=tbl_trip_info.agent_id AND tbl_counter_info.agent_id=tbl_agent_info.agent_id AND tbl_agent_info.agent_id='$agent_id' AND tbl_counter_info.counter_id='$counter_id' AND tbl_trip_info.trip_id='$trip_id' ");
	    $sql->execute();
	    $data = $sql->fetch(PDO::FETCH_ASSOC);
        //echo "<pre>";print_r($seat);exit;
	 } else{
		 
		$sms = '<div class="alert alert-danger alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> You did not book any seat. Please! book the seat first. </strong>';

	 }
  
?>	


    <section class="content-header">
      <h1>Add Counter Information</h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<?php if(isset($sms)){echo $sms; exit;} ?>	 
        <div class="box-body">

		<div class="col-md-9 col-md-offset-2">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
			<div class="panel-heading" style="background-color:#995127; height: 60px;"><p style="font-size:30px;color:white;">Journey Details</p></div>
			
			<form role="form" method="post" action="index.php?page=booking_details_db">
			
                        <tr>
                            <th>From City:</th>
                            <td><?php echo  $data['from_city']; ?></td>
							 <th>To City:</th>
                            <td><?php echo  $data['to_city']; ?></td> 
                      
                        </tr>
						
                        <tr>
                            <th>Bus Name:</th>
                            <td><?php echo  $data['company']; ?></td>
						   <th>Journey Date:</th>
						   <td><?php echo  $data['date']; ?></td> 							
                        </tr>         
						
						<tr>
                            <th>Departure Time:</th>
                            <td><?php echo  $data['departure_time']; ?></td>
						   <th>Seat No(s):</th>
						   <td><?php echo implode(',', $seat);  ?></td> 							
                        </tr>						
						
						<tr>
                            <th>Ticket Price:</th>
                            <td>৳. <?php echo  $data['fare']; ?></td>
						   <th>Total Price:</th>
						   <td>৳. <?php echo $data['fare']*count($seat);?></td> 							
                        </tr> 					
						
                    </table> <br />
					
		
		     <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Passenger Details </h3>
            </div>
			
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                <div class="form-group">
                  <label for="">Passenger Name:</label>
                  <input type="text" class="form-control" name="passenger_name"  id="" placeholder="Enter Passenger Name">
                </div> 

                <!-- radio -->
				 <div class="form-group">
				   <label for="gender" >Select Gender:</label> &nbsp;
                   <input type="radio" name="passenger_gender" value="Male"> Male  &nbsp;
                   <input type="radio" name="passenger_gender" value="Female"> Female<br>
                 </div>		
				
				 <div class="form-group">
                  <label for="">Email:</label>
                  <input type="email" class="form-control" name="passenger_email"  id="" placeholder="Enter Email">
                </div>	 
				
				<div class="form-group">
                  <label for="">Contact No::</label>
                  <input type="text" class="form-control" name="passenger_contact"  id="" placeholder="Enter Contact No:">
                </div>
	
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="btn" class="btn btn-primary col-md-3 col-md-offset-4">Submit</button>
              </div>
			  
			  <input type="hidden" name="pnr_no" value="<?php echo $_SESSION['pnr_no']; ?>">	

            </form>
          </div>
          
        </div>
        </div>


 
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
