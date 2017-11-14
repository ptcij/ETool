
<!doctype html>
<html lang="en">
    <head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Login</title>

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
	<nav class="navbar navbar-toggleable-md fixed-top navbar-transparent">
	    <div class="container">
		<div class="navbar-translate">
		    <button class="navbar-toggler navbar-toggler-right navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-bar"></span>
			<span class="navbar-toggler-bar"></span>
			<span class="navbar-toggler-bar"></span>
		    </button>
		    <a class="navbar-brand" href="/">Udeme</a>
		</div>
		<div class="collapse navbar-collapse" id="navbarToggler">
		    <ul class="navbar-nav ml-auto">
			<li class="nav-item">
			    <a class="nav-link" href="/blog/">
				<i class="nc-icon nc-book-bookmark"></i>
				Blog
			    </a>
			</li>
		    </ul>
		</div>
	    </div>
	</nav>
	<div class="wrapper">
	    <div class="page-header" style="background-image: url('../assets/img/login-image.jpg');">
		<div class="filter filter-blue"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 offset-lg-4 col-sm-6 offset-sm-3">
                            <div class="card card-register">
                                <h3 class="title">Login</h3>
				<div class="social-line text-center">
                                    <a href="#pablo" class="btn btn-neutral btn-facebook btn-just-icon">
                                        <i class="fa fa-facebook-square"></i>
                                    </a>
                                    <a href="#pablo" class="btn btn-neutral btn-google btn-just-icon">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
				    <a href="#pablo" class="btn btn-neutral btn-twitter btn-just-icon">
					<i class="fa fa-twitter"></i>
				    </a>
                                </div>
                                <form class="register-form">
                                    <label>Email</label>
                                    <input type="text" class="form-control" placeholder="Email">

                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password">
                                    <button class="btn btn-danger btn-block btn-round">Login</button>
                                </form>
                                <div class="forgot">
                                    <a href="#" class="btn btn-link btn-danger">Forgot password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
		    <div class="footer register-footer text-center">
			<h6>&copy; <script>document.write(new Date().getFullYear())</script>, Udeme
		    </div>
                </div>
	    </div>
	</div>
    </body>

    <!-- Core JS Files -->
    <script src="/assets/js/jquery-3.2.1.js" type="text/javascript"></script>
    <script src="/assets/js/jquery-ui-1.12.1.custom.min.js" type="text/javascript"></script>
    <script src="/assets/js/tether.min.js" type="text/javascript"></script>
    <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Paper Kit Initialization snd functons -->
    <script src="/assets/js/paper-kit.js?v=2.0.1"></script>

</html>