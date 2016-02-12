@extends('partials.dashboard')

@section('dashboard-content')

<div class="inbox">
	<div class="mdl-grid">
		<div class="mdl-cell mdl-cell--3-col">
			<div class="lists">
				<ul class="tabs">
					<li><a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="/inbox"><i class="mdi mdi-email"></i>&nbsp;&nbsp;Inbox</a></li>
					<li><a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="#modal"><i class="mdi mdi-pencil"></i>&nbsp;&nbsp;Compose</a></li>
					<li><a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="#"><i class="mdi mdi-check"></i>&nbsp;&nbsp;Done</a></li>
					<hr>
					<li><a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="#"><i class="mdi mdi-email-open"></i>&nbsp;&nbsp;Drafts</a></li>
					<li><a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="#"><i class="mdi mdi-send"></i>&nbsp;&nbsp;Sent</a></li>
					<li><a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="#"><i class="mdi mdi-delete"></i>&nbsp;&nbsp;Trash</a></li>
					<li><a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="#"><i class="mdi mdi-alert-circle"></i>&nbsp;&nbsp;Spam</a></li>
					<li><a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="#"><i class="mdi mdi-account-multiple-plus"></i>&nbsp;&nbsp;Names</a></li>
					<hr>
					<li><a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="#"><i class="mdi mdi-airplane"></i>&nbsp;&nbsp;Trips</a></li>
					<li><a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="#"><i class="mdi mdi-label"></i>&nbsp;&nbsp;Labels</a></li>
				</ul>
			</div>			
		</div>
		<div class="mdl-cell mdl-cell--9-col">
			<div class="content">
				@yield('inbox')
			</div>
		</div>
	</div>
</div>
@endsection