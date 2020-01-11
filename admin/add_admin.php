<?php

if (isset($_POST['btn'])) {
    $insert_admin = $admin_info->InsertAdmin($_POST,$_FILES);

    $sms = '<div class="alert alert-success alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$insert_admin.'</strong> </div>';
}

?>

<!--Page content Stats-->

    <section class="content-header">
      <h1>Add admin Information</h1>
      
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
		<div class="col-md-8 col-md-offset-2">
		     <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add admin Information </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
			
        <div class="box-body">				
				
            <div class="form-group">
              <label>Select Role </label>
              <select required class="form-control" name="status">
                <option value="">Select admin role....</option>
                <option value="1">Main Admin</option>
                <option value="2">Sub Admin</option>      
              </select>
            </div>

				    <div class="form-group">
                  <label for="">Name:</label>
                  <input required type="text" class="form-control"  name="admin_name"  id="" placeholder="Enter admin Name">
                </div>
				
                <div class="form-group">
                  <label for="">Email:</label>
                  <input required type="text" class="form-control"  name="admin_email"  id="" placeholder="Enter admin Email">
                </div>
				
				<div class="form-group">
                  <label for="">Contact No:</label>
                  <input required type="text" class="form-control"  name="admin_contact" id="" placeholder="Enter admin Contact No">
                </div>
				
				<div class="form-group">
                  <label for="">Address:</label>
                  <input required type="text" class="form-control"  name="admin_address" id="" placeholder="Enter admin Address">
                </div>
				
             
			    <div class="form-group">
                  <label for="">Password:</label>
                  <input required type="password" class="form-control"  name="password" id="" placeholder="Enter Password">
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
