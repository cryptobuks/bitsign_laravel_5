@extends('partials.dashboard')

@section('page_title')
	Form
@stop

@section('dashboard-content')
	
	<div class="mdl-grid" style="margin-top:15px;">
		<div class="mdl-cell shadow mdl-cell--6-col mdl-cell--12-col-phone mdl-cell--12-col-tablet" style="background: white;">
			<div class="panel-header">
				Normal Form
			</div>
			<div class="panel-body forms">
				<form action="#">
					<div class="mdl-textfield mdl-js-textfield textfield-demo">
						<input class="mdl-textfield__input" type="text" id="sample1" />
						<label class="mdl-textfield__label" for="sample1">Text...</label>
					</div>
				</form>
				<form action="#">
					<div class="mdl-textfield mdl-js-textfield textfield-demo">
						<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="sample2" />
						<label class="mdl-textfield__label" for="sample2">Number...</label>
						<span class="mdl-textfield__error">Input is not a number!</span>
					</div>
				</form>
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
				 	Submit
				</button>
			</div>
		</div>
		<div class="mdl-cell shadow mdl-cell--6-col mdl-cell--12-col-phone mdl-cell--12-col-tablet" style="background: white;">
			<div class="panel-header">
				Floating Form
			</div>
			<div class="panel-body forms">
				<form action="#">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
						<input class="mdl-textfield__input" type="text" id="sample3" />
						<label class="mdl-textfield__label" for="sample3">Text...</label>
					</div>
				</form>				
				<form action="#">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
						<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="sample4" />
						<label class="mdl-textfield__label" for="sample4">Number...</label>
						<span class="mdl-textfield__error">Input is not a number!</span>
					</div>
				</form>
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
				 	Submit
				</button>
			</div>
		</div>
	</div>
	<div class="mdl-grid" style="margin-top:10px;">
		<div class="mdl-cell shadow mdl-cell--6-col mdl-cell--12-col-phone mdl-cell--12-col-tablet" style="background: white;">
			<div class="panel-header">
				Toggles & switches
			</div>
			<div class="panel-body forms">
			<h5 style="margin-bottom: 0; margin-top: 4px;">Checkbox</h5>
			<hr>
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
					<input type="checkbox" id="checkbox-1" class="mdl-checkbox__input" checked />
					<span class="mdl-checkbox__label">Checkbox</span>
				</label>
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2">
					<input type="checkbox" id="checkbox-2" class="mdl-checkbox__input" />
					<span class="mdl-checkbox__label">Checkbox</span>
				</label>
			<h5 style="margin-top:30px;">Radio Button</h5>
			<hr>
				<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
					<input type="radio" id="option-1" class="mdl-radio__button" name="options" value="1" checked />
					<span class="mdl-radio__label">Option 1</span>
				</label>
				<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
					<input type="radio" id="option-2" class="mdl-radio__button" name="options" value="2" />
					<span class="mdl-radio__label">Option 2</span>
				</label>
			<h5 style="margin-top:30px;">Icon Toggle</h5>
			<hr>
				<label class="mdl-icon-toggle mdl-js-icon-toggle mdl-js-ripple-effect" for="icon-toggle-1">
					<input type="checkbox" id="icon-toggle-1" class="mdl-icon-toggle__input" checked />
					<i class="mdl-icon-toggle__label mdi mdi-format-bold" style="font-size: 26px;"></i>
				</label>
				<label class="mdl-icon-toggle mdl-js-icon-toggle mdl-js-ripple-effect" for="icon-toggle-2">
					<input type="checkbox" id="icon-toggle-2" class="mdl-icon-toggle__input" />
					<i class="mdl-icon-toggle__label mdi mdi-format-italic" style="font-size: 26px;"></i>
				</label>
			<h5 style="margin-top:30px;">Switch</h5>
			<hr>
			<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-1">
				<input type="checkbox" id="switch-1" class="mdl-switch__input" checked />
				<span class="mdl-switch__label"></span>
			</label>
			<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-2">
				<input type="checkbox" id="switch-2" class="mdl-switch__input" />
				<span class="mdl-switch__label"></span>
			</label>
			</div>
		</div>
		<div class="mdl-cell shadow mdl-cell--6-col mdl-cell--12-col-phone mdl-cell--12-col-tablet" style="background: white;">
			<div class="panel-header">
				Others
			</div>
			<div class="panel-body forms">
			<h5 style="margin-bottom: 24px; margin-top: 4px;">Textarea</h5>
				<form action="#">
					<div class="mdl-textfield mdl-js-textfield textfield-demo">
						<textarea class="mdl-textfield__input" type="text" rows= "7" id="sample5" ></textarea>
						<label class="mdl-textfield__label" for="sample5">Text area here...</label>
					</div>
				</form>
			<h5 style="margin-bottom: 24px;">Expanding Search</h5>
				<form action="#">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable textfield-demo">
						<label class="mdl-button mdl-js-button mdl-button--icon" for="sample6">
							<i class="mdi mdi-magnify"></i>
						</label>
						<div class="mdl-textfield__expandable-holder">
							<input class="mdl-textfield__input" type="text" id="sample6" />
							<label class="mdl-textfield__label" for="sample-expandable">Expandable Input</label>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

@stop