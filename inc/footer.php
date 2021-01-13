<!--- footer-top ---->

         
<!--  -->
<!--- /footer-top ---->
<!---copy-right ---->
<div class="copy-right">
	<div class="container">
	
		<div class="footer-social-icons">
			<ul>
				<li><a class="facebook" href="https://www.facebook.com/abd1rti/"><span>Facebook</span></a></li>
				<li><a class="twitter" href="https://github.com/abd-abdullah"><span>GitHub</span></a></li>
				<li><a class="googleplus" href="#"><span>Google+</span></a></li>
			</ul>
		</div>
        <p >Copyright © 2018 Team Unique (Leader <a style="color: gold;" href="https://www.facebook.com/abd1rti/">Md. Abdullah</a>) All rights reserved.</p>
	</div>
</div>
<!--- /copy-right ---->

<!-- Print -->
<div class="modal fade" id="myModaPrint">
          <div class="modal-dialog">
            <div class="modal-content" style="width: 400px;">
			<div class="modal-header">
                <button type="button" class="close_lft" data-dismiss="modal">&times;</button>
            </div>
 
              <div class="modal-body">
                 <div class="login-right" style="float: left; margin-left:8%;">
					<form action="ticket_print.php" target="_blank" method="POST"><br/>
						<h3>Enter Your PNR No </h3> 
						<input required type="text" class="form-control" placeholder="Enter PNR No.." name="pnr_no" > <br /> 
					
						<button type="submit" name="btn_print" class="btn btn-success btn-block seabtn" style="background-color: red; width:100%;" >Print Ticket</button>
						
 					</form> <br />
					
				</div>
              </div>
              <div class="modal-footer">
                
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
		  
 </div>
<!-- //Print -->

<!-- Cancel -->
<div class="modal fade" id="myModaCanel">
          <div class="modal-dialog">
            <div class="modal-content" style="width: 400px;">
			<div class="modal-header">
                <button type="button" class="close_lft" data-dismiss="modal">&times;</button>
            </div>
 
              <div class="modal-body">
                 <div class="login-right" style="float: left; margin-left:8%;">
					<form action="booking_cancel.php" target="_blank" method="POST"><br/>
						<h3>Enter Your Pnr No </h3> 
						<input required type="text" class="form-control" placeholder="Enter Pnr No.." name="pnr_no" > <br /> 
						
						<button  type="submit" name="btn-booking_cancel" class="btn btn-success btn-block seabtn" style="background-color: red; width:100%;">Proceed To Cancellation</button>
						
 					</form> <br />
					<p>Please read more about our <a href=""> cancellation policies!</a></p>
				</div>
              </div>
              <div class="modal-footer">
                
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
 </div>
<!-- //Cancel -->

<!-- write us -->
			<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
							<section>
								<div class="modal-body modal-spa">
									<div class="writ">
										<h4>HOW CAN WE HELP YOU</h4>
											<ul>
												<li class="na-me">
													<input class="name" type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
												</li>
												<li class="na-me">
													<input class="Email" type="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
												</li>
												<li class="na-me">
													<input class="number" type="text" value="Mobile Number" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Mobile Number';}" required="">
												</li>
												<li class="na-me">
													<select id="country" onchange="change_country(this.value)" class="frm-field required sect">
														<option value="null">Select Issue</option> 		
														<option value="null">Booking Issues</option>
														<option value="null">Bus Cancellation</option>
														<option value="null">Refund</option>
														<option value="null">Wallet</option>														
													</select>
												</li>
												<li class="na-me">
													<select id="country" onchange="change_country(this.value)" class="frm-field required sect">
														<option value="null">Select Issue</option> 		
														<option value="null">Booking Issues</option>
														<option value="null">Bus Cancellation</option>
														<option value="null">Refund</option>
														<option value="null">Wallet</option>														
													</select>
												</li>
												<li class="descrip">
													<input class="special" type="text" value="Write Description" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Write Description';}" required="">
												</li>
													<div class="clearfix"></div>
											</ul>
											<div class="sub-bn">
												<form>
													<button class="subbtn">Submit</button>
												</form>
											</div>
									</div>
								</div>
							</section>
					</div>
				</div>
			</div>
<!-- //write us -->


</body>
</html>