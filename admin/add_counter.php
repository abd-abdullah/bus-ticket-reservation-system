<?php
$AllCity = $city->GetAllCityByUniqueName();
$AllCity = mysqli_fetch_all($AllCity,MYSQLI_ASSOC);


if (isset($_POST['btn'])) {
    $counter_insert = $counter_info->InsertCounter($_POST);

    $sms = '<div class="alert alert-success alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$counter_insert.'</strong> </div>';
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
          <h3 class="box-title">Counter Information Form</h3>

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
              <h3 class="box-title">Add Your Counter Information </h3>
            </div>
			
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="">Counter Name:</label>
                  <input required="" type="text" class="form-control" name="counter_name"  id="" placeholder="Enter Counter Name">
                </div> 

                 <div class="form-group">
                  <label>Select City:</label>
                  <select required class="form-control" name="city_name">
                    <option value="" >Select City...</option>
      					<?php 
                  foreach($AllCity as $value)
                  {
                ?>                    
                     <option value="<?php echo $value['city_name']; ?>"><?php echo $value['city_name']; ?></option> 

                  <?php
        					  }
        					?>	
                          
                  </select>
                </div>	

				<div class="form-group">
                  <label for="">Contact No:</label>
                  <input required="" type="text" class="form-control" name="contact_no" value=""  id="" placeholder="Enter Contact No">
                </div>
				
				 <div class="form-group">
                  <label for="">Counter Location:</label>
                  <input required="" type="text" class="form-control" name="location_counter"  id="" placeholder="Enter Counter Location">
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
