<?php

  $AllCity = $city->GetAllCity();
  $AllCity = mysqli_fetch_all($AllCity,MYSQLI_ASSOC);

	if(isset($_POST['delete'])){
    $id = $_POST['city_id'];
    $delet_city = $city->DeleteCityById($id);
    $sms = '<div class="alert alert-success alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$delet_city.'</strong> </div>';
  }

?>

    <section class="content-header">
      <h1>Manage City Information</h1>
	  
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">City Information Table</h3>

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
              <h3 class="box-title" style="font-weight: bolder;" >All City Inforamtion</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr >
                  <th>Sl.</th>
                  <th>City Name</th>
                  <th>Action</th>
                </tr>
				
		  <?php
        $i=1;
         foreach($AllCity as $value)
      {
      ?>
                		 
			<form  method="post" action="">
			    <tr>
              <td><?php echo $i;?></td>
              <td><?php echo  $value['city_name']; ?></td>
              
              <td class="center">
                <button class="btn btn-xs btn-danger" type="submit" name="delete" onclick="return confirm('Are you sure to delete?')">
                  <i class="fa fa-fw fa-trash"></i>Delete</a>
                </button>
                <input type="hidden" name="city_id" value="<?php echo $value['city_id']; ?>">            
                <a class="btn btn-xs btn-info" href="dashboard.php?page=update_city&id=<?php echo $value['city_id']; ?>&name=<?php echo $value['city_name']; ?>">
                  <i class="fa fa-fw fa-edit"></i>Edit</a>
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
