<div class="row">
	<div id="breadcrumb" class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="dashboard">Dashboard</a></li>
			<li><a href="#">Contracts</a></li>
			<li><a href="#">New Contract</a></li>
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
				<h4 class="page-header">New Contract</h4>
				<form class="form-horizontal" role="form" method="post" action="contracts" id="form-add-a-contract">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="contract_title">Contract Title:</label>
						<div class="col-sm-10">
								<input type="text" class="form-control" name="contract_title" id="contract_title"/>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group">

						<!--<label class="col-sm-2 control-label" for="form-styles">Textarea</label>-->
						<div class="col-sm-12">
								<textarea class="form-control" rows="15" name="contract_content" id="wysiwig_simple"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-2">
							<button type="submit" class="btn btn-primary btn-label-left btn-block">
							<span><i class="fa fa-save"></i></span>
								Save and Proceed
							</button>
						</div>
					</div>
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<input type="hidden" name="contract_type" value="1">
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

$(document).ready(function() {
	// Create Wysiwig editor for textarea
	TinyMCEStart('#wysiwig_simple');
	tinymce.execCommand('mceRemoveEditor',true,wysiwig_simple);
	tinymce.execCommand('mceAddEditor',true,wysiwig_simple);

	    $('#form-add-a-contract').on('submit', function(){ 
                 
       // ajax post method to pass form data to the 
		        $.post(
		            $(this).prop('action'),
		            {
		                "_token": $( this ).find( 'input[name=_token]' ).val(),
		                "contract_type": $( this ).find( 'input[name=contract_type]' ).val(),
		                "contract_title": $( '#contract_title' ).val(),
		                "contract_content": tinyMCE.activeEditor.getContent()
		            },
		            function(data){
		            	var ajax_url = 'file/' + data["contract_id"];
		                LoadAjaxContent(ajax_url);
		            },
		            'json'
		        ); 
		       
		        return false;
		    }); 
});
</script>						