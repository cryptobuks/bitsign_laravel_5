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
					<span>Step 2</span>
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
				<h4 class="page-header">Add files that you want to be part of this record</h4>
				<div>
				<table class="table table-bordered table-striped table-hover table-heading table-datatable">
					<thead>
						<tr>
							<th>File Name</th>
							<th>Hash Value</th>
							<th><center>Delete</center></th>
						</tr>
					</thead>
					<tbody id="files">
					@if(isset($filerecords))
					@foreach($filerecords as $filerecord)
						<tr id="{{$filerecord['id']}}">
							<td>{{$filerecord['filename']}}</td>
							<td>{{$filerecord['hash']}}</td>
							<td><center><button data-url="file/{{$filerecord['id']}}/delete" class="delete-button btn-app-sm btn-circle btn-danger"><i class="fa fa-remove"></i></button></center></td>
						</tr>
					@endforeach
					@endif
					</tbody>
				</table>
		    	</div>
				<form id="fileupload" action="file" method="POST" enctype="multipart/form-data">
					<input type="file" name="files[]" multiple>
					<input type="hidden" value="<?php echo csrf_token(); ?>" name="_token">
				    <input type="hidden" value="{{$contract_id}}" name="contract_id">
				</form>
				<br>
			    <!-- The container for the uploaded files -->
			    <div id="messages"></div>
			    <br>
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
<script src="plugins/file-upload/js/vendor/jquery.ui.widget.js"></script>
<script src="plugins/file-upload/js/jquery.iframe-transport.js"></script>
<script src="plugins/file-upload/js/jquery.fileupload.js"></script>
<script>
$(function () {
    $('#fileupload').fileupload({
        dataType: 'json',
        singleFileUploads:false,
        done: function (e, data) {
            $.each(data._response.result.files, function (index, file) {
                $( '#files' ).append("<tr id=\""+String(file['id'])+"\"><td>"+String(file['filename'])+"</td><td>"+String(file['hash'])+"</td><td><center><button data-url=\"file/"+String(file['id'])+"/delete\" class=\"delete-button btn-app-sm btn-circle btn-danger\"><i class=\"fa fa-remove\"></i></button></center></td></tr>");
            });
            $.each(data._response.result.errors, function (index, error) {
                $( '#messages' ).append( "<p class=\"error\" style=\"color:red\">"+String(error)+"</p>" );
            });
            if (typeof(data._response.result.deleted) != "undefined") {
            	$("#"+data._response.result.deleted).remove();
            };
        }
    });
    $("#btnNext").click(function(){
    	var ajax_url = 'signeerecord/' + '{{$contract_id}}';
		LoadAjaxContent(ajax_url);
    });
    $("#btnPrev").click(function(){
    	var ajax_url = 'contracts/' + '{{$contract_id}}' +'/edit';
		LoadAjaxContent(ajax_url);
    });
    //delete button
	$(".delete-button").on("click", function(){
		$.get(
	        $(this).attr('data-url'),
	        function(data){
	        	if (typeof(data["deleted"]) != "undefined") {
	            	$("#"+data["deleted"]).remove();
	            };
	        },
	        'json'
	    );
	});
});
</script>