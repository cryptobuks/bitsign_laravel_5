<!DOCTYPE html>
<html lang="en">
<head>
	@include('common.head')
	<link href="/css/main.css" rel="stylesheet">
	<title>BitSign</title>
	<meta name="generator" content="Bootply" />
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
    
    @include('welcome.header')
    @yield('content')
    
    <!-- script references -->
	<script src="/plugins/jquery/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
</body>
</html>