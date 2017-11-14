<?php
    ob_start();
    session_start();

    // Path to the root directory:
    define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');

    require_once(ROOT_PATH . 'assets/php/classes.php');
    require_once(ROOT_PATH . 'assets/php/Moderator.php');
    require_once(ROOT_PATH . 'assets/php/PoliticalParty.php');

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

	<title>Political Parties</title>

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
							data-target="#add-party" 
							rel="toolbar" title="Add Political Party" 
							class="btn btn-icon">
						    <i class="fa fa-plus"></i>
						</button>
					    </div>
					</div>
				    </div>
				</div>
				
				
				<div class="card">
				    <div class="card-header">
					
				    </div>
				    <div class="card-content">
					<table id="bootstrap-table" class="table">
					    <thead>
						<!--<th data-field="state" data-checkbox="true"></th>-->
					    <th data-field="id" data-sortable="true">ID</th>
					    <th data-field="initials">Initials</th>
					    <th data-field="name">Name</th>
					    <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
					    </thead>
					    <tbody>
						<?php 
						    $parties = PoliticalParty::getParties($db->getConnectionID());
						    
						    for($i = 0; $i < count($parties); $i++) {
							$party = $parties[$i];
						?>
						<tr>
						    <td><?php echo $party["id"]; ?></td>
						    <td><?php echo $party["initials"]; ?></td>
						    <td><?php echo $party["name"]; ?></td>
						    <td></td>
						</tr>
						<?php } ?>
					    </tbody>
					</table>
				    </div>
				</div>
			    </div>
			</div>
		    </div>
		</div>
	    </div>
	</div>
	
	
	<!-- Modal For Adding ElectionL -->
        <div class="modal fade" id="add-party" role='dialog'>
            <div class="modal-dialog animated">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">New Political Party</h4>
                    </div>
                    <div class="modal-body">  
                        <form>
			    <div class="form-group">
				<label>Party Initials</label>
				<input type="text" id="p-initials" class="form-control" placeholder="Party initials..." />
			    </div>
			    
			    <div class="form-group">
				<label>Party Name</label>
				<input type="text" id="p-name" class="form-control" placeholder="Party name..." />
			    </div>
			    
			    <div class="form-group">
				<button id="addPartyBtn" type="button" class="btn btn-round">
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
		'click .remove': function (e, value, row, index) {
		    console.log(row);
		    var partyId = row.id;
		    
		    var type = "deleteParty";
		    var valid = true;

		    if(partyId === "") {
			valid = false;
		    }

		    if (valid === false) {
			$.notify({
			    icon: 'pe-7s-gift',
			    message: "Fields Empty."

			}, {
			    type: 'danger',
			    timer: 500
			});
		    } else {
			$.ajax({
			    url: "/assets/php/AsyncScript.php",
			    type: "POST",
			    data: {
				partyId: partyId,
				type: type
			    },
			    dataType: "json",
			    beforeSend: function () {
			    },
			    success: function (response) {
				$.notify({
				    icon: 'pe-7s-gift',
				    message: "Party Added"
				}, {
				    type: 'success',
				    timer: 500
				});

				//location.reload(true);
				
				$table.bootstrapTable('remove', {
				    field: 'id',
				    values: [row.id]
				});
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
	
	
	$("#addPartyBtn").on("click", function (e) {
	    e.preventDefault();
	    //initialize variables
	    var initials = $("#p-initials").val();
	    var name = $("#p-name").val();

	    var type = "addParty";
	    var valid = true;
	    
	    if(initials === "" || name === "") {
		valid = false;
	    }

	    if (valid === false) {
		$.notify({
		    icon: 'pe-7s-gift',
		    message: "Fields Empty."

		}, {
		    type: 'danger',
		    timer: 500
		});
	    } else {
		$.ajax({
		    url: "/assets/php/AsyncScript.php",
		    type: "POST",
		    data: {
			initials: initials,
			name: name,
			type: type
		    },
		    dataType: "json",
		    beforeSend: function () {
		    },
		    success: function (response) {
			$.notify({
			    icon: 'pe-7s-gift',
			    message: "Party Added"
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
	
	$(".delPartyBtn").on("click", function (e) {
	    e.preventDefault();
	    //initialize variables
	    var fullId = this.id;
	    var idArray = fullId.split('-');
	    var partyId = idArray[1];

	    var type = "deleteParty";
	    var valid = true;
	    
	    if(partyId === "") {
		valid = false;
	    }

	    if (valid === false) {
		$.notify({
		    icon: 'pe-7s-gift',
		    message: "Fields Empty."

		}, {
		    type: 'danger',
		    timer: 500
		});
	    } else {
		$.ajax({
		    url: "/assets/php/AsyncScript.php",
		    type: "POST",
		    data: {
			partyId: partyId,
			type: type
		    },
		    dataType: "json",
		    beforeSend: function () {
		    },
		    success: function (response) {
			$.notify({
			    icon: 'pe-7s-gift',
			    message: "Party Deleted"
			}, {
			    type: 'success',
			    timer: 500
			});
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
