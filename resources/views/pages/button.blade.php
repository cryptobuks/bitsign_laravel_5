@extends('partials.dashboard')

@section('page_title')
	Buttons
@stop

@section('dashboard-content')
<div class="demo-grid-ruler mdl-grid">
	<div class="mdl-cell mdl-cell--12-col shadow" style="background: white; text-align: center;">
		<div class="panel-header">Buttons</div>
		<div class="panel-body" style="padding-left: 30px;">
			<h5 style="text-align: left; margin-top: 15px;">Raised Buttons</h5>
			<button class="mdl-button mdl-js-button mdl-button--raised" style="margin-right: 10px; margin-bottom: 5px;">
			  Raised Button
			</button>						
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="margin-right: 10px; margin-bottom: 5px;">
			  Button
			</button>
			<button class="mdl-button mdl-js-button mdl-button--raised primary" style="margin-right: 10px; margin-bottom: 5px;">
			  Primary
			</button>
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" style="margin-right: 10px; margin-bottom: 5px;">
			  Accent
			</button>
			<button class="mdl-button mdl-js-button mdl-button--raised green" style="margin-right: 10px; margin-bottom: 5px;">
			  green
			</button>
			<h5 style="text-align: left; margin-top: 15px;">Flat Buttons</h5>
			<button class="mdl-button mdl-js-button" style="margin-right: 10px; margin-bottom: 5px;">
			  Raised Button
			</button>						
			<button class="mdl-button mdl-js-button mdl-button--colored" style="margin-right: 10px; margin-bottom: 5px;">
			  Button
			</button>
			<button class="mdl-button mdl-js-button primary-flat" style="margin-right: 10px; margin-bottom: 5px;">
			  Primary
			</button>
			<button class="mdl-button mdl-js-button mdl-button--accent" style="margin-right: 10px; margin-bottom: 5px;">
			  Accent
			</button>
			<button class="mdl-button mdl-js-button green-flat" style="margin-right: 10px; margin-bottom: 5px;">
			  green
			</button>
			<h5 style="text-align: left; margin-top: 15px;">With Ripple</h5>
			<button class="mdl-button mdl-js-button mdl-js-ripple-effect  mdl-button--raised" style="margin-right: 10px; margin-bottom: 5px;">
			  Raised Button
			</button>						
			<button class="mdl-button mdl-js-button mdl-button--colored mdl-js-ripple-effect" style="margin-right: 10px; margin-bottom: 5px;">
			  Button
			</button>
			<button class="mdl-button mdl-js-button primary mdl-js-ripple-effect mdl-button--raised" style="margin-right: 10px; margin-bottom: 5px;">
			  Primary
			</button>
			<button class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" style="margin-right: 10px; margin-bottom: 5px;">
			  Accent
			</button>
			<button class="mdl-button mdl-js-button green mdl-js-ripple-effect mdl-button--raised" style="margin-right: 10px; margin-bottom: 5px;">
			  green
			</button>	
			<h5 style="text-align: left; margin-top: 15px;">Icon Buttons</h5>	
			<button class="mdl-button mdl-js-button mdl-button--icon">
			 	<i class="mdi mdi-emoticon"></i>
			</button>
			<button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored">
			 	<i class="mdi mdi-heart"></i>
			</button>
			<button class="mdl-button mdl-js-button mdl-button--icon green-flat">
			 	<i class="mdi mdi-information"></i>
			</button>
			<button class="mdl-button mdl-js-button mdl-button--icon green-flat mdl-button--accent">
			 	<i class="mdi mdi-xbox"></i>
			</button>
			<h5 style="text-align: left; margin-top: 15px;">Fab Buttons</h5>	
			<button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored" style="margin-right: 10px;">
				<i class="mdi mdi-account"></i>
			</button>
			<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" style="margin-right: 10px;">
				<i class="mdi mdi-bike"></i>
			</button>
			<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect green" style="margin-right: 10px;">
				<i class="mdi mdi-bell-ring"></i>
			</button>
			<button class="mdl-button mdl-js-button mdl-button--fab primary" style="margin-right: 10px;">
				<i class="mdi mdi-key-variant"></i>
			</button>
		</div>
		</div>
	</div>
</div>
	

@stop

@section('js')

    @parent

    <script>

    </script>

@endsection