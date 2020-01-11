<?php
	require_once "../libs/Session.php";
	
	Session::checkLoginByname("admin_login","agent_login");
	
	require_once "../libs/Database.php";
	require_once "../helpers/Format.php";

	spl_autoload_register(function($class){
		require_once "../classes/".$class.".php";
	});

	$admin_info = new Admin_info();
 	$agent_info = new Agent_info();
?>

<?php

if(isset($_POST['btn']))
{

	$login_type = $_POST['login_type'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if($login_type == 'admin')
	{
		$sql = $admin_info->AdminLogin($username,$password);

		if($sql){
			echo '<script language="javascript">';
			echo 'alert("'.$sql.'")';
			echo '</script>';
		}
		
	} 

	else if($login_type == 'agent')
	{
		
		$sql = $agent_info->AgentLogin($username,$password);

		if($sql){
			echo '<script language="javascript">';
			echo 'alert("'.$sql.'")';
			echo '</script>';
		}

	}

	else{
		echo '<script language="javascript">';
		echo 'alert("Select login type")';
		echo '</script>';
	}
}

?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Online Bus Ticket Reservation System</title>

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.login.css">
		
		 <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
		<script src="assets/js/main.js"></script>

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Online Bus Ticket Reservation System</strong></h1>
                        </div>						
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Admin Login</h3>
                            		<p>Enter your username and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="username" placeholder="Username..." class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password"  placeholder="Password..." class="form-password form-control" id="form-password">
			                        </div>
									
									<div style="margin-bottom: 25px">
									<select required name="login_type" class="selectpicker form-password form-control">
                                   									
                                     <option value="">--------Select Login Type------</option>
                                     <option value="admin">Admin</option>
                                     <option value="agent">Agent</option>
                                    </select>
             
                                     </div>
			                        <button type="submit" name="btn" class="btn">Sign in!</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    </body>

</html>