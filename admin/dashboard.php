<?php

ob_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "../phpmailer/PHPMailerAutoload.php";
require_once "../libs/Session.php";

  Session::checkSessionByname("admin_login","agent_login");

  require_once "../libs/Database.php";
  require_once "../helpers/Format.php";

  spl_autoload_register(function($class){
    require_once "../classes/".$class.".php";
  });

  $bus_info = new Bus_info();
  $counter_info = new Counter_info();
  $admin_info = new Admin_info();
  $agent_info = new Agent_info();
  $passenger_info = new Passenger_info();
  $booked_seat = new Booked_seat();
  $booking_info = new Booking_info();
  $cancel_request = new Cancel_request();
  $city = new City();
  $complain = new Complain();
  $reserved_info = new Reserved_info();
  $trip_info = new Trip_info();
?>

<?php

  if($_SESSION['email']!=null)
  {
		 
		 $sqlBus = $bus_info->GetAllBuses();
     $sqlBus =$sqlBus->fetch_assoc();
         //echo "<pre>";print_r($valueBus);exit;
    $sold_tickets = $booking_info->GetAllSoldTkt()->fetch_assoc();
    $pending_tickets = $booking_info->GetAllPendingTkt()->fetch_assoc();
    }
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Panel</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/css/AdminLTE.css">
  <link rel="stylesheet" href="assets/css/bootstrap-timepicker.min.css" />
  <link rel="stylesheet" href="assets/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="assets/js/bootstrap-timepicker.min.js"></script>
  <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <script src="assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
 <script src="assets/bower_components/fastclick/lib/fastclick.js"></script>
  <script src="assets/js/adminlte.min.js"></script>
 <script src="assets/js/demo.js">
 </script> 

<script>
   window.addEventListener('load', function (){
       $('.sidebar-menu').tree()
       $(".timepicker").timepicker({
           showInputs: false
       });
   })

    </script>
<!--time picker-->


</head>

<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="dashboard.php?page=home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->

      <span class="logo-mini"><b><?php if(Session::get('admin_login')) echo "ADMIN"; else if(Session::get('agent_login')) echo "AGENT";?></b> </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php if(Session::get('admin_login')) echo "Admin Panel"; else if(Session::get('agent_login')) echo "Agent Panel";?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src='<?php echo Session::get("img_url"); ?>' class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo Session::get('name'); ?> <i class="fa fa-angle-down"></i> </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo Session::get('img_url'); ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo Session::get('name');?> - <?php if(Session::get('admin_login')) echo "Admin"; else if(Session::get('agent_login')) echo "Agent";?>
                  
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="dashboard.php?page=agent_profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
         
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar" >
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image" style="margin-top: 7%;">
          <img src="<?php echo Session::get('img_url'); ?>" class=" img-thumbnail" alt="User Image">
        </div>
        <div class="pull-left info" style="margin-left: 2%;">
          <h4 style="font-weight:bolder;"><?php echo Session::get('name'); ?> </h4>
          <p> <?php echo Session::get('company'); ?></p>
          <a href="#"><i class="fa fa-circle text-success" style="color: green;"></i> Online</a>
        </div>
      </div>
	  <br />

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
		<li ><a href="dashboard.php?page=home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  
        <!-- Only admin can access this section -->
        <?php if(Session::get('admin_login')){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bus"></i>
            <span>City Information</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="dashboard.php?page=add_city"><i class="fa fa-circle-o"></i> Add City</a></li>
            <li><a href="dashboard.php?page=manage_city"><i class="fa fa-circle-o"></i> Manage City</a></li>         
          </ul>
        </li>
        <?php } ?>


        <li class="treeview">
    
          <a href="#">
            <i class="fa fa-university"></i>
            <span> Counter Information</span>
            <span class="pull-right-container">
     
              <i class="fa fa-angle-left pull-right"></i>
         
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- Only admin can access this section -->
            <?php if(Session::get('admin_login')){ ?>
            <li><a href="dashboard.php?page=add_counter"><i class="fa fa-circle-o"></i> Add Counter</a></li> <?php } ?>

            <!-- Both can access this section -->
            <li><a href="dashboard.php?page=manage_counter"><i class="fa fa-circle-o"></i> <?php if(Session::get('admin_login')) echo "Manage Counter"; else if(Session::get('agent_login')) echo "View All Counter";?></a></li>         
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-bus"></i>
            <span> Bus Information</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- Only admin can access this section -->
            <?php if(Session::get('admin_login')){ ?>
            <li><a href="dashboard.php?page=add_bus"><i class="fa fa-circle-o"></i> Add Bus</a></li> <?php } ?>
            <li><a href="dashboard.php?page=manage_bus"><i class="fa fa-circle-o"></i> <?php if(Session::get('admin_login')) echo "Manage Bus"; else if(Session::get('agent_login')) echo "View All Bus";?></a></li>         
          </ul>
        </li>

		<li class="treeview">
		
          <a href="#">
            <i class="fa fa-calendar"></i>
            <span> Trip Information</span>
            <span class="pull-right-container">
     
              <i class="fa fa-angle-left pull-right"></i>
         
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- Only admin can access this section -->
            <?php if(Session::get('admin_login')){ ?>
            <li><a href="dashboard.php?page=add_trip"><i class="fa fa-circle-o"></i> Add Trip Info</a></li> <?php } ?>
            <li><a href="dashboard.php?page=manage_trip"><i class="fa fa-circle-o"></i> <?php if(Session::get('admin_login')) echo "Manage Trip"; else if(Session::get('agent_login')) echo "View All Route";?></a></li>         
          </ul>
        </li>
		  
      <!-- Only Main admin can access this section -->
            <?php if(Session::get('admin_login') && Session::get('admin_role')==1){ ?>
      <li class="treeview">
          <a href="#"><i class="fa fa-bell-o"></i> <span>Booking Requests</span>

      <span class="pull-right-container"> <small class="label pull-right bg-green"> <?php //echo 2;//$no_of_booking_request+$no_of_cancel_request; ?></small> </span></a>
      
          <ul class="treeview-menu">
            <li><a href="dashboard.php?page=manage_request"><i class="fa fa-circle-o"></i> Confirm booking Requests</a></li>
            
          </ul>
        </li>

        <?php } ?>


        <?php if(Session::get('admin_login') && Session::get('admin_role')==1){ ?>
      <li class="treeview">
          <a href="#"><i class="fa fa-bell-o"></i> <span>Sales Report</span>

      <span class="pull-right-container"> <small class="label pull-right bg-green"> <?php //echo 2;//$no_of_booking_request+$no_of_cancel_request; ?></small> </span></a>
      
          <ul class="treeview-menu">
            <li><a href="dashboard.php?page=add_report"><i class="fa fa-circle-o"></i> Generate Report</a></li>
            
          </ul>
        </li>

        <?php } ?>
			

      <!-- Only admin can access this section -->
            <?php if(Session::get('admin_login')){ ?>
		<li class="treeview">
		
          <a href="#">
            <i class="fa fa-user-circle"></i>
            <span>Manage Agent</span>
            <span class="pull-right-container">
     
              <i class="fa fa-angle-left pull-right"></i>
         
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="dashboard.php?page=add_agent"><i class="fa fa-circle-o"></i> Register New agent</a></li>
            <li><a href="dashboard.php?page=manage_agent"><i class="fa fa-circle-o"></i> Manage All Agent</a></li>         
          </ul>
        </li>
        

        <!-- Only Main admin can access this section -->
            <?php } if(Session::get('admin_login') && Session::get('admin_role')==1){ ?>

        <li class="treeview">
    
          <a href="#">
            <i class="fa fa-user-circle"></i>
            <span>Manage Admin</span>
            <span class="pull-right-container">
     
              <i class="fa fa-angle-left pull-right"></i>
         
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="dashboard.php?page=add_admin"><i class="fa fa-circle-o"></i> Register New Admin</a></li>
            <li><a href="dashboard.php?page=manage_admin"><i class="fa fa-circle-o"></i> Manage All Admin</a></li>         
          </ul>
        </li>
        <?php } ?>


		<li><a href="report.php"><i class="fa fa-bar-chart"></i> <span> View Report </span></a></li>
		<li><a href="#"><i class="fa fa-map-marker text-yellow"></i> <span> Map </span></a></li>
		
		
        <li class="header">SETTINGS</li>

        <!-- Only Admin can access this section -->
         <?php if(Session::get('admin_login')) { ?>
        <li><a href="dashboard.php?page=update_admin_profile"><i class="fa fa-address-card-o text-green"></i> <span>Edit Profile  </span></a></li>
        <?php } else { ?>

         <li><a href="dashboard.php?page=update_agent_profile"><i class="fa fa-address-card-o text-green"></i> <span>Edit Profile  </span></a></li>

         <?php } ?>

        <li><a href="logout.php"><i class="fa fa-sign-out text-red"></i> <span>Logout</span></a></li>
      </ul>
	  		
		<li class="treeview">
		
          <a href="#">
            <i class=""></i>
            <span></span>
            <span class="pull-right-container">
     
              <i class=""></i>
         
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../layout/top-nav.html"><i class=""></i> </a></li>
            <li><a href="../layout/boxed.html"><i class=""></i> </a></li>         
          </ul>
        </li>
		
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <?php 
      switch (@$_GET['page']) {
        case "add_city": {
          include("add_city.php");
          break;
        }
        
        case "manage_city": {
          include("manage_city.php");
          break;
        }
        
        case "update_city": {
          include("update_city.php");
          break;
        }
       
        case "add_bus": {
          include("add_bus.php");
          break;
        }
     
        case "update_agent_profile": {
          include("update_agent_profile.php");
          break;
        }
                   

        case "agent_profile": {
          include("agent_profile.php");
          break;
        }

        case "admin_profile": {
          include("admin_profile.php");
          break;
        }
        

        case "manage_bus": {
          include("manage_bus.php");
          break;
        }
        

        case "update_bus": {
          include("update_bus.php");
          break;
        }
       

        case "add_counter": {
          include("add_counter.php");
          break;
        }
       

        case "manage_counter": {
          include("manage_counter.php");
          break;
        }
       

        case "update_counter": {
          include("update_counter.php");
          break;
        }
       

        case "manage_request": {
          include("manage_request.php");
          break;

        }
            
        case "add_agent": {
          include("add_agent.php");
          break;
        }   

        case "report": {
          include("report.php");
          break;
        }
             

        case "manage_agent": {
          include("manage_agent.php");
          break;
        }
               

        case "update_agent": {
          include("update_agent.php");
          break;
        }

        case "update_admin": {
          include("update_admin.php");
          break;
        }
      

        case "add_trip": {
          include("add_trip.php");
          break;
        }


        case "manage_trip": {
          include("manage_trip.php");
          break;
        }


        case "update_trip": {
          include("update_trip.php");
          break;
        }

        case "add_admin": {
          include("add_admin.php");
          break;
        }

        case "manage_admin": {
          include("manage_admin.php");
          break;
        }
        case "update_admin_profile": {
          include("update_admin_profile.php");
          break;
        }
        case "view_request": {
          include("view_request.php");
          break;  
        }

         case "add_report": {
          include("add_report.php");
          break;  
        }
        

        case "home": {
          include("home.php");
          break;
        }


        default: {
        include("home.php");
        break;
        //echo "Dashboard";
        }
      }         
    ?>       
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
   <div style="text-align:center;">
    <strong >Copyright &copy;  Team Unique (Leader <a style="color: lightseagreen;" target="_blank" href="https://www.facebook.com/abd1rti/">Md. Abdullah</a>).</strong> All rights
    reserved.
	</div>
  </footer>


</div>
<!-- ./wrapper -->

</body>
</html>

<?php  
/*}
else
{
	 header('location:../error.php');
}*/

ob_end_flush();
?>
