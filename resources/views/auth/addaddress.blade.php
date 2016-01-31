@extends('welcome.master')

@section('content')

    <!-- ******ADD ADDRESS FORM****** -->
<section class="section address-container offset-header">
	<div class="container">
    	<div class="address-form">
    		<div class="card card-container" style="width: 34%;">
    		<center>
	    	<h3>Please add your Address</h3> <br>
	      	{!! Form::open(array('url' => 'addaddress')) !!}
	      			<div class="form-group">
		      			{!! Form::label('line_1','Address Line 1:',array('style' => 'color:black')) !!}
		      			<br>
		      			{!! Form::text('line_1', '', array('class' => 'form-control')) !!}
	      			</div>
	      			<div class="form-group">
		      			{!! Form::label('line_2','Address Line 2:', array('style' => 'color:black')) !!}
		      			<br>
		      			{!! Form::text('line_2', '', array('class' => 'form-control')) !!}
	      			</div>
	      			<div class="form-group">
		      			{!! Form::label('city','City:', array('style' => 'color:black')) !!}
		      			<br>
		      			{!! Form::text('city', '', array('class' => 'form-control')) !!}
	      			</div>
	      			<div class="form-group">
		      			{!! Form::label('country','Country:', array('style' => 'color:black')) !!}
		      			<br>
		      			{!! Form::text('country', '', array('class' => 'form-control')) !!}
	      			</div>
	      			<div class="form-group">
		      			{!! Form::label('state','State:', array('style' => 'color:black')) !!}
		      			<br>
		      			{!! Form::text('state', '', array('class' => 'form-control')) !!}
	      			</div>
	      			<div class="form-group">
		      			{!! Form::label('postalcode','Postcode:', array('style' => 'color:black')) !!}
		      			<br>
		      			{!! Form::text('postalcode', '', array('class' => 'form-control')) !!}
	      			</div>
		      		<div class="form-group">
		      			{!! Form::submit('Save', array('class'=>'btn btn-cta-secondary btn-block')) !!}
		      		</div>
			{!! Form::close() !!}
			</center></div>
		</div>
	</div>
</section>
@stop