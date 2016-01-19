@extends('welcome.master')

@section('content')

    <!-- ******SIGNUP FORM****** -->
<section class="section signup-container offset-header">
	<div class="container">
    	<div class="signup-form">
    		<div class="card card-container" style="width: 34%;">
    		<center>
	    	<h1 class="signup-title"><img src="/img/logo.png">Sign Up</h1> <br>
	      	{!! Form::open(array('url' => 'auth/register')) !!}
	      			<div class="form-group">
		      			{!! Form::label('f_name','First Name:',array('style' => 'color:black')) !!}
		      			<br>
		      			{!! Form::text('f_name', '', array('class' => 'form-control')) !!}
	      			</div>
	      			<div class="form-group">
		      			{!! Form::label('l_name','Last Name:', array('style' => 'color:black')) !!}
		      			<br>
		      			{!! Form::text('l_name', '', array('class' => 'form-control')) !!}
	      			</div>
	      			<div class="form-group">
		      			{!! Form::label('email','Email:', array('style' => 'color:black')) !!}
		      			<br>
		      			{!! Form::text('email', '', array('class' => 'form-control')) !!}
		      			@if ($errors->has('email'))<p style="color:red;">{!!$errors->first('email')!!}</p>@endif
	      			</div>
	      			<div class="form-group">
		      			{!! Form::label('password','Password:', array('style' => 'color:black')) !!}
		      			<br>
		      			{!! Form::password('password', array('class' => 'form-control')) !!}
		      		</div>
		      		<div class="form-group">
		      			{!! Form::label('password_confirmation','Retype Password:', array('style' => 'color:black')) !!}
		      			<br>
		      			{!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
		      			@if ($errors->has('password'))<p style="color:red;">{!!$errors->first('password')!!}</p>@endif
		      		</div>
		      		<div class="form-group">
		      			{!! Form::label('terms','I agree to the Terms of Use:', array('style' => 'color:black')) !!}
		      			{!!  Form::checkbox('terms')  !!}
		      			@if ($errors->has('terms'))<p style="color:red;">{!!$errors->first('terms')!!}</p>@endif
		      		</div>
		      		<div class="form-group">
		      			{!! Form::submit('Sign Up', array('class'=>'btn btn-cta-secondary btn-block')) !!}
		      		</div>
			{!! Form::close() !!}
			<a href="/auth/login">or Log in</a>
			</center></div>
		</div>
	</div>
</section>
@stop