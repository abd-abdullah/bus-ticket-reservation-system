<?php
  $id = $_GET['id'];
  $agent_by_id = $agent_info->GetAgentById($id);
  $data = $agent_by_id->fetch_assoc();

   $AllCounter = $counter_info->GetAllCounter();
  $valueCounter = mysqli_fetch_all($AllCounter,MYSQLI_ASSOC);

  if (isset($_POST['btn'])) {
      $update_agent = $agent_info->UpdateAgentById($_POST,$_FILES,$id);
      $sms = '<div class="alert alert-success alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$update_agent.'</strong> </div>';
           //header('location:index.php');
    }
?>

<!--Page content Stats-->

    <section class="content-header">
      <h1>Add Agent Information</h1>
      
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
              <h3 class="box-title">Add Agent Information </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
			
                <div class="box-body">				
				
			      <div class="form-group">
                  <label value="">Select Bus Counter:</label>
                  <select required class="form-control" name="counter_id">
                    <option value="">Select Counter</option>
					<?php 
					foreach($valueCounter as $vCounter)
					  {
					?>
                     <option <?php if($vCounter['counter_id']==$data['counter_id']) echo 'selected'; ?> value="<?php echo $vCounter['counter_id']; ?>"><?php echo $vCounter['counter_name']; ?></option>
                                                
					<?php
					  }
					?>
                          
                  </select>
                </div>

				<div class="form-group">
                  <label for="">Name:</label>
                  <input required type="text" class="form-control"  name="agent_name"  value="<?php echo $data['name']; ?>">
                </div>
				
                <div class="form-group">
                  <label for="">Email:</label>
                  <input required type="text" class="form-control"  name="agent_email"  value="<?php echo $data['email']; ?>">
                </div>
				
				<div class="form-group">
                  <label for="">Contact No:</label>
                  <input required type="text" class="form-control"  name="agent_contact" value="<?php echo $data['phone_number']; ?>">
                </div>
				
				<div class="form-group">
                  <label for="">Address:</label>
                  <input required type="text" class="form-control"  name="agent_address" value="<?php echo $data['address']; ?>">
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
