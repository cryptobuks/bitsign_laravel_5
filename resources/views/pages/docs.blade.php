@extends('partials.dashboard')

@section('page_title')
	Form
@stop

@section('dashboard-content')
	
<div id="installation" class="shadow panel">
       			<h4>Installation</h4>
       			To use the Material Dashboard Theme, you need to make sure you have <code>bower</code>, <code>npm</code> and <code>gulp</code> globally installed. Now navigate to your app directory ($ cd app/) and run the following terminal commands :
       			<ul>
       				<li> <code>composer install</code> </li>
       				<li> <code>php artisan key:generate</code> and paste the generated key in <code>config/app.php</code> replacing <code>'key' => env('APP_KEY', 'SomeRandomString')</code>"SomeRandomString"</li>
       				<li> <code>npm install</code> </li>
       				<li> <code>bower install</code> </li>
       				<li> <code>gulp watch</code> </li>
       			</ul>
			</div>
			<div id="features" class="shadow panel">
       			<h4>Features</h4>
       			Material Admin is a lightweight and feature rich admin template which is clean and easy to use. Current release comes with the following features:
       			<ul>
       				<li> Responsive desing based on Material Design Lite</li>
       				<li> Custom elemenrs and plugins including
						<ul>
							<li>User profile</li>
							<li>Inbox</li>
							<li>Lightbox Gallery</li>
							<li>Customizable in different colors and styles</li>
							<li>Login, Register and 404 page</li>
						</ul>
       				</li>
       				<li> Material Design Lite and third party plugins and elemnts including
						<ul>
							<li>Tables</li>
							<li>Buttons</li>
							<li>Forms with validation</li>
							<li>Progressbars and Spinners</li>
							<li>Cards</li>
							<li>Tabs</li>
							<li>Sliders</li>
							<li>Badges</li>
							<li>Paper Collapse</li>
						</ul>
       				</li>       				
       			</ul>
			</div>
			<div id="widgets" class="panel shadow">
				<h4>Widgets</h4>
					The following widgets/plugins have been used in Material Dashboard theme:
				<h5>Buttons</h5>
				<button class="mdl-button mdl-js-button mdl-button--colored" style="margin-right: 10px; margin-bottom: 5px;">
					Button
				</button>
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" style="margin-right: 10px; margin-bottom: 5px;">
				 	Accent
				</button>
				<button class="mdl-button mdl-js-button primary mdl-js-ripple-effect mdl-button--raised" style="margin-right: 10px; margin-bottom: 5px;">
				 	Primary
				</button>
				<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" style="margin-right: 10px;">
					<i class="mdi mdi-bike"></i>
				</button>
				<div class="code-block">
					<code><pre>&lt;button class="mdl-button mdl-js-button mdl-button--colored"&gt;
	Button
&lt;/button&gt;
&lt;button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent"&gt;
	Accent
&lt;/button&gt;
&lt;button class="mdl-button mdl-js-button primary mdl-js-ripple-effect mdl-button--raised"&gt;
	Primary
&lt;/button&gt;
&lt;button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect"&gt;
	&lt;i class="mdi mdi-bike"&gt;&lt;/i&gt;
&lt;/button&gt;</pre></code>
				</div>
				<h5>Cards</h5>
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
				<div class="code-block">
					<code>
						<pre>
&lt;div class="mdl-card mdl-shadow--2dp demo-card-wide mdl-cell mdl-cell--6-col material"&gt;
	&lt;div class="mdl-card__title"&gt;
		&lt;h2 class="mdl-card__title-text"&gt;Welcome&lt;/h2&gt;
	&lt;/div&gt;
	&lt;div class="mdl-card__supporting-text"&gt;
		Lorem ipsum dolor sit amet, consectetur adipiscing elit.
		Mauris sagittis pellentesque lacus eleifend lacinia...
	&lt;/div&gt;
	&lt;div class="mdl-card__actions mdl-card--border"&gt;
		&lt;a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect"&gt;
			Get Started
		&lt;/a&gt;
	&lt;/div&gt;
	&lt;div class="mdl-card__menu"&gt;
		&lt;button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"&gt;
		&lt;i class="mdi mdi-share-variant"&gt;&lt;/i&gt;
		&lt;/button&gt;
	&lt;/div&gt;
&lt;/div&gt;
						</pre>
					</code>
				</div>
				<h5>Tabs</h5>
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
				<div class="code-block">
					<code>
						<pre>
&lt;div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect"&gt;
	&lt;div class="mdl-tabs__tab-bar"&gt;
		&lt;a href="#starks-panel" class="mdl-tabs__tab is-active"&gt;Starks&lt;/a&gt;
		&lt;a href="#lannisters-panel" class="mdl-tabs__tab"&gt;Lannisters&lt;/a&gt;
		&lt;a href="#targaryens-panel" class="mdl-tabs__tab"&gt;Targaryens&lt;/a&gt;
	&lt;/div&gt;

	&lt;div class="mdl-tabs__panel is-active" id="starks-panel"&gt;
		&lt;ul&gt;
			&lt;li&gt;Eddard&lt;/li&gt;
			&lt;li&gt;Catelyn&lt;/li&gt;
			&lt;li&gt;Robb&lt;/li&gt;
			&lt;li&gt;Sansa&lt;/li&gt;
			&lt;li&gt;Brandon&lt;/li&gt;
			&lt;li&gt;Arya&lt;/li&gt;
			&lt;li&gt;Rickon&lt;/li&gt;
		&lt;/ul&gt;
	&lt;/div&gt;
	&lt;div class="mdl-tabs__panel" id="lannisters-panel"&gt;
		&lt;ul&gt;
			&lt;li&gt;Tywin&lt;/li&gt;
			&lt;li&gt;Cersei&lt;/li&gt;
			&lt;li&gt;Jamie&lt;/li&gt;
			&lt;li&gt;Tyrion&lt;/li&gt;
		&lt;/ul&gt;
	&lt;/div&gt;
	&lt;div class="mdl-tabs__panel" id="targaryens-panel"&gt;
		&lt;ul&gt;
			&lt;li&gt;Viserys&lt;/li&gt;
			&lt;li&gt;Daenerys&lt;/li&gt;
		&lt;/ul&gt;
	&lt;/div&gt;
&lt;/div&gt;
						</pre>
					</code>
				</div>
				<h5>Loading Bar</h5>
				<div class="bar" style="margin: 15px;">	
					<div id="p1" class="mdl-progress mdl-js-progress progress-demo"></div>
				</div>
				<div class="bar" style="margin: 15px;">
					<div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate progress-demo"></div>
				</div>
				<div class="bar" style="margin: 15px;">
					<div id="p3" class="mdl-progress mdl-js-progress progress-demo"></div>
				</div>
				<div class="code-block">
					<code>
						<pre>
&lt;div id="p1" class="mdl-progress mdl-js-progress progress-demo"&gt;&lt;/div&gt;
&lt;div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate progress-demo"&gt;&lt;/div&gt;
&lt;div id="p3" class="mdl-progress mdl-js-progress progress-demo"&gt;&lt;/div&gt;
						</pre>
					</code>
				</div>
				<h5>Sliders</h5>
				<input class="mdl-slider mdl-js-slider" type="range" min="0" max="100" value="0" tabindex="0"/>			
				<input class="mdl-slider mdl-js-slider" type="range" min="0" max="100" value="25" tabindex="0"/>	
				<div class="code-block">
					<code>
						<pre>
&lt;input class="mdl-slider mdl-js-slider" type="range" min="0" max="100" value="0" tabindex="0"/&gt;			
&lt;input class="mdl-slider mdl-js-slider" type="range" min="0" max="100" value="25" tabindex="0"/&gt;
						</pre>
					</code>
				</div>
				<h5>Spinners</h5>
				<div class="mdl-spinner mdl-js-spinner is-active" style="margin-right: 20px;"></div>
				<div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner is-active"></div>
				<div class="code-block">
					<code>
						<pre>
&lt;div class="mdl-spinner mdl-js-spinner is-active"&gt;&lt;/div&gt;
&lt;div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner is-active"&gt;&lt;/div&gt;
						</pre>
					</code>
				</div>
				<h5>Badges</h5>
				<span style="margin-right: 10px;">			
				<span class="material-icons mdl-badge" data-badge="1">Messages</span>
				</span>
				<span style="margin-right: 10px;">			
				<span class="material-icons mdl-badge" data-badge="4"><button class="mdl-button mdl-js-button mdl-js-ripple-effect">Button</button></span>
				</span>
				<span style="margin-right: 10px;">			
				<span class="material-icons mdl-badge" data-badge="♥"><i class="mdi mdi-account" style="font-size: 25px; line-height: 1.2;"></i></span>
				</span>
				<div class="code-block">
					<code>
						<pre>
&lt;span class="material-icons mdl-badge" data-badge="1"&gt;Messages&lt;/span&gt;
&lt;span class="material-icons mdl-badge" data-badge="4"&gt;
	&lt;button class="mdl-button mdl-js-button mdl-js-ripple-effect"&gt;Button&lt;/button&gt;
&lt;/span&gt;
&lt;span class="material-icons mdl-badge" data-badge="♥"&gt;&lt;i class="mdi mdi-account"&gt;&lt;/i&gt;&lt;/span&gt;
						</pre>
					</code>
				</div>
				<h5>Tooltips</h5>
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
				<div class="code-block">
					<code>
						<pre>
&lt;span id="tt1"&gt;&lt;i class="mdi mdi-plus"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;span class="mdl-tooltip" for="tt1"&gt;
	Follow
&lt;/span&gt;
&lt;span id="tt2"&gt;&lt;i class="mdi mdi-printer"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;span class="mdl-tooltip mdl-tooltip--large" for="tt2"&gt;
	Print
&lt;/span&gt;
&lt;span id="tt3"&gt;&lt;i class="mdi mdi-cloud-upload"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;span class="mdl-tooltip" for="tt3"&gt;
	Upload &lt;strong&gt;file.zip&lt;/strong&gt;
&lt;/span&gt;
&lt;span id="tt4"&gt;&lt;i class="mdi mdi-share-variant"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;span class="mdl-tooltip" for="tt4"&gt;
	Share your content&lt;br&gt;via social media
&lt;/span&gt;
						</pre>
					</code>
				</div>
				<h5>Footer</h5>
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
				<div class="code-block">
					<code>
						<pre>
&lt;footer class="mdl-mega-footer"&gt;
	&lt;div class="mdl-mega-footer__middle-section"&gt;

		&lt;div class="mdl-mega-footer__drop-down-section"&gt;
			&lt;input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked&gt;
			&lt;h1 class="mdl-mega-footer__heading"&gt;Features&lt;/h1&gt;
			&lt;ul class="mdl-mega-footer__link-list"&gt;
				&lt;li&gt;&lt;a href="#"&gt;About&lt;/a&gt;&lt;/li&gt;
				&lt;li&gt;&lt;a href="#"&gt;Terms&lt;/a&gt;&lt;/li&gt;
				&lt;li&gt;&lt;a href="#"&gt;Partners&lt;/a&gt;&lt;/li&gt;
				&lt;li&gt;&lt;a href="#"&gt;Updates&lt;/a&gt;&lt;/li&gt;
			&lt;/ul&gt;
		&lt;/div&gt;

		&lt;div class="mdl-mega-footer__drop-down-section"&gt;
			&lt;input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked&gt;
			&lt;h1 class="mdl-mega-footer__heading"&gt;Details&lt;/h1&gt;
			&lt;ul class="mdl-mega-footer__link-list"&gt;
				&lt;li&gt;&lt;a href="#"&gt;Specs&lt;/a&gt;&lt;/li&gt;
				&lt;li&gt;&lt;a href="#"&gt;Tools&lt;/a&gt;&lt;/li&gt;
				&lt;li&gt;&lt;a href="#"&gt;Resources&lt;/a&gt;&lt;/li&gt;
			&lt;/ul&gt;
		&lt;/div&gt;

		&lt;div class="mdl-mega-footer__drop-down-section"&gt;
			&lt;input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked&gt;
			&lt;h1 class="mdl-mega-footer__heading"&gt;Technology&lt;/h1&gt;
			&lt;ul class="mdl-mega-footer__link-list"&gt;
				&lt;li&gt;&lt;a href="#"&gt;How it works&lt;/a&gt;&lt;/li&gt;
				&lt;li&gt;&lt;a href="#"&gt;Patterns&lt;/a&gt;&lt;/li&gt;
				&lt;li&gt;&lt;a href="#"&gt;Usage&lt;/a&gt;&lt;/li&gt;
				&lt;li&gt;&lt;a href="#"&gt;Products&lt;/a&gt;&lt;/li&gt;
				&lt;li&gt;&lt;a href="#"&gt;Contracts&lt;/a&gt;&lt;/li&gt;
			&lt;/ul&gt;
		&lt;/div&gt;

		&lt;div class="mdl-mega-footer__drop-down-section"&gt;
			&lt;input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked&gt;
			&lt;h1 class="mdl-mega-footer__heading"&gt;FAQ&lt;/h1&gt;
			&lt;ul class="mdl-mega-footer__link-list"&gt;
				&lt;li&gt;&lt;a href="#"&gt;Questions&lt;/a&gt;&lt;/li&gt;
				&lt;li&gt;&lt;a href="#"&gt;Answers&lt;/a&gt;&lt;/li&gt;
				&lt;li&gt;&lt;a href="#"&gt;Contact us&lt;/a&gt;&lt;/li&gt;
			&lt;/ul&gt;
		&lt;/div&gt;

	&lt;/div&gt;

	&lt;div class="mdl-mega-footer__bottom-section"&gt;
		&lt;div class="mdl-logo"&gt;Title&lt;/div&gt;
		&lt;ul class="mdl-mega-footer__link-list"&gt;
			&lt;li&gt;&lt;a href="#"&gt;Help&lt;/a&gt;&lt;/li&gt;
			&lt;li&gt;&lt;a href="#"&gt;Privacy & Terms&lt;/a&gt;&lt;/li&gt;
		&lt;/ul&gt;
	&lt;/div&gt;
&lt;/footer&gt;	
						</pre>
					</code>
				</div>
				<h5>Mini Footer</h5>
				<footer class="mdl-mini-footer">
					<div class="mdl-mini-footer__left-section">
						<div class="mdl-logo">Title</div>
						<ul class="mdl-mini-footer__link-list">
							<li><a href="#">Help</a></li>
							<li><a href="#">Privacy & Terms</a></li>
						</ul>
					</div>
				</footer>
				<div class="code-block">
					<code>
						<pre>
&lt;footer class="mdl-mini-footer"&gt;
	&lt;div class="mdl-mini-footer__left-section"&gt;
		&lt;div class="mdl-logo"&gt;Title&lt;/div&gt;
		&lt;ul class="mdl-mini-footer__link-list"&gt;
			&lt;li&gt;&lt;a href="#"&gt;Help&lt;/a&gt;&lt;/li&gt;
			&lt;li&gt;&lt;a href="#"&gt;Privacy & Terms&lt;/a&gt;&lt;/li&gt;
		&lt;/ul&gt;
	&lt;/div&gt;
&lt;/footer&gt;
						</pre>
					</code>
				</div>
				<h5>Table</h5>
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
				<div class="code-block">
					<code>
						<pre>
&lt;table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp shadow"&gt;
	&lt;thead&gt;
		&lt;tr&gt;
			&lt;th class="mdl-data-table__cell--non-numeric"&gt;Material&lt;/th&gt;
			&lt;th&gt;Quantity&lt;/th&gt;
			&lt;th&gt;Unit price&lt;/th&gt;
		&lt;/tr&gt;
	&lt;/thead&gt;
	&lt;tbody&gt;
		&lt;tr&gt;
			&lt;td class="mdl-data-table__cell--non-numeric"&gt;Acrylic (Transparent)&lt;/td&gt;
			&lt;td&gt;25&lt;/td&gt;
			&lt;td&gt;$2.90&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td class="mdl-data-table__cell--non-numeric"&gt;Plywood (Birch)&lt;/td&gt;
			&lt;td&gt;50&lt;/td&gt;
			&lt;td&gt;$1.25&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td class="mdl-data-table__cell--non-numeric"&gt;Laminate (Gold on Blue)&lt;/td&gt;
			&lt;td&gt;10&lt;/td&gt;
			&lt;td&gt;$2.35&lt;/td&gt;
		&lt;/tr&gt;
	&lt;/tbody&gt;
&lt;/table&gt;
						</pre>
					</code>
				</div>
				<h5>Text Fields</h5>
				<div class="mdl-textfield mdl-js-textfield textfield-demo" style="margin-right:20px;">
					<input class="mdl-textfield__input" type="text" id="sample1" />
					<label class="mdl-textfield__label" for="sample1">Text...</label>
				</div>
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
					<input class="mdl-textfield__input" type="text" id="sample3" />
					<label class="mdl-textfield__label" for="sample3">Floating Text...</label>
				</div>
				<div class="code-block">
					<code>
						<pre>
&lt;div class="mdl-textfield mdl-js-textfield textfield-demo"&gt;
	&lt;input class="mdl-textfield__input" type="text" id="sample1" /&gt;
	&lt;label class="mdl-textfield__label" for="sample1"&gt;Text...&lt;/label&gt;
&lt;/div&gt;
&lt;div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo"&gt;
	&lt;input class="mdl-textfield__input" type="text" id="sample3" /&gt;
	&lt;label class="mdl-textfield__label" for="sample3"&gt;Floating Text...&lt;/label&gt;
&lt;/div&gt;
						</pre>
					</code>
				</div>
				<h5>Switches and Checkboxes</h5>
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2">
					<input type="checkbox" id="checkbox-2" class="mdl-checkbox__input" />
					<span class="mdl-checkbox__label">Checkbox</span>
				</label>
				<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
					<input type="radio" id="option-2" class="mdl-radio__button" name="options" value="2" />
					<span class="mdl-radio__label">Option</span>
				</label><br>
				<label class="mdl-icon-toggle mdl-js-icon-toggle mdl-js-ripple-effect" for="icon-toggle-1">
					<input type="checkbox" id="icon-toggle-1" class="mdl-icon-toggle__input" checked />
					<i class="mdl-icon-toggle__label mdi mdi-format-bold" style="font-size: 26px;"></i>
				</label>
				<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-2">
					<input type="checkbox" id="switch-2" class="mdl-switch__input" />
					<span class="mdl-switch__label"></span>
				</label>
				<div class="code-block">
					<code>
						<pre>
&lt;label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2"&gt;
	&lt;input type="checkbox" id="checkbox-2" class="mdl-checkbox__input" /&gt;
	&lt;span class="mdl-checkbox__label"&gt;Checkbox&lt;/span&gt;
&lt;/label&gt;
&lt;label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2"&gt;
	&lt;input type="radio" id="option-2" class="mdl-radio__button" name="options" value="2" /&gt;
	&lt;span class="mdl-radio__label"&gt;Option&lt;/span&gt;
&lt;/label&gt;&lt;br&gt;
&lt;label class="mdl-icon-toggle mdl-js-icon-toggle mdl-js-ripple-effect" for="icon-toggle-1"&gt;
	&lt;input type="checkbox" id="icon-toggle-1" class="mdl-icon-toggle__input" checked /&gt;
	&lt;i class="mdl-icon-toggle__label mdi mdi-format-bold" style="font-size: 26px;"&gt;&lt;/i&gt;
&lt;/label&gt;
&lt;label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-2"&gt;
	&lt;input type="checkbox" id="switch-2" class="mdl-switch__input" /&gt;
	&lt;span class="mdl-switch__label"&gt;&lt;/span&gt;
&lt;/label&gt;
						</pre>
					</code>
				</div>
			</div>
			<div id="extras" class="shadow panel">
       			<h4>Extras</h4>
       			3rd party plugins and elements
       			<h5>ChartJS</h5>
       			<div style="width: 600px;">
       				<canvas id="line-chart"></canvas>
       			</div>
       			<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect" style="margin-top:10px;">
					<div class="mdl-tabs__tab-bar">
						<a href="#html" class="mdl-tabs__tab is-active">HTML</a>
						<a href="#javascript" class="mdl-tabs__tab">Javascript</a>
					</div>
				    <div class="mdl-tabs__panel is-active" id="html">
				    	<div class="code-block">
				    		<code>
       							<pre>
&lt;canvas id="line-chart"&gt;&lt;/canvas&gt;
		       					</pre>
		       				</code>
				    	</div>
				    </div>
				    <div class="mdl-tabs__panel" id="javascript">
				    	<div class="code-block">
				    		<code>
       							<pre>
var data = {
labels: ["January", "February", "March", "April", "May", "June", "July"],
datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(41,121,255,0.2)",
            strokeColor: "rgba(41,121,255,1)",
            pointColor: "rgba(41,121,255,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(41,121,255,1)",
            data: [65, 59, 80, 81, 56, 55, 40]
        },
        {
            label: "My Second dataset",
            fillColor: "rgba(0,213,84,0.2)",
            strokeColor: "rgba(0,213,84,1)",
            pointColor: "rgba(0,213,84,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 86, 27, 90]
        }
    ]
};

var LineChart = document.getElementById("line-chart").getContext("2d");

var chartCurves = new Chart(LineChart).Line(data, {
	responsive: true,
    datasetStroke: false,
    legendTemplate: false,
    pointDotRadius : 6,
    showTooltips: false	       
});
		       					</pre>
		       				</code>
				    	</div>
				    </div>
				</div>
       			<h5>C3 JS</h5>
       			<div style="width: 600px;">
       				<div id="bar-chart"></div>
       			</div>
       			<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect" style="margin-top:10px;">
					<div class="mdl-tabs__tab-bar">
						<a href="#html2" class="mdl-tabs__tab is-active">HTML</a>
						<a href="#javascript2" class="mdl-tabs__tab">Javascript</a>
					</div>
				    <div class="mdl-tabs__panel is-active" id="html2">
				    	<div class="code-block">
				    		<code>
       							<pre>
&lt;div id="bar-chart"&gt;&lt;/div&gt;
		       					</pre>
		       				</code>
				    	</div>
				    </div>
				    <div class="mdl-tabs__panel" id="javascript2">
				    	<div class="code-block">
				    		<code>
       							<pre>
var chart2 = c3.generate({
	bindto: '#bar-chart',
    data: {
        columns: [
            ['Players', 30, 200, 100, 400, 150, 250, 200, 120, 80, 180, 40, 90, 220, 110, 20],
            ['Times', 30, 150, 80, 250, 150, 270, 240, 180, 280, 140, 120, 70, 140, 190, 220]
        ],
        type: 'bar'
    },
    bar: {
        width: {
            width: 80 // this makes bar width 50% of length between ticks
        }
        // or
        //width: 100 // this makes bar width 100px
    },
    color: {
	  pattern: ['#00D554','#ff4081']
	},
	padding: {
		left: 10,
		right: 10,
		top: 10
	},
	legend: {
		hide: true
	}
});
		       					</pre>
		       				</code>
				    	</div>
				    </div>
				</div>
       			<h5>Stats</h5>
       			<div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone mdl-cell--12-col-tablet shadow" style="background: white">
					<div class="stat">
						<div class="chart-container">
							<div id="chart1" data-percent="45"></div>
							<div class="value"> 45%</div>
						</div>
						<div class="stat-values">
							Goals Achieved 
							<div class="bottom-stat">
								<span class="arrow-up"></span>&nbsp;
								<span class="lighter"> 18% Up this month</span>
							</div>
						</div>
					</div>	
				</div>
				<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect" style="margin-top:10px;">
					<div class="mdl-tabs__tab-bar">
						<a href="#html3" class="mdl-tabs__tab is-active">HTML</a>
						<a href="#javascript3" class="mdl-tabs__tab">Javascript</a>
					</div>
				    <div class="mdl-tabs__panel is-active" id="html3">
				    	<div class="code-block">
				    		<code>
       							<pre>
<?php 


	$content = <<<EOD
@include('widgets.stat', array(
'chartID'=>'chart1', 'value'=>'45', 'header'=>'Goals Achieved', 'arrow'=>'arrow-up', 'footer'=>'18% Up this month'))
EOD;


?>
{{$content}}
		       					</pre>
		       				</code>
				    	</div>
				    </div>
				    <div class="mdl-tabs__panel" id="javascript3">
				    	<div class="code-block">
				    		<code>
       							<pre>
$('#chart1').easyPieChart({
    lineWidth: 8,
    scaleColor: false,
    size: 85,
    lineCap: "square",
    barColor: "#fb8c00",
    trackColor: "#f9dcb8"
});
		       					</pre>
		       				</code>
				    	</div>
				    </div>
				</div>
				<h5>To-Do</h5>
				<div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone mdl-cell--12-col-tablet shadow grid-margin" style="background: white; position: relative; min-height: 400px;">
					<div class="panel-header">to do list <span class="cog">
						<button id="todo" class="mdl-button mdl-js-button mdl-button--icon">
					        <i class="mdi mdi-settings"></i>
					    </button>
					    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="todo">
					        <li class="mdl-menu__item">Some Action</li>
					        <li class="mdl-menu__item">Another Action</li>
					        <li class="mdl-menu__item">Disabled Action</li>
					        <li class="mdl-menu__item">Yet Another Action</li>
					    </ul></span>
				    </div>
				    <div class="to-do">
				    	<ul>
				    		<li>
				    			<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox1">
					    			<input type="checkbox" id="checkbox1" class="mdl-checkbox__input" />
					    			<span class="mdl-checkbox__label">Ibe can be the new Sterling.</span>
					    		</label>
					    	</li>
					    	<li>
						    	<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox2">
						    		<input type="checkbox" id="checkbox2" class="mdl-checkbox__input" />
						    		<span class="mdl-checkbox__label">Make or break season for Rodgers.</span>
						    	</label>
						    </li>
						    <li>
							    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox3">
							    	<input type="checkbox" id="checkbox3" class="mdl-checkbox__input" />
							    	<span class="mdl-checkbox__label">Benteke will show why he's good.</span>
							    </label>
							</li>
							<li>
								<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox4">
									<input type="checkbox" id="checkbox4" class="mdl-checkbox__input" />
									<span class="mdl-checkbox__label">Sturridge will definitely be back.</span>
								</label>
							</li>
							<li>
								<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox5">
									<input type="checkbox" id="checkbox5" class="mdl-checkbox__input" />
									<span class="mdl-checkbox__label">PFA player of the year Coutinho.</span>
								</label>
							</li>
							<li>
								<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox6">
									<input type="checkbox" id="checkbox6" class="mdl-checkbox__input" />
									<span class="mdl-checkbox__label">We go again.</span>
								</label>
							</li>
				    	</ul>
				    	<div class="bottom">
					    	<form action="#">
					    		<div class="mdl-textfield mdl-js-textfield textfield-demo">
					    			<input class="mdl-textfield__input" type="text" id="sample1" />
					    			<label class="mdl-textfield__label" for="sample1">To do...</label>
					    		</div>
					    	</form>
					    	<button class="mdl-button mdl-button--raised mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored btn">
					    	<i class="mdi mdi-check"></i>
					    	</button>
				    	</div>
				    </div>
				</div>
				<div class="code-block">
					<code>
						<pre>
&lt;div class="to-do"&gt;
	&lt;ul&gt;
		&lt;li&gt;
			&lt;label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox1"&gt;
    			&lt;input type="checkbox" id="checkbox1" class="mdl-checkbox__input" /&gt;
    			&lt;span class="mdl-checkbox__label"&gt;Ibe can be the new Sterling.&lt;/span&gt;
    		&lt;/label&gt;
    	&lt;/li&gt;
    	&lt;li&gt;
	    	&lt;label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox2"&gt;
	    		&lt;input type="checkbox" id="checkbox2" class="mdl-checkbox__input" /&gt;
	    		&lt;span class="mdl-checkbox__label"&gt;Make or break season for Rodgers.&lt;/span&gt;
	    	&lt;/label&gt;
	    &lt;/li&gt;
	    &lt;li&gt;
		    &lt;label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox3"&gt;
		    	&lt;input type="checkbox" id="checkbox3" class="mdl-checkbox__input" /&gt;
		    	&lt;span class="mdl-checkbox__label"&gt;Benteke will show why he's good.&lt;/span&gt;
		    &lt;/label&gt;
		&lt;/li&gt;
		&lt;li&gt;
			&lt;label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox4"&gt;
				&lt;input type="checkbox" id="checkbox4" class="mdl-checkbox__input" /&gt;
				&lt;span class="mdl-checkbox__label"&gt;Sturridge will definitely be back.&lt;/span&gt;
			&lt;/label&gt;
		&lt;/li&gt;
		&lt;li&gt;
			&lt;label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox5"&gt;
				&lt;input type="checkbox" id="checkbox5" class="mdl-checkbox__input" /&gt;
				&lt;span class="mdl-checkbox__label"&gt;PFA player of the year Coutinho.&lt;/span&gt;
			&lt;/label&gt;
		&lt;/li&gt;
		&lt;li&gt;
			&lt;label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox6"&gt;
				&lt;input type="checkbox" id="checkbox6" class="mdl-checkbox__input" /&gt;
				&lt;span class="mdl-checkbox__label"&gt;We go again.&lt;/span&gt;
			&lt;/label&gt;
		&lt;/li&gt;
	&lt;/ul&gt;
	&lt;div class="bottom"&gt;
    	&lt;form action="#"&gt;
    		&lt;div class="mdl-textfield mdl-js-textfield textfield-demo"&gt;
    			&lt;input class="mdl-textfield__input" type="text" id="sample1" /&gt;
    			&lt;label class="mdl-textfield__label" for="sample1"&gt;To do...&lt;/label&gt;
    		&lt;/div&gt;
    	&lt;/form&gt;
&lt;button class="mdl-button mdl-button--raised mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored btn"&gt;
&lt;i class="mdi mdi-check"&gt;&lt;/i&gt;
&lt;/button&gt;
	&lt;/div&gt;
&lt;/div&gt;
						</pre>
					</code>
				</div>
				<h5>Paper Collapse</h5>
				<div class="collapse-card shadow" style="margin-bottom: 5px;">
					<div class="collapse-card__heading">
						<div class="collapse-card__title">
							<span class="sender left">Gary Neville </span> <span class="subjecth">Request for loan.</span><span class="time right">48 minutes ago</span>
						</div>
					</div>
					<div class="collapse-card__body">
						<div class="subject">
							Request for loan.
						</div>
						<div class="body">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, saepe ex ipsam, nemo maiores eius incidunt. Sint unde laborum, eligendi praesentium voluptates incidunt ex animi dolor nobis possimus odio autem.</p>
						</div>
						<div class="footer">
							Sincerely, <br>
							Gary Neville
						</div>
					</div>
				</div>
				<div class="code-block">
					<code>
						<pre>
&lt;div class="collapse-card shadow"&gt;
&lt;div class="collapse-card__heading"&gt;
&lt;div class="collapse-card__title"&gt;
&lt;span class="sender left"&gt;Gary Neville &lt;/span&gt; &lt;span class="subjecth"&gt;Request for loan.&lt;/span&gt;
&lt;span class="time right"&gt;48 minutes ago&lt;/span&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;div class="collapse-card__body"&gt;
&lt;div class="subject"&gt;
Request for loan.
&lt;/div&gt;
&lt;div class="body"&gt;
&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, saepe ex ipsam, nemo maiores eius incidunt.
 Sint unde laborum, eligendi praesentium voluptates incidunt ex animi dolor nobis possimus odio autem.&lt;/p&gt;
&lt;/div&gt;
&lt;div class="footer"&gt;
Sincerely, &lt;br&gt;
Gary Neville
&lt;a href="#modal" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored right absolute 
trigger"&gt;
&lt;i class="mdi mdi-pencil"&gt;&lt;/i&gt;
&lt;/a&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;
						</pre>
					</code>
				</div>
			</div>

@stop

@section('js')

    @parent

    <script>
    	var data = {
			    labels: ["January", "February", "March", "April", "May", "June", "July"],
			    datasets: [
			        {
			            label: "My First dataset",
			            fillColor: "rgba(41,121,255,0.2)",
			            strokeColor: "rgba(41,121,255,1)",
			            pointColor: "rgba(41,121,255,1)",
			            pointStrokeColor: "#fff",
			            pointHighlightFill: "#fff",
			            pointHighlightStroke: "rgba(41,121,255,1)",
			            data: [65, 59, 80, 81, 56, 55, 40]
			        },
			        {
			            label: "My Second dataset",
			            fillColor: "rgba(0,213,84,0.2)",
			            strokeColor: "rgba(0,213,84,1)",
			            pointColor: "rgba(0,213,84,1)",
			            pointStrokeColor: "#fff",
			            pointHighlightFill: "#fff",
			            pointHighlightStroke: "rgba(151,187,205,1)",
			            data: [28, 48, 40, 19, 86, 27, 90]
			        }
			    ]
			};

			var LineChart = document.getElementById("line-chart").getContext("2d");

	        var chartCurves = new Chart(LineChart).Line(data, {
	        	responsive: true,
	            datasetStroke: false,
	            legendTemplate: false,
	            pointDotRadius : 6,
	            showTooltips: false	       
	        });

	        var chart2 = c3.generate({
	        	bindto: '#bar-chart',
			    data: {
			        columns: [
			            ['Players', 30, 200, 100, 400, 150, 250, 200, 120, 80, 180, 40, 90, 220, 110, 20],
			            ['Times', 30, 150, 80, 250, 150, 270, 240, 180, 280, 140, 120, 70, 140, 190, 220]
			        ],
			        type: 'bar'
			    },
			    bar: {
			        width: {
			            width: 80 // this makes bar width 50% of length between ticks
			        }
			        // or
			        //width: 100 // this makes bar width 100px
			    },
			    color: {
				  pattern: ['#00D554','#ff4081']
				},
				padding: {
					left: 10,
					right: 10,
					top: 10
				},
				legend: {
					hide: true
				}
			}); 
			$('#chart1').easyPieChart({
		        lineWidth: 8,
		        scaleColor: false,
		        size: 85,
		        lineCap: "square",
		        barColor: "#fb8c00",
		        trackColor: "#f9dcb8"
		    });
		    $('.collapse-card').paperCollapse();
			$('.collapse-card__heading').click(function() {				
				$(this).find('.subjecth').toggle();
			})
    </script>
@endsection