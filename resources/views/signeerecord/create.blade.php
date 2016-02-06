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
					<span>Create a New Contract</span>
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
				<h4 class="page-header">Add people that need to sign this contract</h4>
				<form class="form-horizontal" role="form" action="signeerecord" method="post" id="form-add-signees">
					<div class="form-group">
						<div class="col-sm-4">
								<input type="text" placeholder="email address" class="form-control" name="signee_email" id="signee_email"/>
								<button type="submit" class="btn btn-success btn-label-left btn-block">
								<span><i class="fa fa-plus"></i></span>
									Add Signee
								</button>
						</div>
					</div>
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<input type="hidden" name="contract_id" value="{{$contract_id}}">
				</form>
				<div>
				<table class="table table-bordered table-striped table-hover table-heading table-datatable">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th><center>Delete</center></th>
						</tr>
					</thead>
					<tbody id="added-signees">
					@if(isset($signeerecords))
					@foreach($signeerecords as $signeerecord)
						<tr class="signeerecord" id="{{$signeerecord['id']}}">
							<td>{{$signeerecord['name']}}</td>
							<td>{{$signeerecord['email']}}</td>
							<td><center><button id="{{$signeerecord['id']}}" class="delete-button btn-app-sm btn-circle btn-danger"><i class="fa fa-remove"></i></button></center></td>
						</tr>
					@endforeach
					@endif
					</tbody>
				</table>
		    	</div>
		    	<div id="messages"></div>
				<div class="nav-buttons">
						<button id="btnPrev" class="col-sm-2 btn btn-primary pull-left">
							<span style="padding-right:8px"><i class="fa fa-arrow-left"></i></span>
							Previous Step
						</button>
						<button style="margin-left:16px" id="btnNext" class="col-sm-2 btn btn-primary">
							Save and Proceed
							<span style="padding-left:8px"><i class="fa fa-arrow-right"></i></span>
						</button>
				</div>
				<br><br>
			</div>
		</div>
	</div>
</div>

<script>
$(function () {
    $('#form-add-signees').on('submit', function(){ 
                 
       // ajax post method to pass form data to the 
        $.post(
            $(this).prop('action'),
            {
                "_token": $( this ).find( 'input[name=_token]' ).val(),
                "contract_id": $( this ).find( 'input[name=contract_id]' ).val(),
                "email": $( this ).find( 'input[name=signee_email]' ).val()
            },
            function(data){
            	if(data['exists']==1) {
            		$( '#added-signees' ).append("<tr class=\"signeerecord\" id=\""+String(data['id'])+"\"><td>"+String(data['name'])+"</td><td>"+String(data['email'])+"</td><td><center><button id=\""+String(data['id'])+"\" class=\"delete-button btn-app-sm btn-circle btn-danger\"><i class=\"fa fa-remove\"></i></button></center></td></tr>");
				}
				else if(data['exists']==0) {
					$('#messages').append("<p style=\"color:orange\">"+String(data['message']+data['email'])+'</p>');
				}
				else if(data['exists']==2) {
					$('#messages').append("<p style=\"color:red\">Signee "+data['name']+" already added ("+data['email']+")</p>");
				}
				RefreshActionButtons();
            },
            'json'
        ); 
       
        return false;
	});
	//navigation buttons
    $("#btnNext").click(function(){
    	var ajax_url = 'sign/' + '{{$contract_id}}';
    	window.location.hash = ajax_url;
		LoadAjaxContent(ajax_url);
    });
    $("#btnPrev").click(function(){
    	var ajax_url = 'file/' + '{{$contract_id}}';
    	window.location.hash = ajax_url;
		LoadAjaxContent(ajax_url);
    });
    RefreshActionButtons();
});
</script>