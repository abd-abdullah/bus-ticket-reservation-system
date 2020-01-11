<?php
$AllCity = $city->GetAllCityByUniqueName();
$AllCity = mysqli_fetch_all($AllCity,MYSQLI_ASSOC);

$AllBus = $bus_info->GetAllBus();
$data = mysqli_fetch_all($AllBus,MYSQLI_ASSOC);
 
if (isset($_POST['btn'])) {
  $insert_trip = $trip_info->InsertTrip($_POST);
   $sms = '<div class="alert alert-success alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$insert_trip.'</strong> </div>';
}

?>

<!----------Page content Stats--------------->

    <section class="content-header">
      <h1>Add Trip Information</h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Trip Information Form</h3>

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
		<div class="col-md-8 col-md-offset-2">
		     <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Your Trip Information </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
			
                <div class="box-body">

				
				<div class="form-group">
                  <label>Select a Bus:</label>
                  <select required class="form-control" name="bus_id">
                    <option value="">Select Bus No...</option>
					<?php 
					foreach($data as $vBus)
					  {
					?>                        
                     <option value="<?php echo $vBus['bus_id']; ?>"><?php echo $vBus['bus_no']; ?></option> 

                    <?php
					  }
					?>	
                          
                  </select>
                </div>
				
				
                <div class="form-group">
                  <label>From City:</label>
                  <select required class="form-control" name="from_city">
                    <option value="">Select City...</option>
					<?php 
					foreach($AllCity as $vCity)
					  {
					?>                        
                     <option value="<?php echo $vCity['city_name']; ?>"><?php echo $vCity['city_name']; ?></option> 

                    <?php
					  }
					?>	
                          
                  </select>
                </div>
				
                <div class="form-group">
                  <label>To City:</label>
                  <select required class="form-control" name="to_city">
                    <option value="">Select City...</option>
					<?php 
					foreach($AllCity as $vCity)
					  {
					?>                        
                     <option value="<?php echo $vCity['city_name']; ?>"><?php echo $vCity['city_name']; ?></option> 

                    <?php
					  }
					?>	
                          
                  </select>
                </div>
				
				<div class="form-group">
                  <label for="">Fare:</label>
                  <input required type="text" class="form-control"  name="fare" id="" placeholder="Enter The Price of Trip">
                </div>
				
             
			    <div class="form-group">
                  <label for="">Departure Time:</label>
                  <input required type="time" class="form-control"  name="dept_time" id="" placeholder="Enter Departure Time">
                </div>
				
				 <div class="form-group">
                  <label for="">Arriaval Time:</label>
                  <input required type="time" class="form-control" name="arrival_time" id="" placeholder="Enter Arriaval Time">
                </div>
							     
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="btn" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          
        </div>
        </div>


 
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
