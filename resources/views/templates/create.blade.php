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
	<div class="col-xs-9 col-sm-9">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-file-text-o"></i>
					<span>Contract Content</span>
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
			<button type="button" class="btn btn-success ltn-label-right btn-xs" id="add-clause">
				<span><i class="fa fa-plus"></i></span> Add Clause...
			</button>
			<div class="clauses">
				<div class="clause"><span class="clause-label">Unnamed clause</span><button id="" class="delete-clause btn-app-sm btn-circle btn-danger pull-right"><i class="fa fa-remove"></i></button><div class="clause-content editable"><p>insert text</p></div></div>
			</div>
			</div>
		</div>
	</div>
	<div class="col-xs-3 col-sm-3 document-menu">
		<div class="row general-terms">
			<div class="box">
				<div class="box-header">
					<div class="box-name">
						<i class="fa fa-pencil"></i>
						<span>Terms</span>
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
					<button type="button" class="btn btn-success ltn-label-right btn-xs" data-toggle="modal" data-target="#termModal">
					<span><i class="fa fa-plus"></i></span> Define...
					</button>
					<ul>
						<li>The Blockchain</li>
						<li>The Company</li>
						<li>You/Your</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row personrecords">
			<div class="box">
				<div class="box-header">
					<div class="box-name">
						<i class="fa fa-user"></i>
						<span>Parties</span>
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
					<button type="button" class="btn btn-success ltn-label-right btn-xs" data-toggle="modal" data-target="#prModal">
					<span><i class="fa fa-plus"></i></span> Add party...
					</button>
					<ul>
						<li>Company Representative</li>
						<li>The Inventor</li>
						<li>Witness</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row filerecords">
			<div class="box">
				<div class="box-header">
					<div class="box-name">
						<i class="fa fa-file"></i>
						<span>Attachments</span>
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
					<button type="button" class="btn btn-success ltn-label-right btn-xs">
					<span><i class="fa fa-plus"></i></span> Add...
					</button>
					<ul>
						<li>Blueprint</li>
						<li>CAD Models</li>
						<li>Video Signature</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@include('templates.termmodal')
@include('templates.prmodal')
@include('templates.attachmentmodal')
<script type="text/javascript">

$(document).ready(function() {
	// Create Wysiwig inline init for clauses
	var counter = 1;
	var plugins = [];
	TinyMCERefresh('.editable');
	// tinymce.execCommand('mceRemoveEditor',true,wysiwig_simple);
	// tinymce.execCommand('mceAddEditor',true,wysiwig_simple);
	// var termslist = {{json_encode(['The Company','You/Your', 'The Blockchain'])}};
	// $.each(termslist as term)
	$("#add-clause").click(function(){
    	$( '.clauses' ).append("<div class=\"clause\"><span class=\"clause-label\">Unnamed clause</span><button id=\"\" class=\"delete-clause btn-app-sm btn-circle btn-danger pull-right\"><i class=\"fa fa-remove\"></i></button><div class=\"clause-content editable\"><p>insert text</p></div></div>");
    	RefreshClauseDelete();
    	TinyMCERefresh('.editable');
    });
    RefreshClauseDelete();
});
function RefreshClauseDelete(){
	//delete button
	$(".delete-clause").off();
	$(".delete-clause").on("click", function(){
    	$(this).parent().remove();
	});
}
//
// Helper for run TinyMCE editor with textarea's
//
function TinyMCERefresh(elem){
	if (typeof(tinymce) != "undefined") {
	    tinymce.EditorManager.editors = [];
	}
	var plugins = [];
	tinymce.init({selector: elem,
		inline:true,
		theme: "modern",
		plugins: plugins,
		//content_css: "css/style.css",
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
		style_formats: [
			{title: 'Header 2', block: 'h2', classes: 'page-header'},
			{title: 'Header 3', block: 'h3', classes: 'page-header'},
			{title: 'Header 4', block: 'h4', classes: 'page-header'},
			{title: 'Header 5', block: 'h5', classes: 'page-header'},
			{title: 'Header 6', block: 'h6', classes: 'page-header'},
			{title: 'Bold text', inline: 'b'},
			{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			{title: 'Example 1', inline: 'span', classes: 'example1'},
			{title: 'Example 2', inline: 'span', classes: 'example2'},
			{title: 'Table styles'},
			{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
		]
	});
}
</script>