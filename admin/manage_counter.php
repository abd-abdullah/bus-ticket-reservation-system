<?php
  $AllCounter = $counter_info->GetAllCounter();
  $AllCounter = mysqli_fetch_all($AllCounter,MYSQLI_ASSOC);
	
  if(isset($_POST['delete'])){
    $id = $_POST['counter_id'];
    $delet_counter = $counter_info->DeleteCounterById($id);
    $sms = '<div class="alert alert-success alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$delet_counter.'</strong> </div>';
  }

?>



    <section class="content-header">
      <h1>Manage Counter Information</h1>
	  
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
		
          <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border"style="text-align:center;">
              <h3 class="box-title" style="font-weight: bolder;" >All Counter Inforamtion</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th>Sl.</th>
                  <th>Counter Name</th>
                  <th>City</th>
                  <th>Contact No</th>
                  <th>Counter Location</th>

                  <!-- Only Admin can access this section -->
                  <?php if(Session::get('admin_login')) { ?>
                  <th>Action</th> <?php } ?>
                </tr>
				
		   <?php
		   $i=1;
		    foreach($AllCounter as $value)
		    {
		    ?>
                		 
			<form  method="post" action="">
			    <tr>
                  <td> <?php echo  $i; ?></td>
                  <td><?php echo  $value['counter_name']; ?></td>                                           
                  <td><?php echo  $value['city_name']; ?></td> 
                  <td> <?php echo  $value['contact_no']; ?> </td> 				  
                  <td><?php echo  $value['location_counter']; ?></td>
                    

                  <!-- Only Admin can access this section -->
                  <?php if(Session::get('admin_login')) { ?>

                  <td class="center">
                    <button class="btn btn-xs btn-danger" type="submit" name="delete" onclick="return confirm('Are you sure to delete?')">
                      <i class="fa fa-fw fa-trash"></i>Delete</a>
                    </button>
                    <input type="hidden" name="counter_id" value="<?php echo $value['counter_id']; ?>">            
                    <a class="btn btn-xs btn-info" href="dashboard.php?page=update_counter&id=<?php echo $value['counter_id']; ?>">
                      <i class="fa fa-fw fa-edit"></i>Edit</a>
                    </a>
                  </td>

                  <?php } ?>
                
                </tr>
				
				</form>
				<?php
				$i++;
				}
				?>
     
              </table>
            </div>
            
        </div>
        </div>
       
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
