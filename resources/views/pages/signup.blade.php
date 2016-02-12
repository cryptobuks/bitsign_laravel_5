@extends('partials.login')

@section('page_title')
	Sign Up
@stop

@section('icon')
	<i class="mdi mdi-account-circle"></i>
@stop

@section('name')
	Sign Up
@stop

@section('login-content')

<form>
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
		<input class="mdl-textfield__input" type="text" id="sample3" />
		<label class="mdl-textfield__label" for="sample3">full name</label>
	</div>
</form>
<form>
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
		<input class="mdl-textfield__input" type="email" id="sample3" />
		<label class="mdl-textfield__label" for="sample3">email</label>
	</div>
</form>
<form>	
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
		<input class="mdl-textfield__input" type="password" id="sample3" />
		<label class="mdl-textfield__label" for="sample3">password</label>
	</div>
</form>
<form>	
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
		<input class="mdl-textfield__input" type="password" id="sample3" />
		<label class="mdl-textfield__label" for="sample3">retype password</label>
	</div>
</form>
<div class="buttons">
	<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2">
		<input type="checkbox" id="checkbox-2" class="mdl-checkbox__input" />
		<span class="mdl-checkbox__label">Remember me</span>
	</label>
	<span class="signup">
		<a href="/login">Login here</a>
	</span>
	<div class="link">
		<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" href="/">
			Signup
		</a>
	</div>
</div>


@stop