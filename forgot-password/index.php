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
    
    if($sessionManager->isCitizenLoggedIn() === TRUE) {
	header("Location: /timeline/");
    }
?>
<!doctype html>
<html lang="en">
    <head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Forgot Password</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />

	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/assets/css/paper-kit.css?v=2.0.1" rel="stylesheet"/>
	<link href="/assets/css/demo.css" rel="stylesheet" />

	<!--     Fonts and icons     -->
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link href="/assets/css/nucleo-icons.css" rel="stylesheet">

    </head>
    <body>
	<!-- include navigation -->
	<?php require_once("../blocks/_NAV.php"); ?>
	<div class="wrapper">
	    <div class="page-header" style="background-image: url('../assets/img/udeme_home_bg.jpg');">
		<div class="filter filter-red"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 ml-auto mr-auto">
                            <div class="card card-plain" data-background="color" data-color="white">
                                <h3 class="title text-center">Forgot Password</h3>
				<div class="alert alert-info">
                                    A link to reset your password will be sent 
				    to provided email.
                                </div>
                                <form class="register-form">
                                    <label style="color: #ffffff">Email</label>
                                    <input type="text" class="form-control" placeholder="Email">
				    <br /><br />
                                    <button class="btn btn-danger btn-block btn-round">Send Link</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
	    </div>
	</div>
	<footer class="footer section-dark">
	    <div class="container">
		<div class="row">
		    <nav class="footer-nav">
			<ul>
			    <li><a href="/">Udeme</a></li>
			    <li><a href="/blog/">Blog</a></li>
			</ul>
		    </nav>
		    <div class="credits ml-auto">
			<span class="copyright">
			    © <script>document.write(new Date().getFullYear())</script>, Udeme
			</span>
		    </div>
		</div>
	    </div>
	</footer>
    </body>

    <!-- Core JS Files -->
    <script src="/assets/js/jquery-3.2.1.js" type="text/javascript"></script>
    <script src="/assets/js/jquery-ui-1.12.1.custom.min.js" type="text/javascript"></script>
    <script src="/assets/js/tether.min.js" type="text/javascript"></script>
    <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Paper Kit Initialization snd functons -->
    <script src="/assets/js/paper-kit.js?v=2.0.1"></script>

</html>
