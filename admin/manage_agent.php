<?php	
$all_agent = $agent_info->GetAllAgentAndCounter();
if($all_agent)
$data = mysqli_fetch_all($all_agent,MYSQLI_ASSOC);
  
if(isset($_POST['delete'])){
    $id = $_POST['agent_id'];
    $delet_agent = $agent_info->DeleteAgentById($id);
    $sms = '<div class="alert alert-success alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$delet_agent.'</strong> </div>';
}

if(isset($_POST['btn_status'])){
    $id = $_POST['agent_id'];
    $status= $_POST['status'];
    $update_status = $agent_info->ChangeStatus($status, $id);
    $sms = '<div class="alert alert-success alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$update_status.'</strong> </div>';
}

?>


<script type="text/javascript">
		  function confirmation() {
		  return confirm('Are you sure you want to do this?');
			}
		</script>

    <section class="content-header">
      <h1>Manage Agent Information</h1>
	  
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
              <h3 class="box-title" style="font-weight: bolder;" >All Agent Inforamtion</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th>Sl.</th>
                  <th>Agent Name</th>
                  <th>Counter Name</th>
                  <th>Email</th>
                  <th>Contact No</th>
                  <th>Address</th>
                  <th>Image</th>
				  <th>Status</th>
                  <th>Change Status</th>
                  <th>Action</th>
                </tr>
				
		   <?php
		   if($all_agent){
			    $i=1;
			    foreach($data as $value)
			    { 
			    ?>
                		 
			<form  method="post" action="">
			    <tr>
                  <td><?php  echo $i;?></td>
                  <td><?php echo  $value['name']; ?></td>
                  <td><?php echo  $value['counter_name']; ?></td>
                  <td><?php echo  $value['email']; ?></td>
                  <td><?php echo  $value['phone_number']; ?> </td>
                  <td><?php echo  $value['address']; ?> </td>
                  
                  <td class="center"><img src="<?php echo  $value['img_url']; ?>" height="80" width="80"></td>

				  <td><span><?php if($value['active_status'] == 1){ ?><a class="btn btn-success">Active</a><?php }else{?><a class="btn btn-danger"  href="#">Blocked</a><?php } ?></span></td>
                  
                  <td><span><?php if($value['active_status'] == 1)
				  { ?>
			  
				  <button type="submit"  class="btn btn-danger" name="btn_status"><span class="glyphicon glyphicon-off"></span> Block</button>	
                  <input type="hidden" name="agent_id" value="<?php echo $value['agent_id']; ?>">
                  <input type="hidden" name="status" value="0">	
				  
				  <?php

				    }else{
					  
				  ?>
				  <button type="submit" class="btn btn-primary" name="status"><span class="glyphicon glyphicon-ok-sign"></span> Unblock</a>
				   <input type="hidden" name="agent_id" value="<?php echo $value['agent_id']; ?>">
				   <input type="hidden" name="status" value="1">	  					  					
				  <?php 
					} 
				  ?>
					  
				  </span></td>
                  
				  <td class="center">
					<button class="btn btn-xs btn-danger" type="submit" name="delete" onclick="return confirmation()">
					<span class="glyphicon glyphicon-trash"></span>
					</button>
						<input type="hidden" name="agent_id" value="<?php echo $value['agent_id']; ?>">
						
					<a class="btn btn-xs btn-info" href="dashboard.php?page=update_agent&id=<?php echo $value['agent_id']; ?>">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>						
												
				 </td>
                </tr>
					
				</form>
				<?php
			    $i++;
				} }
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
