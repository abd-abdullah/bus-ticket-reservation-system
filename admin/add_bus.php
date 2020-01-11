<?php
if (isset($_POST['btn'])) {
    $bus_insert = $bus_info->InsertBus($_POST,$_FILES);

    $sms = '<div class="alert alert-success alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$bus_insert.'</strong> </div>';
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
          <h3 class="box-title">Bus Information Form</h3>

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
              <h3 class="box-title">Add Your Bus Information </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="">Bus NO:</label>
                  <input required="" type="text" class="form-control" name="bus_no" id="" placeholder="Enter Bus No">
                </div>
             
			      <div class="form-group">
                  <label>Select Bus Type</label>
                  <select required="" class="form-control" name="bus_type">
                    <option value="" >Select a Bus Type...</option>
                    <option>A/C Sleeper</option>
                    <option>Non A/C</option>      
                  </select>
                </div>
				
				
                <div class="form-group">
                  <label for="">Choose a Picture</label>
                  <input required type="file" name="image"  id="">
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
