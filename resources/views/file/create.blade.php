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
			    <!-- The container for the uploaded files -->
			    <div id="files"></div>
			    <br>
			    <div class="next button">
					<div class="col-sm-2">
						<button id="btnNext" class="btn btn-primary btn-label-left btn-block">
						<span><i class="fa fa-save"></i></span>
							Save and Proceed
						</button>
					</div>
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
        done: function (e, data) {
            $.each(data._response.result.files, function (index, filename) {
                $( '#files' ).append( "<p class=\"success\" style=\"color:green\">"+String(filename)+"</p>" );
            });
            $.each(data._response.result.errors, function (index, error) {
                $( '#files' ).append( "<p class=\"error\" style=\"color:red\">"+String(error)+"</p>" );
            });
        }
    });
    $("#btnNext").click(function(){
    	var ajax_url = 'signeerecord/' + '{{$contract_id}}';
		LoadAjaxContent(ajax_url);
    });
});
</script>