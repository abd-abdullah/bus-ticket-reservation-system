<?php
if (isset($_POST['btn'])) {
		$city_insert = $city->InsertCity($_POST);

		$sms = '<div class="alert alert-success alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$city_insert.'</strong> </div>';
  }
?>	

<!----------Page content Stats--------------->

    <section class="content-header">
      <h1>Add Bus Information</h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">City Information Form</h3>

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
              <h3 class="box-title">Add City</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="">City:</label>
                  <input required type="text" class="form-control" name="city_name" id="" placeholder="Enter City Name">
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
