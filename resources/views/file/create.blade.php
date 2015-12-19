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
				<form id="fileupload" action="file" method="POST" enctype="multipart/form-data">
					<h4 class="page-header">Add files that you want to be part of this record</h4>
					<br>
					<input type="file" name="files[]" multiple>
					<input type="hidden" value="<?php echo csrf_token(); ?>" name="_token"></input>
				    <input type="hidden" value="{{$contract_id}}" name="contract_id"></input>
				</form>
				<br>
			    <!-- The global progress bar -->
			    <div id="progress" class="progress">
			        <div class="progress-bar progress-bar-success"></div>
			    </div>
			    <!-- The container for the uploaded files -->
			    <div id="files" class="files"></div>
			    <br>
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
        done: function (e, data) {
        	console.log(data);
            $.each(data._response.result.files, function (index, filename) {
                $('<p/>').text(filename).appendTo('#files');
            });
            $.each(data._response.result.errors, function (index, error) {
                $('<p/>').text(error).appendTo('#files');
            });
        }
    });
});
</script>