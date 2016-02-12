@extends('partials.login')

@section('page_title')
	Login
@stop

@section('icon')
	<i class="mdi mdi-account-circle"></i>
@stop

@section('name')
	Login
@stop

@section('login-content')

<form action="#">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
		<input class="mdl-textfield__input" type="email" id="sample3" />
		<label class="mdl-textfield__label" for="sample3">username or email</label>
	</div>
</form>
<form>	
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
		<input class="mdl-textfield__input" type="password" id="sample3" />
		<label class="mdl-textfield__label" for="sample3">password</label>
	</div>
</form>
<div class="buttons">
	<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2">
		<input type="checkbox" id="checkbox-2" class="mdl-checkbox__input" />
		<span class="mdl-checkbox__label">Remember me</span>
	</label>
	<span class="signup">
		<a href="/signup">Sign up here</a>
	</span>
	<div class="link">
		<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" href="/">
			Login
		</a>
	</div>
</div>


@stop