<div class="row">
	<div id="breadcrumb" class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="dashboard">Dashboard</a></li>
			<li><a href="#">Contracts</a></li>
			<li><a href="#">My Contracts</a></li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-file-text-o"></i>
					<span>My Contracts</span>
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
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
					<thead>
						<tr>
							<th>Select</th>
							<th>Contract Title</th>
							<th>Type</th>
							<th>Date Last modified</th>
							<th>Edit</th>
							<th>Create new Signature</th>
						</tr>
					</thead>
					<tbody>
						@foreach($contracts as $key=>$contract)
						<tr>
							<td>{{$key + 1}}</td>
							<td>{{$contract['title']}}</td>
							<td>{{$contract['type']}}</td>
							<td>{{$contract['created_at']}}</td>
							<td><a class="ajax-link" href="contracts/{{$contract['id']}}/edit">Edit</a></td>
							<td>Send for Signing</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>Select</th>
							<th>Contract Title</th>
							<th>Type</th>
							<th>Date Last modified</th>
							<th>Edit</th>
							<th>Create new Signature</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
// Run Datables plugin and create 3 variants of settings
function AllTables(){
	ContractsTable();
	LoadSelect2Script(MakeSelect2);
}
function MakeSelect2(){
	$('select').select2();
	$('.dataTables_filter').each(function(){
		$(this).find('label input[type=text]').attr('placeholder', 'Search');
	});
}
$(document).ready(function() {
	// Load Datatables and run plugin on tables 
	LoadDataTablesScripts(AllTables);
});
$('.box-content').find('a.ajax-link').click(function (e){
	e.preventDefault();
	if ($(this).hasClass('add-full')) {
		$('#content').addClass('full-content');
	}
	else {
		$('#content').removeClass('full-content');
	}
	var url = $(this).attr('href');
	window.location.hash = url;
	LoadAjaxContent(url);
});
</script>