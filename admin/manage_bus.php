<?php
$AllBus = $bus_info->GetAllBus();
$data = mysqli_fetch_all($AllBus,MYSQLI_ASSOC);
  
  if(isset($_POST['delete'])){
    $id = $_POST['bus_id'];
    $delet_bus = $bus_info->DeleteBusById($id);
    $sms = '<div class="alert alert-success alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$delet_bus.'</strong> </div>';
  }

?>

<script type="text/javascript">
		  function confirmation() {
		  return confirm('Are you sure you want to do this?');
			}
		</script>

    <section class="content-header">
      <h1>Manage Bus Information</h1>
	  
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Bus Information Table</h3>

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
              <h3 class="box-title" style="font-weight: bolder;" >All Bus Inforamtion</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">Sl.</th>
                  <th>Bus No</th>
                  <th>Bus Type</th>
                  <th>Image</th>

                  <!-- Only Admin can access this section -->
                  <?php if(Session::get('admin_login')) { ?>
                  <th>Action</th>
                  <?php } ?>
                </tr>
				
		   <?php
		    $i=1;
		    foreach($data as $value)
		    { 
		    ?>
                		 
			<form  method="post" action="">
			    <tr>
                  <td><?php  echo $i;?></td>
                  <td><?php echo  $value['bus_no']; ?></td>
                  <td><?php echo  $value['bus_type']; ?></td>
                  <td class="center"><img src="<?php echo  $value['img_bus']; ?>" height="80" width="80"></td>

          <!-- Only Admin can access this section -->
                  <?php if(Session::get('admin_login')) { ?>
         <td class="center">
                    <button class="btn btn-xs btn-danger" type="submit" name="delete" onclick="return confirm('Are you sure to delete?')">
                      <i class="fa fa-fw fa-trash"></i>Delete</a>
                    </button>
                    <input type="hidden" name="bus_id" value="<?php echo $value['bus_id']; ?>">            
                    <a class="btn btn-xs btn-info" href="dashboard.php?page=update_bus&id=<?php echo $value['bus_id']; ?>">
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
