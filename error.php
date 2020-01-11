<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body {
	margin: 0px;
	background-repeat: no-repeat;
	background-image: url(images/login.jpg);
}
#container {
	background-repeat: no-repeat;
	margin-right: auto;
	margin-left: auto;
	text-align: center;
	background-attachment: fixed;
	margin-top: 100px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 30px;
	color: #FFF;
	font-weight: 700;
}
#container a{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	text-decoration:none;
	color:#FFF;
}
#container a:hover{
	text-decoration:underline;
}
input:-moz-placeholder { color: #fff; }
input:-ms-input-placeholder { color: #fff; }
input::-webkit-input-placeholder { color: #fff; }
#container input[type="text"],
#container input[type="password"]{
	 border: 1px solid rgba(255,255,255,.15);
    -moz-box-shadow: 0 2px 3px 0 rgba(0,0,0,.1) inset;
    -webkit-box-shadow: 0 2px 3px 0 rgba(0,0,0,.1) inset;
    box-shadow: 0 2px 3px 0 rgba(0,0,0,.1) inset;
	-webkit-transition: all 0.30s ease-in-out;
	-moz-transition: all 0.30s ease-in-out;
	-ms-transition: all 0.30s ease-in-out;
	-o-transition: all 0.30s ease-in-out;
	outline: none;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	/* [disabled]-moz-box-sizing: border-box; */
	 background: #2d2d2d; /* browsers that don't support rgba */
    background: rgba(45,45,45,.15);
	color:#FFF;
	
	margin-bottom: 25px;
	width: 300px;
	height:40px;
	padding: 1%;
	font-family: Arial, Helvetica, sans-serif;
	border-radius:5px;
	font-size:14px;
}
#container input[type="text"]:focus,
#container input[type="password"]:focus{
	box-shadow: 0 0 10px #FF3300;
	padding: 1%;
	border: 1px solid #F60;
}
#container input[type="submit"]{
	cursor:pointer;
	width: 300px;
	height: 40px;
	background: #ef4300;
	color: #FFF;
	padding: 1%;
	border-bottom: none;
	border-top-style: none;
	border-right-style: none;
	border-left-style: none;
	font-family: Arial, Helvetica, sans-serif;
	border-radius:5px;
	moz-box-shadow:
        0 15px 30px 0 rgba(255,255,255,.25) inset,
        0 2px 7px 0 rgba(0,0,0,.2);
    -webkit-box-shadow:
        0 15px 30px 0 rgba(255,255,255,.25) inset,
        0 2px 7px 0 rgba(0,0,0,.2);
    box-shadow:
        0 15px 30px 0 rgba(255,255,255,.25) inset,
        0 2px 7px 0 rgba(0,0,0,.2);
	font-size: 14px;
    font-weight: 700;
    color: #fff;
    text-shadow: 0 1px 2px rgba(0,0,0,.1);
    -o-transition: all .2s;
    -moz-transition: all .2s;
    -webkit-transition: all .2s;
    -ms-transition: all .2s;
}
#container input[type="submit"]:hover{
	-moz-box-shadow:
        0 15px 30px 0 rgba(255,255,255,.15) inset,
        0 2px 7px 0 rgba(0,0,0,.2);
    -webkit-box-shadow:
        0 15px 30px 0 rgba(255,255,255,.15) inset,
        0 2px 7px 0 rgba(0,0,0,.2);
    box-shadow:
        0 15px 30px 0 rgba(255,255,255,.15) inset,
        0 2px 7px 0 rgba(0,0,0,.2);
}
#copyright_text {
	position: fixed;
	left: 0px;
	bottom: 10px;
	height: auto;
	width: 100%;
	text-align: center;
	color: #FFF;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: 500;
	font-size: 14px;
}
</style>
</head>

<body>

 <h1 style="padding-top:200px; text-align:center; color: yellow; font-size: 50px;">Sorry you can not authorize this page. <a href="login/index.php">Login Again!</a></h1>
<h2 style="padding-top:10px; text-align:center; color: yellow; font-size: 50px;" class="button"> <a href="index.php">back to Home Page</a></h2>


<div id="copyright_text">&copy; J!N 2017, All rights reserved.</div>
</body>
</html>

