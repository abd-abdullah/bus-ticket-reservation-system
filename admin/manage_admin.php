<?php
	$all_admin = $admin_info->GetAllAdmin();
	if($all_admin)
	$data = mysqli_fetch_all($all_admin,MYSQLI_ASSOC);
	  
	if(isset($_POST['delete'])){
	    $id = $_POST['admin_id'];
	    $delet_admin = $admin_info->DeleteAdminById($id);
	    $sms = '<div class="alert alert-success alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$delet_admin.'</strong> </div>';
	}

	if(isset($_POST['btn_status'])){
	    $id = $_POST['admin_id'];
	    $status= $_POST['status'];
	    $update_status = $admin_info->ChangeStatus($status, $id);
	    $sms = '<div class="alert alert-success alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$update_status.'</strong> </div>';
	}
?>

<script type="text/javascript">
	function confirmation() {
		return confirm('Are you sure you want to do this?');
	}
</script>

<!-- <script type="text/javascript">
	/*function update_role() {
		var r= confirm('Are you sure you want to do this?');
		if(r==true){

		}
		return r;
	}*/

	$("#update_role").click(function(){
  		return confirm('Are you sure you want to do this?');
	});
</script> -->

    <section class="content-header">
      <h1>Manage Admin Information</h1>
	  
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>

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
              <h3 class="box-title" style="font-weight: bolder;" >All Admin Inforamtion</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">Sl.</th>
                  <th>Admin Name</th>
                  <th>Email</th>
                  <th>Contact No</th>
                  <th>Address</th>
                  <th>Image</th>
				  <th>Status</th>
                  <th>Action</th>
                </tr>
				
		   <?php
		    $i=1;
		    foreach($data as $value)
		    { 
		    ?>
                		 
			<form  method="post" action="">
			    <tr>
                  <td><?php  echo $i;?></td>
                  <td><?php echo  $value['name']; ?></td>
                  <td><?php echo  $value['email']; ?></td>
                  <td><?php echo  $value['phone_number']; ?> </td>
                  <td><?php echo  $value['address']; ?> </td>
                  <td class="center"><img src="<?php echo  $value['img_url']; ?>" height="80" width="80"></td>

				  <td><span><?php if($value['activation_status'] == 1){ ?><a class="btn btn-success">Main Admin</a><?php } elseif($value['activation_status'] == 2){?><a class="btn btn-primary"  >Sub Admin</a><?php }else{ ?><a class="btn btn-danger">Blocked</a><?php } ?></span></td>
				
				<!-- <td class="center"><span>
					<div class="form-group">
						<form role="form" method="post">
							              <select style="width:100px;" required class="form-control" name="status">
							                <option value="">Select admin role....</option>
							                <option value="1">Main Admin</option>
							                <option value="2">Sub Admin</option>      
							              </select>
				
							                  <input type="hidden" name="admin_id" value="<?php echo $value['admin_id']; ?>">	
							<input  id="btn_status" type="submit"  class="btn btn-danger btn-xs" value="Submit" name="btn_status">
						</form>
						            </div>
						        </span></td> -->
				 <td class="center">
					<button class="btn btn-xs btn-danger" type="submit" name="delete" onclick="return confirmation()">
					<span class="glyphicon glyphicon-trash"></span>
					</button>
						<input type="hidden" name="admin_id" value="<?php echo $value['admin_id']; ?>">
						
					<a class="btn btn-xs btn-info" href="dashboard.php?page=update_admin&id=<?php echo $value['admin_id']; ?>">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>						
												
				 </td>
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
