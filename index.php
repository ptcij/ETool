<?php
    ob_start();
    session_start();

    // Path to the root directory:
    define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');

    require_once(ROOT_PATH . 'assets/php/classes.php');
    require_once(ROOT_PATH . 'assets/php/Election.php');

    $config = new Config();

    $db = new DataBase($config->getDbConfig());
    $util = new Utility();

    if(!$db->connect($config->getDbConfig())) {
	header('HTTP/1.1 500 Internal Server Booboo');
	echo $db->getError();
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

    </head>
    <body>
	<!-- include navigation -->
	<?php require_once("blocks/_NAV.php"); ?>
	<div class="wrapper">
	    <div class="main">
		<div class="section">
		    <div class="container">
			<div class="row">
			    <!-- Main Bar -->
			    <div class="col-md-12">
				<!-- For Upcoming Elections -->
				<h4 class="card-title">Upcoming Elections</h4>
				<hr />
				<div class="row">
				    <?php 
					$uElections = Election::getUpcoming($db->getConnectionID());

					for($i = 0; $i < count($uElections); $i++) { 
					    $uElection = $uElections[$i];
				    ?>
				    <div class="col-md-4">
					<div class="card text-center" data-background="color" data-color="blue">
					    <div class="card-body">
						<h6 class="card-category">
						    <?php 
							if($uElection["type"] == 1) { 
							    echo "Gubernatorial";
							} else if($uElection["type"] == 2) {
							    echo "Presidential";
							}
						    ?>
						</h6>
						<div class="card-icon">
						    <i class="nc-icon nc-money-coins"></i>
						</div>
						<h4 class="card-title"><?php echo $uElection["title"]; ?></h4>
						<label>1 week ago</label>
						<p><?php echo $uElection["date"]; ?></p>
					    </div>
					    <div class="card-footer">
						<?php if($uElection["type"] == 1) { ?>
						<a href="/elections/view/gubernatorial/?electionId=<?php echo $uElection["electionId"]; ?>" class="btn btn-round">
						    View
						</a>
						<?php } else if($uElection["type"] == 2) { ?>
						<a href="/elections/view/presidential/?electionId=<?php echo $uElection["electionId"]; ?>" class="btn btn-round">
						    View
						</a>
						<?php } ?>
					    </div>
					</div>
				    </div>
				    <?php } ?>
				</div>
				
				<!-- All Elections -->
				<h4 class="card-title">All Elections</h4>
				<hr />
				<div class="row">
				    <?php 
					$aElections = Election::getAll($db->getConnectionID(), 0, 10);

					for($i = 0; $i < count($aElections); $i++) { 
					    $color_index = mt_rand (0,3);
					    $aElection = $aElections[$i];
				    ?>
				    <div class="col-md-4">
					<div class="card text-center" data-background="color" data-color="blue">
					    <div class="card-body">
						<h6 class="card-category">
						    <?php 
							if($aElection["type"] == 1) { 
							    echo "Gubernatorial";
							} else if($aElection["type"] == 2) {
							    echo "Presidential";
							}
						    ?>
						</h6>
						<div class="card-icon">
						    <i class="nc-icon nc-money-coins"></i>
						</div>
						<h4 class="card-title"><?php echo $aElection["title"]; ?></h4>
						<label>1 week ago</label>
						<p><?php echo $aElection["date"]; ?></p>
					    </div>
					    <div class="card-footer">
						<?php if($aElection["type"] == 1) { ?>
						<a href="/elections/view/gubernatorial/?electionId=<?php echo $aElection["electionId"]; ?>" class="btn btn-round">
						    View
						</a>
						<?php } else if($aElection["type"] == 2) { ?>
						<a href="/elections/view/presidential/?electionId=<?php echo $aElection["electionId"]; ?>" class="btn btn-round">
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
	<?php require_once("blocks/_FOOTER.php"); ?>    
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

