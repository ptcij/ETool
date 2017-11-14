<?php
    ob_start();
    session_start();

    // Path to the root directory:
    define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');

    require(ROOT_PATH . 'assets/php/classes.php');

    $config = new Config();

    $db = new DataBase($config->getDbConfig());
    $util = new Utility();

    if(!$db->connect($config->getDbConfig())) {
	header('HTTP/1.1 500 Internal Server Booboo');
	echo $db->getError();
	die();
    }
    
    $sessionManager = new SessionManager();
    
    if($sessionManager->isModeratorLoggedIn() === TRUE) {
	header("Location: /cms/dashboard/");
    }
?>
<!doctype html>
<html lang="en">
    <head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Login</title>

	<!-- Canonical SEO -->
	<link rel="canonical" href=""/>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />


	<!-- Bootstrap core CSS     -->
	<link href="/assets/css/bootstrap.min_1.css" rel="stylesheet" />

	<!--  Paper Dashboard core CSS    -->
	<link href="/assets/css/paper-dashboard.css?v=1.2.1" rel="stylesheet"/>


	<!--  Fonts and icons     -->
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
	<link href="/assets/css/themify-icons.css" rel="stylesheet">
    </head>

    <body>
	<nav class="navbar navbar-transparent navbar-absolute">
	    <div class="container">
		<div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		    </button>
		    <a class="navbar-brand" href="../dashboard/overview.html">
			PremiumTimes ET
		    </a>
		</div>
		<!--<div class="collapse navbar-collapse">
		    <ul class="nav navbar-nav navbar-right">
			<li>
			    <a href="register.html">
				Register
			    </a>
			</li>
			<li>
			    <a href="../dashboard/overview.html">
				Dashboard
			    </a>
			</li>
		    </ul>
		</div>-->
	    </div>
	</nav>

	<div class="wrapper wrapper-full-page">
	    <div class="full-page login-page" data-color="blue" data-image="../assets/img/admin_login_bg.jpg">
		<!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
		<div class="content">
		    <div class="container">
			<div class="row">
			    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
				<form method="#" action="#">
				    <div class="card" data-background="color" data-color="blue">
					<div class="card-header">
					    <h3 class="card-title">Login</h3>
					</div>
					<div class="card-content">
					    <div class="form-group">
						<label>Email address</label>
						<input id="email" type="email" placeholder="Enter email" class="form-control input-no-border">
					    </div>
					    <div class="form-group">
						<label>Password</label>
						<input id="password" type="password" placeholder="Password" class="form-control input-no-border">
					    </div>
					</div>
					<div class="card-footer text-center">
					    <button id="loginBtn" type="button" class="btn btn-fill btn-wd ">Login</button>
					</div>
				    </div>
				</form>
			    </div>
			</div>
		    </div>
		</div>

		<footer class="footer footer-transparent">
		    <div class="container">
			<div class="copyright">
			    &copy; <script>document.write(new Date().getFullYear())</script>, <a href="/">PremiumTimes</a>
			</div>
		    </div>
		</footer>
	    </div>
	</div>
    </body>

    <!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
    <script src="/assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="/assets/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="/assets/js/perfect-scrollbar.min.js" type="text/javascript"></script>
    <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Forms Validations Plugin -->
    <script src="/assets/js/jquery.validate.min.js"></script>

    <!-- Promise Library for SweetAlert2 working on IE -->
    <script src="/assets/js/es6-promise-auto.min.js"></script>

    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="/assets/js/moment.min.js"></script>

    <!--  Select Picker Plugin -->
    <script src="/assets/js/bootstrap-selectpicker.js"></script>

    <!--  Switch and Tags Input Plugins -->
    <script src="/assets/js/bootstrap-switch-tags.js"></script>

    <!-- Circle Percentage-chart -->
    <script src="/assets/js/jquery.easypiechart.min.js"></script>

    <!--  Charts Plugin -->
    <script src="/assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="/assets/js/bootstrap-notify.js"></script>

    <!-- Sweet Alert 2 plugin -->
    <script src="/assets/js/sweetalert2.js"></script>

    <!-- Vector Map plugin -->
    <script src="/assets/js/jquery-jvectormap.js"></script>

    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFPQibxeDaLIUHsC6_KqDdFaUdhrbhZ3M"></script>

    <!-- Wizard Plugin    -->
    <script src="/assets/js/jquery.bootstrap.wizard.min.js"></script>

    <!--  Bootstrap Table Plugin    -->
    <script src="/assets/js/bootstrap-table.js"></script>

    <!--  Plugin for DataTables.net  -->
    <script src="/assets/js/jquery.datatables.js"></script>

    <!--  Full Calendar Plugin    -->
    <script src="/assets/js/fullcalendar.min.js"></script>

    <!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
    <script src="/assets/js/paper-dashboard.js?v=1.2.1"></script>

    <!--   Sharrre Library    -->
    <script src="/assets/js/jquery.sharrre.js"></script>

    <script type="text/javascript">
	    
	$page = $('.full-page');
	image_src = $page.data('image');

	if(image_src !== undefined){
	    image_container = '<div class="full-page-background" style="background-image: url(' + image_src + ') "/>'
	    $page.append(image_container);
	}

	setTimeout(function () {
	    // after 1000 ms we add the class animated to the login/register card
	    $('.card').removeClass('card-hidden');
	}, 700)

	$("#loginBtn").on('click', function loginAdmin() {
	    var email = $("#email").val();
	    var password = $("#password").val();
	    var type = "loginModerator";
	    var valid = true;

	    if (email === "") {
		valid = false;
	    }

	    if (password === "") {
		valid = false;
	    }

	    if (valid === false) {
		$.notify({
		    icon: 'pe-7s-gift',
		    message: "Some Required Fields Are Empty."

		}, {
		    type: 'danger',
		    timer: 500
		});
	    } else {
		$.ajax({
		    url: "/assets/php/Auth.php/",
		    type: "POST",
		    data: {email: email, password: password, type: type},
		    dataType: "json",
		    success: function (response) {
			//alert("Successfully submitted.");
			$.notify({
			    icon: 'pe-7s-gift',
			    message: "Admin Logged In."

			}, {
			    type: 'info',
			    timer: 500
			});

			window.location.replace("/cms/dashboard/");
		    },
		    error: function (xhr, ajaxOptions, thrownError) {
			$.notify({
			    icon: 'pe-7s-gift',
			    message: thrownError

			}, {
			    type: 'danger',
			    timer: 500
			});
		    }
		});
	    }
	});
    </script>

</html>
