<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Dash - BitSign</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="description" content="Create, Sign and Timestamp contracts with Bitcoin">
		<meta name="author" content="BitSign.it">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
		<link href="plugins/select2/select2.css" rel="stylesheet">
		<link href="css/bitsign_style.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
<body ng-app="app">
<header class="navbar">
	<div class="container-fluid expanded-panel">
		<div class="row">
			<div id="logo" class="col-xs-12 col-sm-2">
				<a href="dashboard"><img src="img/logo.png">&nbspBitSign</a>
			</div>
			<div id="top-panel" class="col-xs-12 col-sm-10">
				<div class="row">
					<div class="col-xs-8 col-sm-4">
					</div>
					<div class="col-xs-4 col-sm-8 top-panel-right">
						<ul class="nav navbar-nav pull-right panel-menu">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle account" data-toggle="dropdown">
									<i class="fa fa-angle-down pull-right"></i>
									<div class="user-mini pull-right">
										<span class="welcome">Welcome,</span>
										<span class="uname">{{currentUser.f_name}} {{currentUser.l_name}}</span>
									</div>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="/user/profile">
											<i class="fa fa-user"></i>
											<span>Profile</span>
										</a>
									</li>
									<li>
										<a href="/user/settings">
											<i class="fa fa-cog"></i>
											<span>Settings</span>
										</a>
									</li>
									<li>
										<a ng-click="logout()">
											<i class="fa fa-power-off"></i>
											<span>Logout</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="logout-btn">
								<a href="/auth/logout">
									<i class="fa fa-power-off fa-lg"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!--End Header-->
<!--Start Container-->
<div id="main" class="container-fluid">
	<div class="row">
		<div id="sidebar-left" class="col-xs-2 col-sm-2">
			<ul class="nav main-menu">
				<li>
					<a ui-sref="home" class="active ajax-link">
						
  							<i class="fa fa-shield fa-lg"></i>
 							 
						<span class="hidden-xs">Dashboard</span>
					</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-pencil-square-o fa-1x"></i>
						 <span class="hidden-xs">Intellectual Property</span>
					</a>
					<ul class="dropdown-menu">
						<li><a ui-sref-active="active" ui-sref="manageip">Manage IP</a></li>
						<li><a ui-sref-active="active" ui-sref="createip">Create Record</a></li>
						<li><a class="ajax-link" href="ip/sell">Sell for Bitcoin</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-pencil-square-o fa-1x"></i>
						 <span class="hidden-xs">Signatures</span>
					</a>
					<ul class="dropdown-menu">
						<li><a ui-sref-active="active" ui-sref="pendingsigs">Pending</a></li>
						<li><a ui-sref-active="active" ui-sref="completedsigs">Completed</a></li>
						<li><a ui-sref-active="active" ui-sref="ajax/new_signature_1.html">Sign New Contract</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-file-text-o"></i>
						<span class="hidden-xs">Contracts</span>
					</a>
					<ul class="dropdown-menu">
						<li><a ui-sref-active="active" ui-sref="mycontracts">My Contracts</a></li>
						<li><a ui-sref-active="active" ui-sref="createcontract">New Contract</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-file-text-o"></i>
						<span class="hidden-xs">Templates</span>
					</a>
					<ul class="dropdown-menu">
						<li><a class="ajax-link" href="templates">My Templates</a></li>
						<li><a ui-sref-active="active" ui-sref="createtemplate">Create/Branch</a></li>
						<li><a class="ajax-link" href="templates">Collaborate</a></li>
						<li><a class="ajax-link" href="templates">Dispatch</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-check-square-o"></i>
						 <span class="hidden-xs">Verify</span>
					</a>
					<ul class="dropdown-menu">
						<li><a class="ajax-link" href="ajax/forms_elements.html">Verify a Contract</a></li>
						<li><a class="ajax-link" href="ajax/forms_layouts.html">Batch Verification</a></li>
						<li><a class="ajax-link" href="ajax/forms_file_uploader.html">File Uploader</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<!--Start Content-->
		<div id="content" class="col-xs-12 col-sm-10">
			<div ui-view></div>
		</div>
		<!--End Content-->
	</div>
</div>
<!--End Container-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="http://code.jquery.com/jquery.js"></script>-->
<script type="text/javascript" src="lib/jquery/dist/jquery.min.js"></script>
<!-- Angularize vendor js-->
<script type="text/javascript" src="lib/angular/angular.js"></script>
<script type="text/javascript" src="lib/angular-ui/build/angular-ui.js"></script>
<script type="text/javascript" src="lib/angular-sanitize/angular-sanitize.js"></script>
<script type="text/javascript" src="lib/angular-ui-router/release/angular-ui-router.min.js"></script>
<script type="text/javascript" src="lib/tinymce-dist/tinymce.js"></script>
<script type="text/javascript" src="lib/angular-ui-tinymce/src/tinymce.js"></script>
<script type="text/javascript" src="lib/angular-bootstrap/ui-bootstrap.min.js"></script>
<script type="text/javascript" src="lib/angular-ui-uploader/dist/uploader.js"></script>
<script type="text/javascript" src="lib/ui-select/dist/select.js"></script>
<script type="text/javascript" src="lib/ui-select/dist/select.css"></script>
<script type="text/javascript" src="lib/satellizer/satellizer.js"></script>
<script type="text/javascript" src="app/app.js"></script>
<script type="text/javascript" src="app/controllers/homeController.js"></script>
<script type="text/javascript" src="app/controllers/contractController.js"></script>
<script type="text/javascript" src="app/controllers/authController.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed 
<script src="plugins/bootstrap/bootstrap.min.js"></script>-->
<!-- file upload plusings used in file/create -->
<script type="text/javascript" src="lib/blueimp-file-upload/js/vendor/jquery.ui.widget.js"></script>
<script type="text/javascript" src="lib/blueimp-file-upload/js/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="lib/blueimp-file-upload/js/jquery.fileupload.js"></script>
<!-- All functions for this theme + document.ready processing -->
<script type="text/javascript" src="js/bitsign.js"></script>
</body>
</html>
