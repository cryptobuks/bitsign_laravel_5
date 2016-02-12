<!DOCTYPE html>
<html lang="en">
<head>
	<title>Material Laravel Dashboard | @yield('page_title')</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	
	<link rel="stylesheet" href="{{ asset("css/vendor.css") }}" />
	<link rel="stylesheet" href="{{ asset("css/app-".(\Session::has('theme') ? \Session::get('theme') : 'blue').".css") }}" />
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

</head>
	<body class="small-sidebar {{ \Session::get('layout') == 'extended' ? 'extended' : '' }} {{ \Session::get('rtl') == 'rtl' ? 'rtl' : '' }} ">
		@yield('body')			
		<script src="{{ asset("js/vendor.js") }}" type="text/javascript"></script>
		
		@yield('js')
	</body>
</html>