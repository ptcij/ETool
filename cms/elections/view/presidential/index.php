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

	<title>View Election</title>

	<!-- Canonical SEO -->
	<link rel="canonical" href=""/>

	<?php require_once("../../../../blocks/_META_TAGS.php"); ?>

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
	    <?php require_once("../../../../blocks/_ADMIN_SIDEBAR.php"); ?>

	    <div class="main-panel">
		<?php require_once("../../../../blocks/_ADMIN_NAV.php"); ?>

		<!-- Content Div Goes Here -->
		<div class="content">
		    <div class="container-fluid">
			<div class="row">
			    <div class="col-lg-12 col-md-12">
				<div class="card">
				    <div class="card-header text-center">
					<h2 class="card-title">Anambra Gubernatorial Elections 2017</h2>
					<p class="category">Gubernatorial</p>
				    </div>
				    <div class="card-content">
					<div class="nav-tabs-navigation">
					    <div class="nav-tabs-wrapper">
						<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
						    <li class="active"><a href="#updates" data-toggle="tab">Updates</a></li>
						    <li><a href="#candidates" data-toggle="tab">Candidates</a></li>
						    <li><a href="#results" data-toggle="tab">Results</a></li>
						</ul>
					    </div>
					</div>
					<div id="my-tab-content" class="tab-content">
					    <div class="tab-pane active" id="updates">
						<?php require_once("../../../../blocks/_ELECTION_UPDATES.php"); ?>
					    </div>
					    <div class="tab-pane" id="candidates">
						<?php require_once("../../../../blocks/_ELECTION_CANDIDATES.php"); ?>
					    </div>
					    <div class="tab-pane" id="results">
						<?php require_once("../../../../blocks/_ELECTION_RESULTS.php"); ?>
					    </div>
					</div>
				    </div>
				</div>
				
				
				<!--<div class="card">
				    <div class="card-header">
					<h2 class="card-title">
					    Anambra Gubernatorial Elections
					</h2>
					<hr />
					<ul class="list-inline">
					    <li>
						<a href="/cms/elections/candidates/" class="btn btn-icon">
						    Candidates
						</a>
					    </li>
					    <li>
						<a href="/cms/elections/results/" class="btn btn-icon">
						    Results
						</a>
					    </li>
					</ul>
				    </div>
				    <hr />
				    <div class="card-content">
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
				    <hr />
				</div>-->
				
			    </div>
			</div>
		    </div>
		</div>
	    </div>
	</div>
	<?php require_once("../../../../blocks/_ADMIN_FOOTER.php"); ?>
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

    <script src="/assets/js/moderator-profile.js" type="text/javascript"></script>
    
    <script>
	$('#chartDashboard, #chartOrders, #chartNewVisitors, #chartSubscriptions, #chartDashboardDoc, #chartOrdersDoc').easyPieChart({
	    lineWidth: 6,
	    size: 160,
	    scaleColor: false,
	    trackColor: 'rgba(255,255,255,.25)',
	    barColor: '#FFFFFF',
	    animate: ({duration: 5000, enabled: true})
	});
    </script>
    
    <script type="text/javascript">

	var $table = $('#bootstrap-table');

	function operateFormatter(value, row, index) {
	    return [
		'<div class="table-icons">',
		    '<a rel="tooltip" title="Remove" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)">',
			'<i class="ti-close"></i>',
		    '</a>',
		'</div>',
	    ].join('');
	}

	$().ready(function(){
	    window.operateEvents = {
		'click .view': function (e, value, row, index) {
		    info = JSON.stringify(row);

		    swal('You click view icon, row: ', info);
		    console.log(info);
		},
		'click .edit': function (e, value, row, index) {
		    info = JSON.stringify(row);

		    swal('You click edit icon, row: ', info);
		    console.log(info);
		},
		'click .remove': function (e, value, row, index) {
		    console.log(row);
		    $table.bootstrapTable('remove', {
			field: 'id',
			values: [row.id]
		    });
		}
	    };

	    $table.bootstrapTable({
		toolbar: ".toolbar",
		clickToSelect: true,
		showRefresh: true,
		search: true,
		showToggle: true,
		showColumns: true,
		pagination: true,
		searchAlign: 'left',
		pageSize: 8,
		pageList: [8,10,25,50,100],

		formatShowingRows: function(pageFrom, pageTo, totalRows){
		    //do nothing here, we don't want to show the text "showing x of y from..."
		},
		formatRecordsPerPage: function(pageNumber){
		    return pageNumber + " rows visible";
		},
		icons: {
		    refresh: 'fa fa-refresh',
		    toggle: 'fa fa-th-list',
		    columns: 'fa fa-columns',
		    detailOpen: 'fa fa-plus-circle',
		    detailClose: 'ti-close'
		}
	    });

	    //activate the tooltips after the data table is initialized
	    $('[rel="tooltip"]').tooltip();

	    $(window).resize(function () {
		$table.bootstrapTable('resetView');
	    });
	});

    </script>

</html>
