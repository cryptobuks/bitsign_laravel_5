@extends('welcome.master')

@section('content')

    <!-- ******LOGIN FORM****** -->
<section class="section login-container offset-header">
	<div class="container">
    	<div class="login-form">
			<div class="card card-container">
	    		<center>
			    	<h1 class="login-title"><img src="/img/logo.png">Login</h1> <br>
			    	@if ($errors->get('email'))
			    	<div class="alert alert-danger">
			    	Incorrect username/password combination
			    	</div>
			    	@endif
			      	{!!  Form::open(array('url' => 'auth/login'))  !!}
			      			<div class="form-group">
				      			{!! Form::email('email', $value = old('email'), array('class' => 'form-control', 'placeholder' => 'Email address', 'required', 'autofocus')) !!}
			      			</div>
			      			<div class="form-group">
				      			{!! Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password', 'required')) !!}
				      		</div>
				      		<div class="form-group">
				      			{!! Form::submit('Login', array('class'=>'btn btn-lg btn-cta-secondary btn-block')) !!}
				      		</div>
					{!!  Form::close()  !!}
					<a href="/auth/register">or Sign Up</a>
				</center>
			</div>
		</div>
	</div>
</section>
@stop