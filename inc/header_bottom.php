<body>
<script type="text/javascript">
    function SignUpForm() {
        $.ajax({
            type: 'post',
            url: 'ajax_php/passenger_reg.php',
            data: $('#signup').serialize(),

            success: function (response) {

                alert(response);
            }
        });
        var form = document.getElementById('signup').reset();
        return false;

    };
</script>

<script type="text/javascript">
    function LogInForm() {
        $.ajax({
            type: 'post',
            url: 'ajax_php/passenger_login.php',
            data: $('#login').serialize(),

            success: function (response) {
                if (response == true) {
                    location.reload();
                } else {
                    alert(response);
                }
            }
        });


    };
</script>

<script type="text/javascript">
    function LogOut() {
        $.ajax({
            type: 'post',
            url: 'ajax_php/passenger_logout.php',

            success: function (response) {
                if (response == true) {
                    location.reload();
                } else {
                    alert(response);
                }
            }
        });


    };
</script>

<!-- top-header -->
<div class="top-header">
    <div class="container">
        <ul class="tp-hd-lft ">
            <li class=""><a href="index.php"><i class="fa fa-print"></i></a></li>
            <li class="prnt"><a href="" data-toggle="modal" data-target="#myModaPrint">Print /</a><a href="" data-toggle="modal" data-target="#myModaCanel">Cancel Ticket</a></li>

        </ul>
        <ul class="tp-hd-rgt ">
            <li class="tol">Contact Number : +8801738868597</li>
            <?php
            if (Session::get("passenger_login") != true) {
                ?>
                <li class=""><a href="" data-toggle="modal" data-target="#myModals">login /</a><a href="" data-toggle="modal" data-target="#myModal">Sign Up</a></a></li>

            <?php } else { ?>
                <li class=""><input style="height:30px; padding-top:0px; margin:0px;" type="button" value="Logout" onclick="return LogOut();"></li>

            <?php } ?>

        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!--- /top-header ---->
<!--- header ---->

<!--- /header ---->
<!--- footer-btm ---->
<div class="footer-btm wow">
    <div class="container">
        <div class="navigation">
            <nav class="navbar navbar-default">

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
                    <nav class="cl-effect-1">
                        <ul class="nav navbar-nav">
                            <li class=" "><a href="index.php"><i class="fa fa-home"> &nbsp </i>Home</a></li>
                            <li><a href="privacy.php">Privacy Policy</a></li>
                            <li><a href="terms.php">Terms of Use</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">About</a></li>
                            <li>Need Help?<a href="#" data-toggle="modal" data-target="#myModal3"> / Write Us </a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </nav>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>

        <div class="clearfix"></div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <button type="button" class="close_lft" data-dismiss="modal">&times;</button>
        <form id="login" data-parsley-validate="">
            <div class="login-block">
                <h1>Login</h1>
                <input type="text" name="email" placeholder="Email" class="username" id="username" required=""/>
                <input type="password" class="password" name="password" placeholder="Password" id="password" required=""/>


                <input type="button" value="Login" style="position: relative;" onclick="return LogInForm();">
                <br>
                <div class="small_loader" style="text-align:center;display:none"><img src="assets/images/loader-small.gif"></div>
                <div class="login_res" style="text-align:center;"></div>
                <br>

                <div class="sign_in"><a data-dismiss="modal" href="#myModal" data-toggle="modal" data-target="#myModal">Sign Up</a></div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <button type="button" class="close_lft" data-dismiss="modal">&times;</button>

        <form id="signup" data-parsley-validate="">
            <div class="login-block">
                <h1>Sign Up</h1>

                <input type="text" value="" class="username" placeholder="Full Name" id="name" name="name" required/>
                <input type="text" value="" class="username" placeholder="address...." id="address" name="address" required/>
                <input type="email" value="" class="username" placeholder="Email" id="email" name="email" required/>
                <input class="mobile" id="signup-username mob" type="text" name="mob" data-parsley-type="digits" data-parsley-required="true" data-parsley-trigger="change" required required minlength="3" autocomplete="off"
                       data-parsley-minlength="3" data-parsley-maxlength="15" placeholder="Mobile">

                <input type="password" value="" class="password" placeholder="Password" id="dfdfd password" name="password" autocomplete="off" type="password" data-parsley-maxlength="15" data-parsley-minlength="6" required=""/>

                <span class="terms_tb">By signing up, you agree to our <a class="cond_tb" href="#">Terms and Conditions.</a></span> <br>
                <br>

                <input id="sign_up" onclick="return SignUpForm();" name="sign_up" type="button" value="Sign up" style="position: relative;">
                <br>
                <div class="small_loader" style="text-align:center;display:none"><img src="assets/images/loader-small.gif"></div>
                <div class="signup_res" style="text-align:center;"></div>
                <br>
                <div class="account"><a data-dismiss="modal" href="#myModals" data-toggle="modal" data-target="#myModals">Already have an account?</a></div>
                <div class="sign_in"><a data-dismiss="modal" href="#myModals" data-toggle="modal" data-target="#myModals">Sign In</a></div>
            </div>
        </form>

    </div>
</div>
<!--- /footer-btm ---->