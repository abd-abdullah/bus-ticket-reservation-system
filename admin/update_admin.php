<?php
  $id = $_GET['id'];
  $admin_by_id = $admin_info->GetAdminById($id);
  $data = $admin_by_id->fetch_assoc();


  if (isset($_POST['btn'])) {
      $update_admin = $admin_info->UpdateAdminById($_POST,$_FILES,$id);
      $sms = '<div class="alert alert-success alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$update_admin.'</strong> </div>';
           //header('location:index.php');
    }
?>

<!--Page content Stats-->

    <section class="content-header">
      <h1>Add Admin Information</h1>
      
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
              <h3 class="box-title">Add  Admin Information </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
			
                <div class="box-body">				
				  
          <div class="form-group">
              <label>Select Role </label>
              <select required class="form-control" name="status">
                <option value="">Select admin role....</option>
                
                <option <?php if($data['activation_status']==1){ echo 'selected';  } ?> value="1" >Main Admin</option>
                <option <?php if($data['activation_status']==2){ echo 'selected'; } ?> value="2">Sub Admin</option>      
              </select>
            </div>

				  <div class="form-group">
                  <label for="">Name:</label>
                  <input required type="text" class="form-control"  name="admin_name"  value="<?php echo $data['name']; ?>">
                </div>
				
                <div class="form-group">
                  <label for="">Email:</label>
                  <input required type="text" class="form-control"  name="admin_email"  value="<?php echo $data['email']; ?>">
                </div>
				
				<div class="form-group">
                  <label for="">Contact No:</label>
                  <input required type="text" class="form-control"  name="admin_contact" value="<?php echo $data['phone_number']; ?>">
                </div>
				
				<div class="form-group">
                  <label for="">Address:</label>
                  <input required type="text" class="form-control"  name="admin_address" value="<?php echo $data['address']; ?>">
                </div>

             
			    <div class="form-group">
                  <label for="">Password:</label>
                  <input required type="text" class="form-control"  name="password" value="<?php echo $data['password']; ?>">
                </div>    

				
				<div class="form-group">
                  <label for="">Choose a Picture</label>
				  <img src="<?php echo $data['img_url']; ?>" height="80" width="80">
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
