<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Dash - BitSign</title>
		@include('common.head')
		@include('dashboard.head')
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
<body>
<!--Start Header-->
<!--<div id="screensaver">
	<canvas id="canvas"></canvas>
	<i class="fa fa-lock" id="screen_unlock"></i>
</div>
<div id="modalbox">
	<div class="devoops-modal">
		<div class="devoops-modal-header">
			<div class="modal-header-name">
				<span>Basic table</span>
			</div>
			<div class="box-icons">
				<a class="close-link">
					<i class="fa fa-times"></i>
				</a>
			</div>
		</div>
		<div class="devoops-modal-inner">
		</div>
		<div class="devoops-modal-bottom">
		</div>
	</div>
</div> -->
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
										<span class="uname">{{Auth::user()->f_name}} {{Auth::user()->l_name}}</span>
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
										<a href="/auth/logout">
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
					<a href="dashboard/index" class="active ajax-link">
						
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
						<li><a class="ajax-link" href="ip/create">Create Record</a></li>
						<li><a class="ajax-link" href="ip/share">Secure Share</a></li>
						<li><a class="ajax-link" href="ip/sell">Sell for Bitcoin</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-pencil-square-o fa-1x"></i>
						 <span class="hidden-xs">Signatures</span>
					</a>
					<ul class="dropdown-menu">
						<li><a class="ajax-link" href="signatures/pending">Pending</a></li>
						<li><a class="ajax-link" href="signatures/signed">Completed</a></li>
						<li><a class="ajax-link" href="ajax/new_signature_1.html">Sign New Contract</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-file-text-o"></i>
						<span class="hidden-xs">Contracts</span>
					</a>
					<ul class="dropdown-menu">
						<li><a class="ajax-link" href="contracts">My Contracts</a></li>
						<li><a class="ajax-link" href="contracts/create">New Contract</a></li>
						<li><a class="ajax-link" href="contracts/import">Import a document</a></li>
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
			<div class="preloader">
				<img src="img/devoops_getdata.gif" class="devoops-getdata" alt="preloader"/>
			</div>
			<div id="ajax-content"></div>
		</div>
		<!--End Content-->
	</div>
</div>
<!--End Container-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="http://code.jquery.com/jquery.js"></script>-->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/tinymce/tinymce.min.js"></script>
<!-- file upload plusings used in file/create -->
<script src="plugins/file-upload/js/vendor/jquery.ui.widget.js"></script>
<script src="plugins/file-upload/js/jquery.iframe-transport.js"></script>
<script src="plugins/file-upload/js/jquery.fileupload.js"></script>
<!-- All functions for this theme + document.ready processing -->
<script src="js/bitsign.js"></script>
</body>
</html>
