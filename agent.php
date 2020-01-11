<?php include"inc/header.php";?>
	 
</head>
<?php include("inc/header_bottom.php"); ?>
<!--- /header ---->
<!--- footer-btm ---->

<!--- /footer-btm ---->

<!--- banner-1 ---->
<div class="banner-1 ">
	<div class="container">
		<h1> Ensuring Your Best Experience </h1>
	</div>
</div>
<!--- /banner-1 ---->
<div class="bus-btm">
	<div class="container">
		<div class="col-md-6 " >
			<div class="ag-bt">
				<a class="regist" href="#">Register Online &amp; Start Now</a>
			</div>	
              
			  <?php if(isset ($sms)) {echo $sms;} ?>
		
			
			 <form method="post" enctype="multipart/form-data">
				<div class="form-group">
                   <label for="name">Name:</label>
                   <input type="text" name="name" class="form-control" id="name" placeholder="Enter Your Name">
                 </div>
				 
				 <div class="form-group">
                   <label for="company">Company:</label>
                   <input type="text" name="company" class="form-control" id="company" placeholder="Enter Your Company Name">
                 </div>
				 
				 <div class="form-group">
                   <label for="email">Email:</label>
                   <input type="text" name="email" class="form-control" id="email" placeholder="Enter Your Email">
                 </div>
				 
				 <div class="form-group">
                   <label for="contact">Contact No:</label>
                   <input type="text" name="contact" class="form-control" id="contact" placeholder="Enter Your Contact No">
                 </div>
				 
                 <div class="form-group">
                   <label for="pwd">Password:</label>
                   <input type="password" name="password" class="form-control" id="password" placeholder="Enter Your Password">
                 </div>
				 
				 <div class="form-group">
                   <label for="pwd">Confirm Password:</label>
                   <input type="password" name="repassword" class="form-control" id="repassword" placeholder="Retype Your Password">
                 </div>
				 
				      <div class="form-group">
                   <label for="image">Image:</label>
                   <input type="file" name="image" class="form-control" >
                 </div>
				
				 <button type="submit" name="btn" class="btn btn-success">Submit</button>
		
				 
			</form>
		</div>
		
		</br>
		</br>
		</br>
		<div class="col-md-6 agent-right">					
			<h3>Contact Us</h3>
			<p><a href="mailto:example@email.com">contact@example.com</a></p>
			<p>+8801745455454</p>
		</div>
			<div class="clearfix"></div>
	</div>
	<!---728x90--->
</div>
<!--- /agent ---->
<!--- footer-top ---->
 <?php include"inc/footer.php" ; ?>