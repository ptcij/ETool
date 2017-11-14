<?php
    ob_start();
    session_start();

    // Path to the root directory:
    define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');

    require_once(ROOT_PATH . 'assets/php/classes.php');
    require_once(ROOT_PATH . 'assets/php/Moderator.php');
    require_once(ROOT_PATH . 'assets/php/Election.php');
    require_once(ROOT_PATH . 'assets/php/PoliticalParty.php');
    require_once(ROOT_PATH . 'assets/php/LocalGov.php');

    $config = new Config();

    $db = new DataBase($config->getDbConfig());
    $util = new Utility();

    if(!$db->connect($config->getDbConfig())) {
	header('HTTP/1.1 500 Internal Server Booboo');
	echo $db->getError();
	die();
    }
    
    if(isset($_GET["electionId"])) {
	$electionId = $util->data_filter($_GET["electionId"], $db->getConnectionID());
	$election = new Election($electionId);
    } else {
	echo "you are not supposed to be here";
	die();
    }
?>
<!doctype html>
<html lang="en">
    <head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Elections</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />

	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/assets/css/paper-kit.css?v=2.0.1" rel="stylesheet"/>

	<!--     Fonts and icons     -->
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link href="/assets/css/nucleo-icons.css" rel="stylesheet">

	<style>
	    .timeline {
		list-style: none;
		padding: 20px 0 20px;
		position: relative;
	    }
	    .timeline:before {
		top: 0;
		bottom: 0;
		position: absolute;
		content: " ";
		width: 3px;
		background-color: #eeeeee;
		left: 50%;
		margin-left: -1.5px;
	    }
	    .timeline > li {
		margin-bottom: 20px;
		position: relative;
	    }
	    .timeline > li:before,
	    .timeline > li:after {
		content: " ";
		display: table;
	    }
	    .timeline > li:after {
		clear: both;
	    }
	    .timeline > li:before,
	    .timeline > li:after {
		content: " ";
		display: table;
	    }
	    .timeline > li:after {
		clear: both;
	    }
	    .timeline > li > .timeline-panel {
		width: 50%;
		float: left;
		border: 1px solid #d4d4d4;
		border-radius: 2px;
		padding: 20px;
		position: relative;
		-webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
		box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
	    }
	    .timeline > li.timeline-inverted + li:not(.timeline-inverted),
	    .timeline > li:not(.timeline-inverted) + li.timeline-inverted {
		margin-top: -60px;
	    }

	    .timeline > li:not(.timeline-inverted) {
		padding-right:90px;
	    }

	    .timeline > li.timeline-inverted {
		padding-left:90px;
	    }
	    .timeline > li > .timeline-panel:before {
		position: absolute;
		top: 26px;
		right: -15px;
		display: inline-block;
		border-top: 15px solid transparent;
		border-left: 15px solid #ccc;
		border-right: 0 solid #ccc;
		border-bottom: 15px solid transparent;
		content: " ";
	    }
	    .timeline > li > .timeline-panel:after {
		position: absolute;
		top: 27px;
		right: -14px;
		display: inline-block;
		border-top: 14px solid transparent;
		border-left: 14px solid #fff;
		border-right: 0 solid #fff;
		border-bottom: 14px solid transparent;
		content: " ";
	    }
	    .timeline > li > .timeline-badge {
		color: #fff;
		width: 50px;
		height: 50px;
		line-height: 50px;
		font-size: 1.4em;
		text-align: center;
		position: absolute;
		top: 16px;
		left: 50%;
		margin-left: -25px;
		background-color: #999999;
		z-index: 100;
		border-top-right-radius: 50%;
		border-top-left-radius: 50%;
		border-bottom-right-radius: 50%;
		border-bottom-left-radius: 50%;
	    }
	    .timeline > li.timeline-inverted > .timeline-panel {
		float: right;
	    }
	    .timeline > li.timeline-inverted > .timeline-panel:before {
		border-left-width: 0;
		border-right-width: 15px;
		left: -15px;
		right: auto;
	    }
	    .timeline > li.timeline-inverted > .timeline-panel:after {
		border-left-width: 0;
		border-right-width: 14px;
		left: -14px;
		right: auto;
	    }
	    .timeline-badge.primary {
		background-color: #2e6da4 !important;
	    }
	    .timeline-badge.success {
		background-color: #3f903f !important;
	    }
	    .timeline-badge.warning {
		background-color: #f0ad4e !important;
	    }
	    .timeline-badge.danger {
		background-color: #d9534f !important;
	    }
	    .timeline-badge.info {
		background-color: #5bc0de !important;
	    }
	    .timeline-title {
		margin-top: 0;
		color: inherit;
	    }
	    .timeline-body > p,
	    .timeline-body > ul {
		margin-bottom: 0;
	    }
	    .timeline-body > p + p {
		margin-top: 5px;
	    }
	</style>
    </head>
    <body>
	<!-- include navigation -->
	<?php require_once("../../../blocks/_NAV.php"); ?>
	<div class="wrapper">
	    <div class="main">
		<div class="section">
		    <div class="container">
			<div class="row">
			    <!-- Main Bar -->
			    <div class="col-md-12">
				<div class="header text-center">
				    <h2 class="title"><?php echo $election->getTitle(); ?></h2>
				    <h4 class="category"><?php echo $election->getType(); ?></h4>
				</div><br />
				<div class="text-center">
				    <ul class="nav nav-pills nav-pills-danger nav-justified">
					<li class="nav-item">
					    <a class="nav-link active" data-toggle="pill" 
					       href="#updates" role="tab">
						Updates
					    </a>
					</li>
					<li class="nav-item">
					    <a class="nav-link" data-toggle="pill" 
					       href="#candidates" role="tab">
						Candidates
					    </a>
					</li>
					<li class="nav-item">
					    <a class="nav-link" data-toggle="pill" 
					       href="#results" role="tab">
						Results
					    </a>
					</li>
					<li class="nav-item">
					    <a class="nav-link" data-toggle="pill" 
					       href="#twitter-feed" role="tab">
						Twitter Feed
					    </a>
					</li>
				    </ul>
				</div>
				<hr />
				<!-- Pill panes -->
				<div class="tab-content">
				    <div class="tab-pane active" id="updates" role="tabpanel">
					<?php require_once("../../../blocks/_UPDATES.php"); ?>
				    </div>
				    <div class="tab-pane" id="candidates" role="tabpanel">
					<?php require_once("../../../blocks/_CANDIDATES.php"); ?>
				    </div>
				    <div class="tab-pane" id="results" role="tabpanel">
					<?php require_once("../../../blocks/_RESULTS.php"); ?>
				    </div>
				    <div class="tab-pane" id="twitter-feed" role="tabpanel">
					<div class="card">
					    <div class="card-body">
						<h6 class="author pull-left">Faruk Nasir</h6>
						<span class="category-social text-info pull-right">
						    <i class="fa fa-twitter"></i>
						</span>
						<div class="clearfix"></div>
						<p class="card-description">
						    "It clarifies the product’s structure. 
						    Better still, it can make the product 
						    clearly express its function by making 
						    use of the <a href="#twitter" class="text-danger">@mike</a>'s 
						    intuition. At best, it is self-explanatory."
						</p>
					    </div>
					</div>
				    </div>
				</div>
			    </div>
			</div>
		    </div>
		</div>
	    </div>
	</div>
	<?php require_once("../../../blocks/_FOOTER.php"); ?>    
    </body>

    <!-- Core JS Files -->
    <script src="/assets/js/jquery-3.2.1.js" type="text/javascript"></script>
    <script src="/assets/js/jquery-ui-1.12.1.custom.min.js" type="text/javascript"></script>
    <script src="/assets/js/popper.js" type="text/javascript"></script>
    <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Switches -->
    <script src="/assets/js/bootstrap-switch.min.js"></script>

    <!-- Sharrre plugin -->
    <script src="/assets/js/jquery.sharrre.js"></script>

    <!--  Plugins for Slider -->
    <script src="/assets/js/nouislider.js"></script>

    <!--  Photoswipe files -->
    <script src="/assets/js/photoswipe.min.js"></script>
    <script src="/assets/js/photoswipe-ui-default.min.js"></script>
    <script src="/assets/js/init-gallery.js"></script>

    <!--  Plugins for Select -->
    <script src="/assets/js/bootstrap-select.js"></script>

    <!--  for fileupload -->
    <script src="/assets/js/jasny-bootstrap.min.js"></script>

    <!--  Plugins for Tags -->
    <script src="/assets/js/bootstrap-tagsinput.js"></script>

    <!--  Plugins for DateTimePicker -->
    <script src="/assets/js/moment.min.js"></script>
    <script src="/assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="/assets/js/paper-kit.js?v=2.1.0"></script>
</html>

