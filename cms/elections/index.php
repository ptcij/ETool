<?php
    ob_start();
    session_start();

    // Path to the root directory:
    define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');

    require_once(ROOT_PATH . 'assets/php/classes.php');
    require_once(ROOT_PATH . 'assets/php/Moderator.php');
    require_once(ROOT_PATH . 'assets/php/Election.php');

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

	<title>Elections</title>

	<!-- Canonical SEO -->
	<link rel="canonical" href=""/>

	<?php require_once("../../blocks/_META_TAGS.php"); ?>

	<!-- Bootstrap core CSS     -->
	<link href="/assets/css/bootstrap.min_1.css" rel="stylesheet" />
	
	<link href="/assets/css/bootstrap-datepicker3.min.css" rel="stylesheet" />

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

		<!-- Content Div Goes Here -->
		<div class="content">
		    <div class="container-fluid">
			<div class="row">
			    <div class="col-lg-12 col-md-12">
				<!-- Tool bar -->
				<div class="row">
				    <div class="col-lg-2 col-sm-1">
					<div class="card text-center">
					    <div class="card-content">
						<button data-toggle="modal" 
							data-target="#add-election" 
							rel="toolbar" title="Add Election" 
							class="btn btn-icon">
						    <i class="fa fa-plus"></i>
						</button>
					    </div>
					</div>
				    </div>
				</div>
				
				<!-- For Upcoming Elections -->
				<div class="card">
				    <div class="card-header">
					<h4 class="card-title">Upcoming Elections</h4>
				    </div><hr />
				    <div class="card-content">
					<div class="row">
					    <?php 
						$color = array();
						array_push($color, "blue", "brown", "green", "orange");
						
						$uElections = Election::getUpcoming($db->getConnectionID());
						
						for($i = 0; $i < count($uElections); $i++) { 
						    $color_index = mt_rand (0,3);
						    $uElection = $uElections[$i];
					    ?>
					    <div class="col-md-4">
						<div class="card text-center" data-background-color="<?php echo $color[$color_index]; ?>">
						    <div class="card-header">
							<div class="card-avatar">
							    <i class="fa fa-users"></i>
							</div>
						    </div>
						    <div class="card-content">
							<h4 class="card-title">
							    <?php echo $uElection["title"]; ?>
							</h4>
							<p><?php echo $uElection["date"]; ?></p>
						    </div>
						    <div class="card-footer">
							<?php if($uElection["type"] == 1) { ?>
							<a href="/cms/elections/view/gubernatorial/?electionId=<?php echo $uElection["electionId"]; ?>" class="btn btn-round">
							    View
							</a>
							<?php } else if($uElection["type"] == 2) { ?>
							<a href="/cms/elections/view/presidential/?electionId=<?php echo $uElection["electionId"]; ?>" class="btn btn-round">
							    View
							</a>
							<?php } ?>
						    </div>
						</div>
					    </div>
					    <?php } ?>
					</div>
				    </div>
				</div>
				
				<!-- All Elections -->
				<div class="card">
				    <div class="card-header">
					<h4 class="card-title">All Elections</h4>
				    </div><hr />
				    <div class="card-content">
					<div class="row">
					    <?php 
						$aElections = Election::getAll($db->getConnectionID(), 0, 10);
						
						for($i = 0; $i < count($aElections); $i++) { 
						    $color_index = mt_rand (0,3);
						    $aElection = $aElections[$i];
					    ?>
					    <div class="col-md-4">
						<div class="card text-center" data-background-color="<?php echo $color[$color_index]; ?>">
						    <div class="card-header">
							<div class="card-avatar">
							    <i class="fa fa-users"></i>
							</div>
						    </div>
						    <div class="card-content">
							<h4 class="card-title">
							    <?php echo $aElection["title"]; ?>
							</h4>
							<p><?php echo $aElection["date"]; ?></p>
						    </div>
						    <div class="card-footer">
							<?php if($aElection["type"] == 1) { ?>
							<a href="/cms/elections/view/gubernatorial/?electionId=<?php echo $aElection["electionId"]; ?>" class="btn btn-round">
							    View
							</a>
							<?php } else if($aElection["type"] == 2) { ?>
							<a href="/cms/elections/view/presidential/?electionId=<?php echo $aElection["electionId"]; ?>" class="btn btn-round">
							    View
							</a>
							<?php } ?>
						    </div>
						</div>
					    </div>
					    <?php } ?>
					</div>
				    </div>
				</div>
			    </div>
			</div>
		    </div>
		</div>
	    </div>
	</div>
	<!-- Modal For Adding ElectionL -->
        <div class="modal fade" id="add-election" role='dialog'>
            <div class="modal-dialog animated">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" 
				aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add Election</h4>
                    </div>
                    <div class="modal-body">  
                        <form id="electionForm">
			    <div class="form-group">
				<label>Election Title <small>(Required)</small></label>
				<input type="text" id="title" class="form-control" placeholder="title" />
			    </div>
			    
			    <?php 
				$sql = "SELECT * FROM ELECTIONTYPE";
				$query = new Query($sql, $db->getConnectionID());
				
				if($query->error()) {
				    echo $query->getError();
				    die();
				}
				
				while($row = $query->fetchRow()) {
			    ?>
			    <div class="radio">
				<input type="radio" name="electionType" id="type-<?php echo $row[0]; ?>" 
				       value="<?php echo $row[0]; ?>">
				<label for="type-<?php echo $row[0]; ?>">
				    <?php echo $row[1]; ?>
				</label>
			    </div>
			    <?php } ?>
			    
			    <div class="form-group">
				<label>State <small>(Required)</small><br /><small>Choose Abuja for Presidential elections</small></label>
				<select class="form-control" id="state">
				<?php 
				    $sql = "SELECT * FROM STATE";
				    $query = new Query($sql, $db->getConnectionID());

				    if($query->error()) {
					echo $query->getError();
					die();
				    }

				    while($row = $query->fetchRow()) {
				?>
				    <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				<?php } ?>
				</select>
			    </div>
			    
			    <div class="form-group">
				<label>Registered Voters</label>
				<input type="text" id="regVoters" class="form-control" placeholder="Registered Voters..." />
			    </div>

			    <div class="form-group">
				<label>Accredited Voters</label>
				<input type="text" id="acrVoters" class="form-control" placeholder="Accredited Voters..." />
			    </div>

			    <div class="form-group">
				<label>Votes Cast</label>
				<input type="text" id="votesCast" class="form-control" placeholder="Votes Cast..." />
			    </div>

			    <div class="form-group">
				<label>Valid Votes</label>
				<input type="text" id="validVotes" class="form-control" placeholder="Valid Votes..." />
			    </div>

			    <div class="form-group">
				<label>Rejected Votes</label>
				<input type="text" id="rejVotes" class="form-control" placeholder="Rejected Votes..." />
			    </div>
			    
			    <div class="form-group">
				<label>Election Date <small>(Required)</small></label>
				<input id="date" type="text" data-date-format="yyyy-mm-dd" 
				       class="form-control datepicker" placeholder="yyyy-mm-dd" />
			    </div>
			    
			    <div class="form-group">
				<label>Election Hashtag</label>
				<input id="hashtag" type="text" class="form-control" placeholder="Election hashtag..." />
			    </div>
			    
			    <div class="form-group">
				<button id="addElectionBtn" type="button" class="btn btn-round">
				    <i class="fa fa-plus-square"></i>
				    Add
				</button>
			    </div>
			</form>
                    </div>
                    <div class="modal-footer">

                    </div>        
                </div>
            </div>
        </div>
	<?php require_once("../../blocks/_ADMIN_FOOTER.php"); ?>
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
    <script src="/assets/js/bootstrap-datepicker.min.js"></script>

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
	$('.datepicker').datepicker({});
	
	$("#addElectionBtn").on("click", function (e) {
	    e.preventDefault();
	    //initialize variables
	    var title = $("#title").val();
	    var ptype = $('input[name=electionType]:checked', '#electionForm').val();
	    var state = $("#state").val();
	    var regVoters = $("#regVoters").val();
	    var acrVoters = $("#acrVoters").val();
	    var votesCast = $("#votesCast").val();
	    var validVotes = $("#validVotes").val();
	    var rejVotes = $("#rejVotes").val();
	    var date = $("#date").val();
	    var hashtag = $("#hashtag").val();

	    var type = "addElection";
	    var valid = true;
	    
	    if(title === "" || ptype === "" || state === "" || date === "") {
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
		    url: "/assets/php/AsyncScript.php",
		    type: "POST",
		    data: {
			title: title,
			ptype: ptype,
			state: state,
			regVoters: regVoters,
			acrVoters: acrVoters,
			votesCast: votesCast,
			validVotes: validVotes,
			rejVotes: rejVotes,
			date: date,
			hashtag: hashtag,
			type: type
		    },
		    dataType: "json",
		    beforeSend: function () {
		    },
		    success: function (response) {
			$.notify({
			    icon: 'pe-7s-gift',
			    message: "Election Added"
			}, {
			    type: 'success',
			    timer: 500
			});
			
			location.reload(true);
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
