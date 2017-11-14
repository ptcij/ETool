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
    
    $sessionManager = new SessionManager();
    
    if($sessionManager->isModeratorLoggedIn() === FALSE) {
	header("Location: /cms/");
	die();
    }
    
    $moderator = new Moderator($sessionManager->getModeratorId());
    
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
	<link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title><?php echo $election->getTitle(); ?></title>

	<!-- Canonical SEO -->
	<link rel="canonical" href="" />

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
				<!-- Tool bar -->
				<div class="btn-group">
				    <button data-toggle="modal" 
					    data-target="#update-election" 
					    rel="toolbar" title="Add Candidate" 
					    class="btn btn-default">
					<i class="fa fa-cog"></i>
					update Election
				    </button>
				    
				    <button data-toggle="modal" 
					    data-target="#addCandidate" 
					    rel="toolbar" title="Add Candidate" 
					    class="btn btn-default">
					<i class="fa fa-plus"></i>
					Add Candidate
				    </button>
				    
				    <button data-toggle="modal" 
					    data-target="#addUpdate" 
					    rel="toolbar" title="Add Update" 
					    class="btn btn-icon">
					<i class="fa fa-plus"></i>
					Add Update
				    </button>
				    
				    <button data-toggle="modal" 
					    data-target="#addResult" 
					    rel="toolbar" title="Add Result" 
					    class="btn btn-icon">
					<i class="fa fa-plus"></i>
					Add Result
				    </button>
				</div><br /><br />
				
				<div class="card">
				    <div class="card-header text-center">
					<h2 class="card-title"><?php echo $election->getTitle(); ?></h2>
					<p class="category"><?php echo $election->getType(); ?></p>
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
	
	
	<!-- Modal For Adding ElectionL -->
        <div class="modal fade" id="update-election" role='dialog'>
            <div class="modal-dialog animated">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" 
				aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Update Election</h4>
                    </div>
                    <div class="modal-body">  
                        <form id="electionForm">
			    <input type="hidden" id="electionId" value="<?php echo $electionId; ?>" />
			    <div class="form-group">
				<label>Election Title <small>(Required)</small></label>
				<input value="<?php echo $election->getTitle(); ?>" type="text" id="e-title" class="form-control" placeholder="title" />
			    </div>
			    
			    <div class="form-group">
				<label>Registered Voters</label>
				<input value="<?php echo $election->getRegVoters(); ?>" type="text" id="regVoters" class="form-control" placeholder="Registered Voters..." />
			    </div>

			    <div class="form-group">
				<label>Accredited Voters</label>
				<input value="<?php echo $election->getAcrVoters(); ?>" type="text" id="acrVoters" class="form-control" placeholder="Accredited Voters..." />
			    </div>

			    <div class="form-group">
				<label>Votes Cast</label>
				<input value="<?php echo $election->getVotesCast(); ?>" type="text" id="votesCast" class="form-control" placeholder="Votes Cast..." />
			    </div>

			    <div class="form-group">
				<label>Valid Votes</label>
				<input value="<?php echo $election->getValidVotes(); ?>" type="text" id="validVotes" class="form-control" placeholder="Valid Votes..." />
			    </div>

			    <div class="form-group">
				<label>Rejected Votes</label>
				<input value="<?php echo $election->getRejVotes(); ?>" type="text" id="rejVotes" class="form-control" placeholder="Rejected Votes..." />
			    </div>
			    
			    <div class="form-group">
				<label>Election Date <small>(Required)</small></label>
				<input value="<?php echo $election->getDate(); ?>" id="e-date" type="text" data-date-format="yyyy-mm-dd" 
				       class="form-control datepicker" placeholder="yyyy-mm-dd" />
			    </div>
			    
			    <div class="form-group">
				<label>Election Hashtag</label>
				<input value="<?php echo $election->getHashtag(); ?>" id="hashtag" type="text" class="form-control" placeholder="Election hashtag..." />
			    </div>
			    
			    <div class="form-group">
				<button id="addElectionBtn" type="button" class="btn btn-round">
				    <i class="fa fa-plus-square"></i>
				    Update
				</button>
			    </div>
			</form>
                    </div>
                    <div class="modal-footer">

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
    
    <!-- CKEditor Plugin -->
    <script src="/assets/js/ckeditor/ckeditor.js"></script>
    
    <script src="/assets/js/view-election.js" type="text/javascript"></script>

</html>
