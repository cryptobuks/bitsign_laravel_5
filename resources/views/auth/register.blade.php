@extends('welcome.master')

@section('content')

    <!-- ******SIGNUP FORM****** -->
<section class="section signup-container offset-header">
	<div class="container">
    	<div class="signup-form">
    		<center>
	    	<h1 class="signup-title"><img src="/img/logo.png">Sign Up</h1> <br>
	    	@if (Session::get('messages') != NULL)
	    	<div class="alert alert-warning">
	    	@foreach (Session::get('messages') as $key => $value)
	    		{{{$value}}} <br>
	    	@endforeach
	    	</div>
	    	@endif
		      	{!! Form::open(array('url' => 'auth/register')) !!}
		      			<div class="form-group">
			      			{!! Form::label('f_name','First Name:') !!}
			      			<br>
			      			{!! Form::text('f_name') !!}
		      			</div>
		      			<div class="form-group">
			      			{!! Form::label('l_name','Last Name:') !!}
			      			<br>
			      			{!! Form::text('l_name') !!}
		      			</div>
		      			<div class="form-group">
			      			{!! Form::label('email','Email:') !!}
			      			<br>
			      			{!! Form::text('email') !!}
		      			</div>
		      			<div class="form-group">
			      			{!! Form::label('password','Password:') !!}
			      			<br>
			      			{!! Form::password('password') !!}
			      		</div>
			      		<div class="form-group">
			      			{!! Form::label('password_confirmation','Retype Password:') !!}
			      			<br>
			      			{!! Form::password('password_confirmation') !!}
			      		</div>
			      		<div class="form-group">
			      			{!! Form::label('agree','I agree to the Terms of Use:') !!}
			      			{!!  Form::checkbox('agree')  !!}
			      		</div>
			      		<div class="form-group">
			      			{!! Form::submit('Sign Up', array('class'=>'btn btn-cta-secondary')) !!}
			      		</div>
				{!! Form::close() !!}
			</center>
		</div>
	</div>
</section>
@stop