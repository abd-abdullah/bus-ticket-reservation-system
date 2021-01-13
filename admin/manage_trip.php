<?php	
$all_trip = $trip_info->GetAllTripAndBus();
$all_trip = $all_trip->fetch_array(MYSQLI_ASSOC);
  
  if(isset($_POST['delete'])){
    $id = $_POST['trip_id'];
    $delet_trip = $trip_info->DeleteTripById($id);
    $sms = '<div class="alert alert-success alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$delet_trip.'</strong> </div>';
  }
?>



<script type="text/javascript">
		  function confirmation() {
		  return confirm('Are you sure you want to do this?');
			}
</script>
		
    <section class="content-header">
      <h1>Manage Trip Information</h1>
	  
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Trip Information Table</h3>

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
              <h3 class="box-title" style="font-weight: bolder;" >All Trip Inforamtion</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th>Sl.</th>
                  <th>Bus No.</th>            
                  <th>Bus Type</th>           
                  <th>From</th>
                  <th>To</th>
                  <th>Fare</th>
                  <th>Departure</th>
                  <th>Arrival</th> 
                  <!-- Only Admin can access this section -->
                  <?php if(Session::get('admin_login')) { ?>          
                  <th>Action</th>
                  <?php } ?>
                </tr>
				
		   		   <?php
		    $i=1;
		    foreach($all_trip as $value)
		    {
		    ?>
                		 
			<form  method="post" action="">
			    <tr>
                  <td> <?php echo  $i; ?></td>
                  <td><?php echo  $value['bus_no']; ?></td>                                           
                  <td><?php echo  $value['bus_type']; ?></td>                                           
                  <td><?php echo  $value['from_city']; ?></td>                                           
                  <td><?php echo  $value['to_city']; ?></td>
                  <td>৳. <?php echo  $value['fare']; ?></td>
                  
                  <td><?php echo date('h:i A', strtotime($value['departure_time'])); ?></td>
                  <td><?php echo date('h:i A', strtotime($value['arrival_time'])); ?></td>
                  
                  <!-- Only Admin can access this section -->
                  <?php if(Session::get('admin_login')) { ?>
                  <td class="center">
					 <button class="btn btn-xs btn-danger" type="submit" name="delete" onclick="return confirmation()">
					    <span class="glyphicon glyphicon-trash"></span>
					</button>
					<input type="hidden" name="trip_id" value="<?php echo $value['trip_id']; ?>">								
												
					<a class="btn btn-xs btn-info" href="dashboard.php?page=update_trip&id=<?php echo $value['trip_id']; ?>">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>						
												
				 </td> <?php } ?>
        
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
