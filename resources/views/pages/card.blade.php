@extends('partials.dashboard')

@section('page_title')
	Cards
@stop

@section('dashboard-content')

<div class="demo-grid-ruler mdl-grid">
	<div class="mdl-card mdl-shadow--2dp demo-card-wide mdl-cell mdl-cell--6-col material">
		<div class="mdl-card__title">
			<h2 class="mdl-card__title-text">Welcome</h2>
		</div>
		<div class="mdl-card__supporting-text">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit.
			Mauris sagittis pellentesque lacus eleifend lacinia...
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
				Get Started
			</a>
		</div>
		<div class="mdl-card__menu">
			<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
			<i class="mdi mdi-share-variant"></i>
			</button>
		</div>
	</div>
	<div class="mdl-card mdl-shadow--2dp demo-card-wide mdl-cell mdl-cell--6-col material1">
		<div class="mdl-card__title">
			<h2 class="mdl-card__title-text">Update</h2>
		</div>
		<div class="mdl-card__supporting-text">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit.
			Mauris sagittis pellentesque lacus eleifend lacinia...
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
				Get Updates
			</a>
		</div>
		<div class="mdl-card__menu">
			<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
			<i class="mdi mdi-share-variant"></i>
			</button>
		</div>
	</div>	
</div>

<div class="demo-grid-ruler mdl-grid">
	<div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col bg1">
		<div class="mdl-card__title">
			<h2 class="mdl-card__title-text">Event</h2>
		</div>
		<div class="mdl-card__supporting-text">
			Pay the electricity bill and mark it done.
			<br>
			24th August 2015
		</div>
		<div class="mdl-card__actions">
			<a class="mdl-button mdl-js-button mdl-js-ripple-effect">
				Add to calendar
			</a>
		</div>
		<div class="mdl-card__menu">
			<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
			<i class="mdi mdi-share-variant"></i>
			</button>
		</div>
	</div>
	<div class="mdl-card mdl-shadow--2dp demo-card-wide mdl-cell mdl-cell--4-col bg3">
		<div class="mdl-card__title">
		</div>
		<div class="mdl-card__supporting-text" style="text-align: center;">
			<div id="cardchart" data-percent="58"></div>
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
				Check live
			</a>
		</div>
		<div class="mdl-card__menu">
			<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
			<i class="mdi mdi-share-variant" style="color: black;"></i>
			</button>
		</div>
	</div>	
	<div class="mdl-card mdl-shadow--2dp demo-card-wide mdl-cell mdl-cell--4-col bg2">
		<div class="mdl-card__title">
			<h2 class="mdl-card__title-text">Welcome</h2>
		</div>
		<div class="mdl-card__supporting-text">
			We should meet more often	
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
				Add me
			</a>
		</div>
		<div class="mdl-card__menu">
			<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
			<i class="mdi mdi-share-variant"></i>
			</button>
		</div>
	</div>	
</div>
	

@stop

@section('js')

    @parent

    <script>
    	$(function() {
		    $('#cardchart').easyPieChart({
		        lineWidth: 15,
		        scaleColor: false,
		        size: 150,
		        lineCap: "square",
		        barColor: "#fb8c00",
		        trackColor: "#f9dcb8"
		    });
		});
    </script>

@endsection