@extends('partials.dashboard')

@section('page_title')
	Components
@stop

@section('dashboard-content')
	<div class="table-container">
		<div class="mdl-grid">
			<div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-phone mdl-cell--12-col-tablet">
				<table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp shadow">
					<thead>
						<tr>
							<th class="mdl-data-table__cell--non-numeric">Material</th>
							<th>Quantity</th>
							<th>Unit price</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="mdl-data-table__cell--non-numeric">Acrylic (Transparent)</td>
							<td>25</td>
							<td>$2.90</td>
						</tr>
						<tr>
							<td class="mdl-data-table__cell--non-numeric">Plywood (Birch)</td>
							<td>50</td>
							<td>$1.25</td>
						</tr>
						<tr>
							<td class="mdl-data-table__cell--non-numeric">Laminate (Gold on Blue)</td>
							<td>10</td>
							<td>$2.35</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-phone mdl-cell--12-col-tablet">
				<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp shadow">
					<thead>
						<tr>
							<th class="mdl-data-table__cell--non-numeric">Material</th>
							<th>Quantity</th>
							<th>Unit price</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="mdl-data-table__cell--non-numeric">Acrylic (Transparent)</td>
							<td>25</td>
							<td>$2.90</td>
						</tr>
						<tr>
							<td class="mdl-data-table__cell--non-numeric">Plywood (Birch)</td>
							<td>50</td>
							<td>$1.25</td>
						</tr>
						<tr>
							<td class="mdl-data-table__cell--non-numeric">Laminate (Gold on Blue)</td>
							<td>10</td>
							<td>$2.35</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="mdl-grid bars">
		<div class="mdl-cell shadow mdl-cell--12-col" style="background: white; padding:15px; width: 90%; margin: 25px auto;">
			<h5 style="margin-bottom: 30px; padding-left: 15px; margin-top: 15px;">Loading Bars</h5>
			<div class="bar" style="margin: 15px;">	
			<div id="p1" class="mdl-progress mdl-js-progress progress-demo"></div>
			</div>
			<div class="bar" style="margin: 15px;">
			<div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate progress-demo"></div>
			</div>
			<div class="bar" style="margin: 15px;">
			<div id="p3" class="mdl-progress mdl-js-progress progress-demo"></div>
			</div>		
		</div>	
	</div>
	<div class="mdl-grid tabs">
		<div class="mdl-cell shadow mdl-cell--12-col" style="background: white; padding:15px; width: 90%; margin: 25px auto;">
			<h5 style="margin-bottom: 30px; padding-left: 15px; margin-top: 15px;">Tabs</h5>
			<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
				<div class="mdl-tabs__tab-bar">
					<a href="#starks-panel" class="mdl-tabs__tab is-active">Starks</a>
					<a href="#lannisters-panel" class="mdl-tabs__tab">Lannisters</a>
					<a href="#targaryens-panel" class="mdl-tabs__tab">Targaryens</a>
				</div>

				<div class="mdl-tabs__panel is-active" id="starks-panel">
					<ul>
						<li>Eddard</li>
						<li>Catelyn</li>
						<li>Robb</li>
						<li>Sansa</li>
						<li>Brandon</li>
						<li>Arya</li>
						<li>Rickon</li>
					</ul>
				</div>
				<div class="mdl-tabs__panel" id="lannisters-panel">
					<ul>
						<li>Tywin</li>
						<li>Cersei</li>
						<li>Jamie</li>
						<li>Tyrion</li>
					</ul>
				</div>
				<div class="mdl-tabs__panel" id="targaryens-panel">
					<ul>
						<li>Viserys</li>
						<li>Daenerys</li>
					</ul>
				</div>
			</div>		
		</div>	
	</div>
	<div class="mdl-grid sliders">
		<div class="mdl-cell shadow mdl-cell--12-col" style="background: white; padding:15px; width: 90%; margin: 25px auto;">
			<h5 style="margin-bottom: 30px; padding-left: 15px; margin-top: 15px;">Sliders</h5>			
				<input class="mdl-slider mdl-js-slider" type="range" min="0" max="100" value="0" tabindex="0"/>			
				<input class="mdl-slider mdl-js-slider" type="range" min="0" max="100" value="25" tabindex="0"/>	
		</div>	
	</div>
	<div class="mdl-grid spinners">
		<div class="mdl-cell shadow mdl-cell--4-col" style="background: white; padding:15px; margin-left: 5%;">
			<h5 style="margin-bottom: 30px; padding-left: 15px; margin-top: 15px;">Spinners</h5>	
				<div style="text-align: center;">
				<div class="mdl-spinner mdl-js-spinner is-active" style="margin-right: 20px;"></div>
				<div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner is-active"></div>
				</div>
		</div>	
		<div class="mdl-cell shadow mdl-cell--7-col" style="background: white; padding:15px;">
			<h5 style="margin-bottom: 30px; padding-left: 15px; margin-top: 15px;">Badges</h5>		
				<div style="text-align: center;">
				<span style="margin-right: 10px;">			
				<span class="material-icons mdl-badge" data-badge="1">Messages</span>
				</span>
				<span style="margin-right: 10px;">			
				<span class="material-icons mdl-badge" data-badge="4"><button class="mdl-button mdl-js-button mdl-js-ripple-effect">
					Button
				</button></span>
				</span>
				<span style="margin-right: 10px;">			
				<span class="material-icons mdl-badge" data-badge="♥"><i class="mdi mdi-account" style="font-size: 25px; line-height: 1.2;"></i></span>
				</span>
				</div>
		</div>	
	</div>
	<div class="mdl-grid tooltips">
		<div class="mdl-cell shadow mdl-cell--12-col" style="background: white; padding:15px; width: 90%; margin: 25px auto;">
			<h5 style="margin-bottom: 30px; padding-left: 15px; margin-top: 15px;">Tooltips</h5>	
				<div style="text-align: center;">	
					<span style="margin-right: 25px;">	
						<span id="tt1"><i class="mdi mdi-plus"></i></span>
						<span class="mdl-tooltip" for="tt1">
						Follow
						</span>
					</span>
					<span style="margin-right: 25px;">	
						<span id="tt2"><i class="mdi mdi-printer"></i></span>
						<span class="mdl-tooltip mdl-tooltip--large" for="tt2">
						Print
						</span>
					</span>	
					<span style="margin-right: 25px;">	
						<span id="tt3"><i class="mdi mdi-cloud-upload"></i></span>
						<span class="mdl-tooltip" for="tt3">
						Upload <strong>file.zip</strong>
						</span>
					</span>	
					<span style="margin-right: 25px;">	
						<span id="tt4"><i class="mdi mdi-share-variant"></i></span>
						<span class="mdl-tooltip" for="tt4">
						Share your content<br>via social media
						</span>
					</span>	
				</div>
		</div>	
	</div>
	<div class="mdl-grid tooltips">
		<div class="mdl-cell shadow mdl-cell--12-col" style="background: white; padding:15px; width: 90%; margin: 25px auto;">
			<h5 style="margin-bottom: 30px; padding-left: 15px; margin-top: 15px;">Toasts</h5>	
				<div style="text-align: center;">	
					<button class="mdl-button mdl-js-button mdl-button--raised primary toast" style="margin-right: 10px; margin-bottom: 5px;">
					Toast
					</button>
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent toast-error" style="margin-right: 10px; margin-bottom: 5px;">
					Error
					</button>
					<button class="mdl-button mdl-js-button mdl-button--raised green toast-notice" style="margin-right: 10px; margin-bottom: 5px;">
					Notice
					</button>
					<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect toast-warning" style="margin-right: 10px;">
						<i class="mdi mdi-comment-alert-outline"></i>
					</button>
				</div>
		</div>	
	</div>
	<div class="mdl-grid footer">
		<div class="mdl-cell shadow mdl-cell--12-col" style="background: white; padding:15px; width: 90%; margin: 25px auto;">
			<h5 style="margin-bottom: 30px; padding-left: 15px; margin-top: 15px;">Footer</h5>
			<footer class="mdl-mega-footer">
				<div class="mdl-mega-footer__middle-section">

					<div class="mdl-mega-footer__drop-down-section">
						<input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked>
						<h1 class="mdl-mega-footer__heading">Features</h1>
						<ul class="mdl-mega-footer__link-list">
							<li><a href="#">About</a></li>
							<li><a href="#">Terms</a></li>
							<li><a href="#">Partners</a></li>
							<li><a href="#">Updates</a></li>
						</ul>
					</div>

					<div class="mdl-mega-footer__drop-down-section">
						<input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked>
						<h1 class="mdl-mega-footer__heading">Details</h1>
						<ul class="mdl-mega-footer__link-list">
							<li><a href="#">Specs</a></li>
							<li><a href="#">Tools</a></li>
							<li><a href="#">Resources</a></li>
						</ul>
					</div>

					<div class="mdl-mega-footer__drop-down-section">
						<input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked>
						<h1 class="mdl-mega-footer__heading">Technology</h1>
						<ul class="mdl-mega-footer__link-list">
							<li><a href="#">How it works</a></li>
							<li><a href="#">Patterns</a></li>
							<li><a href="#">Usage</a></li>
							<li><a href="#">Products</a></li>
							<li><a href="#">Contracts</a></li>
						</ul>
					</div>

					<div class="mdl-mega-footer__drop-down-section">
						<input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked>
						<h1 class="mdl-mega-footer__heading">FAQ</h1>
						<ul class="mdl-mega-footer__link-list">
							<li><a href="#">Questions</a></li>
							<li><a href="#">Answers</a></li>
							<li><a href="#">Contact us</a></li>
						</ul>
					</div>

				</div>

				<div class="mdl-mega-footer__bottom-section">
					<div class="mdl-logo">Title</div>
					<ul class="mdl-mega-footer__link-list">
						<li><a href="#">Help</a></li>
						<li><a href="#">Privacy & Terms</a></li>
					</ul>
				</div>

			</footer>	
		</div>
	</div>
	<div class="mdl-grid footer">
		<div class="mdl-cell shadow mdl-cell--12-col" style="background: white; padding:15px; width: 90%; margin: 25px auto;">
			<h5 style="margin-bottom: 30px; padding-left: 15px; margin-top: 15px;">Mini footer</h5>
			<footer class="mdl-mini-footer">
				<div class="mdl-mini-footer__left-section">
					<div class="mdl-logo">Title</div>
					<ul class="mdl-mini-footer__link-list">
						<li><a href="#">Help</a></li>
						<li><a href="#">Privacy & Terms</a></li>
					</ul>
				</div>
			</footer>
		</div>
	</div>
@stop

@section('js')

    @parent
		<script>

		document.querySelector('#p1').addEventListener('mdl-componentupgraded', function() {
		    this.MaterialProgress.setProgress(44);
		});
		document.querySelector('#p3').addEventListener('mdl-componentupgraded', function() {
			this.MaterialProgress.setProgress(33);
			this.MaterialProgress.setBuffer(87);
		});

		 $(function() {
		 	$( ".toast" ).click(function() {
		 		$.growl({ title: "Toast", message: "This is a regular toast." });
		 	});
		 	$( ".toast-error" ).click(function() {
		 		$.growl.error({ title: "Error", message: "This is an error toast." });
		 	});
		 	$( ".toast-notice" ).click(function() {
		 		$.growl.notice({ title: "Notice", message: "This is an notice toast." });
		 	});
		 	$( ".toast-warning" ).click(function() {
		 		$.growl.warning({ title: "Warning", message: "This is an warning toast." });
		 	});
		 })

		</script>
@endsection
