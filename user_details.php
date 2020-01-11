<?php include"inc/header.php" ; ?>

<?php
	if(isset($_POST['btn']))
	{
		
		$_SESSION['agent_id'] = $_POST['agent_id'];
		$_SESSION['bus_id'] = $_POST['bus_id'];
		$_SESSION['trip_id'] = $_POST['trip_id'];
		$_SESSION['counter_name'] = $_POST['counter_name'];
		@$_SESSION['seat'] = $_POST['seat'];
		  
	}

	if($_SESSION['counter_name'] == '' && $_SESSION['seat'] == null){
			$sms = '<div class="alert alert-danger alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please! Select Your boarding point first.</strong> </div>';
			//header('location:search_bus.php');
		}

	if(isset($_POST['submit']))
	{
		$pnr_no = rand();		
		$trip_id = $_POST['trip_id'];
		$counter_id = $_POST['counter_id'];
		$passenger_name = $_POST['passenger_name'];
		$passenger_gender = $_POST['passenger_gender'];
		$passenger_email = $_POST['passenger_email'];
		$passenger_contact = $_POST['passenger_contact'];
		$reference_no = 'null';
		 
		
		if (!empty($passenger_name) && !empty($passenger_email) && !empty($passenger_contact) && !empty($passenger_email)) {
			try{
				$data = array($pnr_no,$_SESSION['trip_id'],$_SESSION['counter_id'],$reference_no,$passenger_name,$passenger_gender,$passenger_email,$passenger_contact);
				$sql = "insert into tbl_booking_info(pnr_no,trip_id,counter_id,reference_no,passenger_name,passenger_gender,passenger_email,passenger_contact )values(?,?,?,?,?,?,?,?)";
				$stmt = $conn->prepare($sql);
				$end = $stmt->execute($data);
				if ($end) {
					$_SESSION['pnr_no']=$pnr_no;
					$_SESSION['passenger_name']=$passenger_name;					
				   header('Location: transaction.php');
				} else {
					$sms = '<div class="alert alert-danger alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Unsuccess!</strong> Indicates a unsuccessful or negative action.</div>';
			}
			}catch(PDOException $e){
					 echo "Operation failed: " . $e->getMessage();
				}
    } else {
		$sms = '<div class="alert alert-warning alert-dismissable"><a ref="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Unsuccess!</strong> Sorry you must fillup all the field .....</div>';
    }

}	

?>
</head>
<?php include("inc/header_bottom.php"); ?>

<!--- /footer-btm ---->
<!--- banner-1 ---->
<div class="banner-1 ">
	<div class="container">
		<h1> Ensuring Your Best Experience </h1>
	</div>
</div>
<!--- /banner-1 ---->
<!--- agent ---->
<div class="agent">
<!-728x90-->
	<div class="container">
		<div class="col-md-6 " >
			<div class="ag-bt">
				<a class="regist" >Fill Up Your Contact Details</a>
			</div>
     <?php 
	 if(isset($sms)){echo $sms;} 

	 ?>
			<form method="POST">
				<div class="form-group" method="POST" >
                   <label for="name" >Name: <span>*</span></label>
                   <input type="name" name="passenger_name" class="form-control" placeholder="Enter Your Name" id="name">
                 </div>
				 
				 <div class="form-group">
				   <label for="gender" >Select Gender:</label>
                   <input type="radio" name="passenger_gender" value="Male"> Male
                   <input type="radio" name="passenger_gender" value="Female"> Female<br>
                 </div>
						 
				 <div class="form-group">
                   <label for="email" >Email:<span>*</span></label>
                   <input type="email" name="passenger_email" class="form-control" placeholder="Enter Your Email" id="email">
                 </div>
				 
				 <div class="form-group">
                   <label for="contact" >Contact No:<span>*</span></label>
                   <input type="contact" name="passenger_contact" class="form-control" placeholder="Enter Your Contact No" id="contact">
                 </div>
				 
				  <div class="form-group">   
                  <label for="contact" >Please submit and proceed to payment</label>				                    
                 </div>
				 
				 <button  name="submit" class="seabtn"> Submit </button>
				 
			</form>
	
		</div>
		
	<aside id="journey" class="col-md-4 paside agent-right">

              <div class="page_title" style="margin-right:2%;">
                  <h3>Your Selected Journey Details</h3>
              </div><br>
			  
			  

              <ul style="margin-left:2%;">
                  <!--//// For Eid  /////-->
				  <?php
				  if($_SESSION['counter_name'] != '0' && $_SESSION['seat'] != null)
				  {
					$sql = $trip_info->GetTripAndAgentInfo($_SESSION['agent_id'], $_SESSION['trip_id']);
					while($data = $sql->fetch_assoc()){
				  ?>
                  <li><b style="font-weight:bolder;">Journey:</b> <?php echo $data['from_city']; ?> - <?php echo $data['to_city']; ?> </li>
                  <!--//// For Eid  /////-->
                  <li><b style="font-weight:bolder;">Bus: </b><?php echo $data['company']; ?></li>
                  <li><b style="font-weight:bolder;">Date of Journey:</b> <?php echo $data['date'];?>, <?php echo date('h:i A', strtotime($data['departure_time'])); ?></li> 
                  <li><b style="font-weight:bolder;">Seat No(s):</b> <span> <?php echo implode(',', $_SESSION['seat']);  ?></span></li>
                  <li><b style="font-weight:bolder;">Ticket Price Per Seat: </b> <span><?php echo $data['fare'];?> BDT</span></li>
                  <li><b style="font-weight:bolder;">Boarding at: </b> <?php echo $_SESSION['counter_name'];?></li>
				  <?php } }
				  else{
					  echo "<strong>Sorry! trip not found.</strong>";
				  } ?>
            </ul>

    </aside>
						
	
		<div class="clearfix"></div>
		
        
		 
	</div>
	
	<!---728x90--->
</div>
<!-- /agent -->
<!-- footer-top -->
<?php include"inc/footer.php" ; ?>