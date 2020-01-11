<?php
   
		$agent_id= $_SESSION['agent_id'];
		$bus_id= $_SESSION['bus_id'];
		$trip_id= $_SESSION['trip_id'];
		$counter_id= $_SESSION['counter_id'];
		$seat=$_SESSION['seat'];
		$pnr_no= $_POST['pnr_no'];
	//	echo "<pre>";print_r($seat);exit;

	    $sql = $conn->prepare("SELECT * FROM tbl_trip_info,tbl_agent_info,tbl_counter_info WHERE tbl_agent_info.agent_id=tbl_trip_info.agent_id AND tbl_counter_info.agent_id=tbl_agent_info.agent_id AND tbl_agent_info.agent_id='$agent_id' AND tbl_counter_info.counter_id='$counter_id' AND tbl_trip_info.trip_id='$trip_id' ");
	    $sql->execute();
	    $data = $sql->fetch(PDO::FETCH_ASSOC);
      // echo "<pre>";print_r($data);exit;

	if (isset($_POST['btn'])) {

     	$pnr_no = $_POST['pnr_no'];
		$bus_id = $_SESSION['bus_id'];
		$trip_id = $_SESSION['trip_id'];
		$counter_id = $_SESSION['counter_id'];
		$reference_no = 'counter';
		$passenger_name = $_POST['passenger_name'];
		$passenger_gender = $_POST['passenger_gender'];
		$passenger_email = $_POST['passenger_email'];
		$passenger_contact = $_POST['passenger_contact'];
		$booking_status = 'approved';
		$seat_status = 1;
		$seat = $_SESSION['seat'];

		if (!empty($passenger_name) && !empty($passenger_gender)&& !empty($passenger_email) && !empty($passenger_gender)&& !empty($passenger_contact) ) {
			try {
									
					for($i=0;$i<count($seat);$i++)
					{
						$dataseat = array($pnr_no,$trip_id,$bus_id,$seat[$i],$seat_status);
						$sqlseat = "insert into tbl_booked_seats(pnr_no,trip_id,bus_id,seat_no,seat_status)values(?,?,?,?,?)";
						$stmtt = $conn->prepare($sqlseat);
						$endd = $stmtt->execute($dataseat);
					}
					
					$databook = array($pnr_no ,$trip_id,$counter_id,$reference_no,$passenger_name,$passenger_gender ,$passenger_email,$passenger_contact,$booking_status);
					$sqlbook = "insert into tbl_booking_info(pnr_no,trip_id,counter_id,reference_no,passenger_name,passenger_gender,passenger_email,passenger_contact,booking_status )values(?,?,?,?,?,?,?,?,?)";
					$stmt = $conn->prepare($sqlbook);
					$end = $stmt->execute($databook);

					
					if ($end && $endd) {
					   $sms = '<div class="alert alert-success alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Indicates a successful or positive action.</div>';
					} else {
						$sms = '<div class="alert alert-danger alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Unsuccess!</strong> Indicates a unsuccessful or negative action.</div>';
					}
				}  catch(PDOException $e){
								 echo "Operation failed: " . $e->getMessage();
							}

	         }	

		else {
			$sms = '<div class="alert alert-warning alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Unsuccess!</strong> Sorry you must fillup all the field .....</div>';
		}			 
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
		
		<?php if(isset($sms)){echo $sms;} ?>
		
        <div class="box-body">
		<div class="col-md-9 col-md-offset-2">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
			<div class="panel-heading" style="background-color:#995127; height: 60px;"><p style="font-size:30px;color:white;">Journey Details</p></div>
			
			<form role="form" method="post">
			
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
						   <td><?php foreach($seat as $value) { echo "$value".','; } ?></td> 							
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
              <h3 class="box-title">Add Booking Details </h3>
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
                  <div class="radio">
                    <label>
                      <input type="radio" name="passenger_gender" id="optionsRadios1" value="Male">Male</label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="passenger_gender" id="optionsRadios2" value="Female">Female</label>
                  </div>

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
                <button type="submit" name="btn" class="btn btn-primary col-md-offset-5">Submit</button>
              </div>
            </form>
          </div>
          
        </div>
        </div>


 
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
