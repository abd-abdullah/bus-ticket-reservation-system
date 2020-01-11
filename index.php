<?php include"inc/header.php";?>

<?php
	$AllCity = $city->GetAllCityByUniqueName();
	$AllCity = mysqli_fetch_all($AllCity,MYSQLI_ASSOC);
?>


</head>
<?php include("inc/header_bottom.php"); ?>

<!--- banner ---->


<!---728x90-->
<div class="container">
	<div class="col-md-3 bann-info1" >
		
	</div>
	<div class="col-md-7 bann-info">
		<h2>Book Your Ticket Here</h2>
		<?php if(isset($sms)){ echo $sms; } ?> 
		<form action="search_bus.php" method="POST">
		<div class="ban-top">
			 <div class="form-group bnr-left col-md-4">
              <label >From</label>
              <input list="from_city" type="text" class="form-control datalist" name="from_city"  placeholder="Typle/Select Your City">   
              	<datalist id="from_city">
		    		<!-- showing all cities-->
		    		<?php 
						foreach($AllCity as $value)
		    		{
		    		?>
		    		<option value="<?php echo $value['city_name']; ?>">
		    	  	<?php
		    			}
					?>
		    	</datalist>			  
            </div>
			
			 <div class="form-group bnr-left col-md-4">
              <label >To</label>
              <input list="to_city" type="text" class="form-control datalist" name="to_city"  placeholder="Typle/Select Your City">   
              	<datalist id="to_city">
		    		<!-- showing all cities-->
		    		<?php 
						foreach($AllCity as $value)
		    		{
		    		?>
		    		<option value="<?php echo $value['city_name']; ?>">
		    	  	<?php
		    			}
					?>
		    	</datalist>	   
              	             
            </div>
			<div class="clearfix"></div>
		</div>
		
		<div class="ban-bottom">
		      <div class="form-group bnr-left col-md-4">
              <label >Date of Journey</label>
              <input type="Date" class="form-control" name="journey_date" >             
            </div>
			
			 <div class="form-group bnr-left col-md-4">
			 	<label></label></br>
              <button name="btn" class="seabtn">Search Buses</button>	             
            </div>
		   <div class="clearfix"></div>
			
		</div>

		</form>
	</div>
	<div class="clearfix"></div>
</div>


<!--- /routes -->
 <?php include"inc/footer.php" ; ?>