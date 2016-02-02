 <div class="row">
	<div id="breadcrumb" class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="dashboard">Dashboard</a></li>
			<li><a href="#">{{$subheading1}}</a></li>
			<li><a href="#">{{$subheading2}}</a></li>
			<li><a href="#">{{$subheading3}}</a></li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-pencil"></i>
					<span>Preview Contract</span>
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content">
				<h3 class="page-header">Bitsign.it Digital Contract (Hash: {{$contract_data['hash']}})</h3>
				<div id="contract_content">
					<p class="title"><strong>Title:</strong> {{$contract_data['title']}}</p>
					<p class="date"><strong>Date:</strong> {{$contract_data['date']}}</p>
					<div class="parties">
						<h4>People in this Contract</h4>
						@foreach ($contract_data['parties'] as $party=>$precords)
						<?php $firstpass = true; ?>
						<div class="party">
							@foreach ($precords as $precord)
							<div class="personrecord">
							@if ($firstpass)
							<?php $firstpass = false; ?>
							@else
							<p>and</p>
							@endif
							<p><strong>{{$precord[0]}}</strong> of <em>{{$precord[1]}}</em></p>
							</div>
							@endforeach
							@if (count($precords)==1)
							<p>, hereafter known as</p>
							@else
							<p>, hereafter colectively known as</p>
							@endif
							<p><strong>{{$party}}</strong></p>
						</div>
						@endforeach
					</div>
					<div class="contractbody">
						{{$contract_data['body']}}
					</div>
					<div class="filerecords">
						<h4>File Records</h4>
						@foreach ($contract_data['filerecords'] as $filerecord)
						<div class="filerecord">
							<p><strong>Filename: </strong>{{$filerecord['filename']}}</p>
							<p><strong>File Type: </strong>{{$filerecord['type']}}</p>
							<p><strong>Hash: </strong>{{$filerecord['hash']}}</p>
						</div>
						@endforeach
					</div>
				</div>
				<br>
				<form id="sign-form" action="sign" method="POST">
					<br>
					<input type="hidden" value="<?php echo csrf_token(); ?>" name="_token"></input>
				    <input type="hidden" value="{{$contract_data['id']}}" name="contract_id"></input>
				    <button type="submit" class="btn btn-primary btn-label-left btn-block">
							<span><i class="fa fa-save"></i></span>
								Sign this Contract
							</button>
				</form>
				<br><br>
				<div id="messages"></div>
			</div>
		</div>
	</div>
</div>
<script>
$(function () {
    $('#sign-form').on('submit', function(){ 
                 
   // ajax post method to pass form data to the server
	        $.post(
	            $(this).prop('action'),
	            {
	                "_token": $( this ).find( 'input[name=_token]' ).val(),
	                "contract_id": $( this ).find( 'input[name=contract_id]' ).val()
	            },
	            function(data){
	            	$( '#messages' ).append( "<p class=\"success\" style=\"color:green\">"+data['message']+"</p>" );
	            },
	            'json'
	        ); 
	       
	        return false;
	    });
});
</script>