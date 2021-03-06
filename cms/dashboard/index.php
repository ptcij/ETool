<?php
    ob_start();
    session_start();

    // Path to the root directory:
    define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');

    require(ROOT_PATH . 'assets/php/classes.php');
    require(ROOT_PATH . 'assets/php/Moderator.php');

    $config = new Config();

    $db = new DataBase($config->getDbConfig());
    $util = new Utility();

    if(!$db->connect($config->getDbConfig())) {
	header('HTTP/1.1 500 Internal Server Booboo');
	echo $db->getError();
	die();
    }
    
    $sessionManager = new SessionManager();
    
    if($sessionManager->isModeratorLoggedIn() === FALSE) {
	header("Location: /cms/");
	die();
    }
    
    $moderator = new Moderator($sessionManager->getModeratorId());
?>
<!doctype html>
<html lang="en">
    <head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Dashboard</title>

	<!-- Canonical SEO -->
	<link rel="canonical" href=""/>

	<?php require_once("../../blocks/_META_TAGS.php"); ?>

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
	<div class="wrapper">
	    <?php require_once("../../blocks/_ADMIN_SIDEBAR.php"); ?>

	    <div class="main-panel">
		<?php require_once("../../blocks/_ADMIN_NAV.php"); ?>

		<div class="content">
		    <div class="container-fluid">
			<div class="row">
			    <div class="col-lg-3 col-sm-6">
				<div class="card">
				    <div class="card-content">
					<div class="row">
					    <div class="col-xs-5">
						<div class="icon-big icon-warning text-center">
						    <i class="ti-server"></i>
						</div>
					    </div>
					    <div class="col-xs-7">
						<div class="numbers">
						    <p>Capacity</p>
						    105GB
						</div>
					    </div>
					</div>
				    </div>
				    <div class="card-footer">
					<hr />
					<div class="stats">
					    <i class="ti-reload"></i> Updated now
					</div>
				    </div>
				</div>
			    </div>
			    <div class="col-lg-3 col-sm-6">
				<div class="card">
				    <div class="card-content">
					<div class="row">
					    <div class="col-xs-5">
						<div class="icon-big icon-success text-center">
						    <i class="ti-wallet"></i>
						</div>
					    </div>
					    <div class="col-xs-7">
						<div class="numbers">
						    <p>Revenue</p>
						    $1,345
						</div>
					    </div>
					</div>
				    </div>
				    <div class="card-footer">
					<hr />
					<div class="stats">
					    <i class="ti-calendar"></i> Last day
					</div>
				    </div>
				</div>
			    </div>
			    <div class="col-lg-3 col-sm-6">
				<div class="card">
				    <div class="card-content">
					<div class="row">
					    <div class="col-xs-5">
						<div class="icon-big icon-danger text-center">
						    <i class="ti-pulse"></i>
						</div>
					    </div>
					    <div class="col-xs-7">
						<div class="numbers">
						    <p>Errors</p>
						    23
						</div>
					    </div>
					</div>
				    </div>
				    <div class="card-footer">
					<hr />
					<div class="stats">
					    <i class="ti-timer"></i> In the last hour
					</div>
				    </div>
				</div>
			    </div>
			    <div class="col-lg-3 col-sm-6">
				<div class="card">
				    <div class="card-content">
					<div class="row">
					    <div class="col-xs-5">
						<div class="icon-big icon-info text-center">
						    <i class="ti-twitter-alt"></i>
						</div>
					    </div>
					    <div class="col-xs-7">
						<div class="numbers">
						    <p>Followers</p>
						    +45
						</div>
					    </div>
					</div>
				    </div>
				    <div class="card-footer">
					<hr />
					<div class="stats">
					    <i class="ti-reload"></i> Updated now
					</div>
				    </div>
				</div>
			    </div>
			</div>
			<div class="row">
			    <div class="col-lg-4 col-sm-6">
				<div class="card">
				    <div class="card-content">
					<div class="row">
					    <div class="col-xs-7">
						<div class="numbers pull-left">
						    $34,657
						</div>
					    </div>
					    <div class="col-xs-5">
						<div class="pull-right">
						    <span class="label label-success">
							+18%
						    </span>
						</div>
					    </div>
					</div>
					<h6 class="big-title">total earnings <span class="text-muted">in last</span> ten <span class="text-muted">quarters</span></h6>
					<div id="chartTotalEarnings"></div>
				    </div>
				    <div class="card-footer">
					<hr>
					<div class="footer-title">Financial Statistics</div>
					<div class="pull-right">
					    <button class="btn btn-info btn-fill btn-icon btn-sm">
						<i class="ti-plus"></i>
					    </button>
					</div>
				    </div>
				</div>
			    </div>
			    <div class="col-lg-4 col-sm-6">
				<div class="card">
				    <div class="card-content">
					<div class="row">
					    <div class="col-xs-7">
						<div class="numbers pull-left">
						    169
						</div>
					    </div>
					    <div class="col-xs-5">
						<div class="pull-right">
						    <span class="label label-danger">
							-14%
						    </span>
						</div>
					    </div>
					</div>
					<h6 class="big-title">total subscriptions <span class="text-muted">in last</span> 7 days</h6>
					<div id="chartTotalSubscriptions"></div>
				    </div>
				    <div class="card-footer">
					<hr>
					<div class="footer-title">View all members</div>
					<div class="pull-right">
					    <button class="btn btn-default btn-fill btn-icon btn-sm">
						<i class="ti-angle-right"></i>
					    </button>
					</div>
				    </div>
				</div>
			    </div>
			    <div class="col-lg-4 col-sm-6">
				<div class="card">
				    <div class="card-content">
					<div class="row">
					    <div class="col-xs-7">
						<div class="numbers pull-left">
						    8,960
						</div>
					    </div>
					    <div class="col-xs-5">
						<div class="pull-right">
						    <span class="label label-warning">
							~51%
						    </span>
						</div>
					    </div>
					</div>
					<h6 class="big-title">total downloads <span class="text-muted">in last</span> 6 years</h6>
					<div id="chartTotalDownloads" ></div>
				    </div>
				    <div class="card-footer">
					<hr>
					<div class="footer-title">View more details</div>
					<div class="pull-right">
					    <button class="btn btn-success btn-fill btn-icon btn-sm">
						<i class="ti-info"></i>
					    </button>
					</div>
				    </div>
				</div>
			    </div>
			</div>
			<div class="row">
			    <div class="col-lg-3 col-sm-6">
				<div class="card card-circle-chart" data-background-color="blue">
				    <div class="card-header text-center">
					<h5 class="card-title">Dashboard</h5>
					<p class="description">Monthly sales target</p>
				    </div>
				    <div class="card-content">
					<div id="chartDashboard" class="chart-circle" data-percent="70">70%</div>
				    </div>
				</div>
			    </div>
			    <div class="col-lg-3 col-sm-6">
				<div class="card card-circle-chart" data-background-color="green">
				    <div class="card-header text-center">
					<h5 class="card-title">Orders</h5>
					<p class="description">Completed</p>
				    </div>
				    <div class="card-content">
					<div id="chartOrders" class="chart-circle" data-percent="34">34%</div>
				    </div>
				</div>
			    </div>
			    <div class="col-lg-3 col-sm-6">
				<div class="card card-circle-chart" data-background-color="orange">
				    <div class="card-header text-center">
					<h5 class="card-title">New Visitors</h5>
					<p class="description">Out of total number</p>
				    </div>
				    <div class="card-content">
					<div id="chartNewVisitors" class="chart-circle" data-percent="62">62%</div>
				    </div>
				</div>
			    </div>
			    <div class="col-lg-3 col-sm-6">
				<div class="card card-circle-chart" data-background-color="brown">
				    <div class="card-header text-center">
					<h5 class="card-title">Subscriptions</h5>
					<p class="description">Monthly newsletter</p>
				    </div>
				    <div class="card-content">
					<div id="chartSubscriptions" class="chart-circle" data-percent="10">10%</div>
				    </div>
				</div>
			    </div>
			</div>
		    </div>
		</div>
		<?php require_once("../../blocks/_ADMIN_FOOTER.php"); ?>
	    </div>
	</div>

    </body>

    <!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
    <script src="/assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="/assets/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="/assets/js/perfect-scrollbar.min.js" type="text/javascript"></script>
    <script src="/assets/js/bootstrap.min_1.js" type="text/javascript"></script>

    <!--  Forms Validations Plugin -->
    <script src="/assets/js/jquery.validate.min.js"></script>

    <!-- Promise Library for SweetAlert2 working on IE -->
    <script src="/assets/js/es6-promise-auto.min.js"></script>

    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="/assets/js/moment.min.js"></script>

    <!--  Date Time Picker Plugin is included in this js file -->
    <script src="/assets/js/bootstrap-datetimepicker.js"></script>

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
	$(document).ready(function () {
	    
	    var pageTitle = $('title').text();
	    $("#page-title").text(pageTitle);
	    
	    
	    /*  **************** Chart Total Earnings - single line ******************** */

	    var dataPrice = {
		labels: ['Jan', 'Feb', 'Mar', 'April', 'May', 'June'],
		series: [
		    [230, 340, 400, 300, 570, 500, 800]
		]
	    };

	    var optionsPrice = {
		showPoint: false,
		lineSmooth: true,
		height: "210px",
		axisX: {
		    showGrid: false,
		    showLabel: true
		},
		axisY: {
		    offset: 40,
		    showGrid: false
		},
		low: 0,
		high: 'auto',
		classNames: {
		    line: 'ct-line ct-green'
		}
	    };

	    Chartist.Line('#chartTotalEarningsDoc', dataPrice, optionsPrice);

	    /*  **************** Chart Subscriptions - single line ******************** */

	    var dataDays = {
		labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
		series: [
		    [60, 50, 30, 50, 70, 60, 90, 100]
		]
	    };

	    var optionsDays = {
		showPoint: false,
		lineSmooth: true,
		height: "210px",
		axisX: {
		    showGrid: false,
		    showLabel: true
		},
		axisY: {
		    offset: 40,
		    showGrid: false
		},
		low: 0,
		high: 'auto',
		classNames: {
		    line: 'ct-line ct-red'
		}
	    };

	    Chartist.Line('#chartTotalSubscriptionsDoc', dataDays, optionsDays);


	    $('#chartDashboard, #chartOrders, #chartNewVisitors, #chartSubscriptions, #chartDashboardDoc, #chartOrdersDoc').easyPieChart({
		lineWidth: 6,
		size: 160,
		scaleColor: false,
		trackColor: 'rgba(255,255,255,.25)',
		barColor: '#FFFFFF',
		animate: ({duration: 5000, enabled: true})
	    });

	});
    </script>

</html>
