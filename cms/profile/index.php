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

	<title>Profile</title>

	<!-- Canonical SEO -->
	<link rel="canonical" href=""/>

	<?php require_once("../../blocks/_META_TAGS.php"); ?>

	<!-- Bootstrap core CSS     -->
	<link href="/assets/css/bootstrap.min_1.css" rel="stylesheet" />
	
	<!-- Fine Uploader -->
	<link href="/assets/css/fine-uploader-new.css" rel="stylesheet" type="text/css"/>

	<!--  Paper Dashboard core CSS    -->
	<link href="/assets/css/paper-dashboard.css?v=1.2.1" rel="stylesheet"/>


	<!--  Fonts and icons     -->
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
	<link href="/assets/css/themify-icons.css" rel="stylesheet">
	
	<style>
            #trigger-upload {
                    color: white;
                    background-color: #00ABC7;
                    font-size: 14px;
                    padding: 7px 20px;
                    background-image: none;
                    border-color: #00ABC7;
            }
            #fine-uploader-manual-trigger .qq-upload-button {
                    margin-right: 15px;
            }
            #fine-uploader-manual-trigger .buttons {
                    width: 36%;
            }
            #fine-uploader-manual-trigger .qq-uploader .qq-total-progress-bar-container {
                    width: 60%;
            }
        </style>
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
			    <div class="col-lg-4 col-md-5">
				<div class="card card-user">
				    <div class="image">
					<img src="/assets/img/admin_login_bg.jpg" alt="..."/>
				    </div>
				    <div class="card-content">
					<div class="author">
					    <?php if($moderator->getImageUrl() != "") { ?>
					    <img data-toggle="modal" data-target="#upload-pic-modal" class="avatar border-white" src="/assets/img/moderators/<?php echo $moderator->getImageUrl(); ?>" alt="..."/>
					    <?php } else { ?>
					    <img data-toggle="modal" data-target="#upload-pic-modal" class="avatar border-white" src="/assets/img/default-avatar.png" alt="..."/>
					    <?php } ?>
					    <h4 class="card-title"><?php echo $moderator->getName(); ?><br />
						<a href="#"><small>@<?php echo $moderator->getId(); ?></small></a>
					    </h4>
					</div>
				    </div>
				    <hr>
				</div>
				<div class="card">
				    <div class="card-header">
					<h4 class="card-title">Moderators</h4>
				    </div>
				    <div class="card-content">
					<ul class="list-unstyled team-members">
					    <?php 
						$id = $moderator->getId();
						$sql = "SELECT moderatorId FROM MODERATOR WHERE moderatorId <> '$id'";
						$query = new Query($sql, $db->getConnectionID());
						
						if($query->error()) {
						    echo $query->getError();
						    die();
						}
						
						while($row = $query->fetchRow()) {
						    $member = new Moderator($row[0]);
					    ?>
					    <li>
						<div class="row">
						    <div class="col-xs-3">
							<div class="avatar">
							    <?php if($member->getImageUrl() != "") { ?>
							    <img src="/assets/img/moderators/<?php echo $member->getImageUrl(); ?>" alt="Circle Image" 
								 class="img-circle img-no-padding img-responsive">
							    <?php } else { ?>
							    <img src="/assets/img/default-avatar.png" alt="Circle Image" 
								 class="img-circle img-no-padding img-responsive">
							    <?php } ?>
							</div>
						    </div>
						    <div class="col-xs-6">
							<?php echo $member->getName(); ?>
							<br />
							<span class="text-muted"><small>Offline</small></span>
						    </div>
						    <div class="col-xs-3 text-right">
							<?php echo $util->time_elapsed_string($member->getLastLogin()); ?>
						    </div>
						</div>
					    </li>
					    <?php } ?>
					</ul>
				    </div>
				</div>
			    </div>
			    <div class="col-lg-8 col-md-7">
				<div class="card">
				    <div class="card-header">
					<h4 class="card-title">Edit Profile</h4>
				    </div>
				    <div class="card-content">
					<form>
					    <div class="row">
						<div class="col-md-6">
						    <div class="form-group">
							<label>Name</label>
							<input readonly value="<?php echo $moderator->getName(); ?>" type="text" class="form-control border-input" placeholder="Name" >
						    </div>
						</div>
						<div class="col-md-6">
						    <div class="form-group">
							<label>Email</label>
							<input readonly value="<?php echo $moderator->getEmail(); ?>" type="text" class="form-control border-input" disabled placeholder="Email">
						    </div>
						</div>
					    </div>
					    <div class="clearfix"></div>
					</form>
				    </div>
				</div>
				<div class="card">
				    <div class="card-header">
					<h4 class="card-title">Change Password</h4>
				    </div>
				    <div class="card-content">
					<form>
					    <div>
						<div class="form-group">
						    <label>Old Password <small>(required)</small></label>
						    <input id="oldPassword" type="password" class="form-control" placeholder="Old Password">
						</div>
					    </div>
					    <div>
						<div class="form-group">
						    <label>New Password <small>(required)</small></label>
						    <input id="newPassword" type="password" class="form-control" placeholder="New Password">
						</div>
					    </div>
					    <div>
						<div class="form-group">
						    <label>Confirm Password <small>(required)</small></label>
						    <input id="confPassword" type="password" class="form-control" placeholder="Confirm New Password">
						</div>
					    </div>
					    <div>
						<div class="form-group">
						    <button id="changePassBtn" type="button" class="btn btn-primary btn-block"> Change Password </button>
						</div>
					    </div>
					    <div class="clearfix"></div>
					</form>
				    </div>
				</div>
			    </div>
			</div>
		    </div>
		</div>
	    </div>
	</div>
	<!-- Modal For CAROUSEL -->
        <div class="modal fade" id="upload-pic-modal" role='dialog'>
            <div class="modal-dialog animated">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Profile Pic Upload <small class="label label-danger">2000x1331 ONLY</small></h4>
                    </div>
                    <div class="modal-body">  
                        <div class="box">
                            <div class="content">
                                <div class="error"></div>
                                <div id="fine-uploader"></div>
                            </div>
                        </div>
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
    
    <!-- Fine Uploader -->
    <script src="/assets/js/jquery.fine-uploader.js"></script>

    <script type="text/template" id="qq-template">
        <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
        <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
        </div>
        <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
        <span class="qq-upload-drop-area-text-selector"></span>
        </div>
        <div class="buttons">
        <div class="qq-upload-button-selector qq-upload-button">
        <div>Select files</div>
        </div>&nbsp;&nbsp;
        <button type="button" id="trigger-upload" class="btn btn-primary">
        <i class="icon-upload icon-white"></i> Upload
        </button>
        </div>
        <span class="qq-drop-processing-selector qq-drop-processing">
        <span>Processing dropped files...</span>
        <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
        </span>
        <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
        <li>
        <div class="qq-progress-bar-container-selector">
        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
        </div>
        <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
        <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
        <span class="qq-upload-file-selector qq-upload-file"></span>
        <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
        <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
        <span class="qq-upload-size-selector qq-upload-size"></span>
        <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>
        <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
        <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Delete</button>
        <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
        </li>
        </ul>

        <dialog class="qq-alert-dialog-selector">
        <div class="qq-dialog-message-selector"></div>
        <div class="qq-dialog-buttons">
        <button type="button" class="qq-cancel-button-selector">Close</button>
        </div>
        </dialog>

        <dialog class="qq-confirm-dialog-selector">
        <div class="qq-dialog-message-selector"></div>
        <div class="qq-dialog-buttons">
        <button type="button" class="qq-cancel-button-selector">No</button>
        <button type="button" class="qq-ok-button-selector">Yes</button>
        </div>
        </dialog>

        <dialog class="qq-prompt-dialog-selector">
        <div class="qq-dialog-message-selector"></div>
        <input type="text">
        <div class="qq-dialog-buttons">
        <button type="button" class="qq-cancel-button-selector">Cancel</button>
        <button type="button" class="qq-ok-button-selector">Ok</button>
        </div>
        </dialog>
        </div>
    </script>

    <script src="/assets/js/moderator-profile.js" type="text/javascript"></script>

</html>
