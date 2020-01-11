<?php

/*if (isset($_POST['btn'])) {
		$city_insert = $city->InsertCity($_POST);

		$sms = '<div class="alert alert-success alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$city_insert.'</strong> </div>';
  }*/
?>	

<!----------Page content Stats--------------->

    <section class="content-header">
      <h1>Report</h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Report View</h3>

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
              <h3 class="box-title">Generate Sales Reports</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
          <?php 

            if(isset($_POST['btn_report'])){
              $from_date = $_POST['from_date'];
              $to_date = $_POST['to_date'];

              $date1=date_create($from_date);
              $date2=date_create($to_date);
              $diff=date_diff($date1,$date2);
              $difference = intval($diff->format("%R%a"));

              if($difference>=0){
                header("Location:report.php?fd=".$from_date."&td=".$to_date);
              }
              else{
                echo '<script>alert("From date should be less than or equal To date");</script>';
              }
            }

           ?>




            <form role="form" target="_blank" method="post" action="">
              <div class="box-body">
                 <div class="form-group">
                  <label for="">From: </label>
                  <input required type="date" class="form-control"  name="from_date" id="" >
                </div>
                 <div class="form-group">
                  <label for="">To: </label>
                  <input required type="date" class="form-control"  name="to_date" id="" >
                </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="btn_report" class="btn btn-primary">Submit</button>
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
