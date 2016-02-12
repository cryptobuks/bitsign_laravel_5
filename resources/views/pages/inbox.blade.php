@extends('partials.inbox')

@section('page_title')
	Inbox
@stop

@section('inbox')
	<h6>Today</h6>
	<div class="collapse-card shadow" style="margin-bottom: 5px;">
		<div class="collapse-card__heading">
			<div class="collapse-card__title">
				<span class="sender left"><i class="mdi mdi-account"></i>Gary Neville <i class="mdi mdi-check-all"></i></span> <span class="subjecth">Request for loan.</span><span class="time right">48 minutes ago</span>
			</div>
		</div>
		<div class="collapse-card__body">
			<div class="subject">
				Request for loan.
			</div>
			<div class="body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, saepe ex ipsam, nemo maiores eius incidunt. Sint unde laborum, eligendi praesentium voluptates incidunt ex animi dolor nobis possimus odio autem.</p>
			</div>
			<div class="footer">
				Sincerely, <br>
				Gary Neville
				<a href="#modal" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored right absolute trigger">
					<i class="mdi mdi-pencil"></i>
				</a>
			</div>
		</div>
	</div>
	<div class="collapse-card shadow" style="margin-bottom: 5px;">
		<div class="collapse-card__heading">
			<div class="collapse-card__title">
				<span class="sender left"><i class="mdi mdi-account"></i>Jamie Carragher <i class="mdi mdi-check-all"></i></span> <span class="subjecth">Once a scouse, always a scouse.</span><span class="time right">2:06 p.m.</span>
			</div>
		</div>
		<div class="collapse-card__body">
			<div class="subject">
				Once a scouse, always a scouse.
			</div>
			<div class="body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, saepe ex ipsam, nemo maiores eius incidunt. Sint unde laborum, eligendi praesentium voluptates incidunt ex animi dolor nobis possimus odio autem.</p>
			</div>
			<div class="footer">
				Sincerely, <br>
				Jamie Carragher
				<a href="#modal" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored right absolute trigger">
					<i class="mdi mdi-pencil"></i>
				</a>
			</div>
		</div>
	</div>	
	<div class="collapse-card shadow" style="margin-bottom: 5px;">
		<div class="collapse-card__heading">
			<div class="collapse-card__title">
				<span class="sender left"><i class="mdi mdi-account"></i>Michael Owen <i class="mdi mdi-check-all"></i></span> <span class="subjecth">Let's meet up in LA.</span><span class="time right">2:06 p.m.</span>
			</div>
		</div>
		<div class="collapse-card__body">
			<div class="subject">
				Meet up in LA.
			</div>
			<div class="body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, saepe ex ipsam, nemo maiores eius incidunt. Sint unde laborum, eligendi praesentium voluptates incidunt ex animi dolor nobis possimus odio autem.</p>
			</div>
			<div class="footer">
				Sincerely, <br>
				Michael Owen.
				<a href="#modal" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored right absolute trigger">
					<i class="mdi mdi-pencil"></i>
				</a>
			</div>
		</div>
	</div>	
	<h6>Yesterday</h6>
	<div class="collapse-card shadow" style="margin-bottom: 5px;">
		<div class="collapse-card__heading">
			<div class="collapse-card__title">
				<span class="sender left"><i class="mdi mdi-account"></i>Raheem Sterling <i class="mdi mdi-check-all"></i></span> <span class="subjecth">Is BR still thinking of me?</span><span class="time right">48 minutes ago</span>
			</div>
		</div>
		<div class="collapse-card__body">
			<div class="subject">
				Is BR still thinking of me?
			</div>
			<div class="body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, saepe ex ipsam, nemo maiores eius incidunt. Sint unde laborum, eligendi praesentium voluptates incidunt ex animi dolor nobis possimus odio autem.</p>
			</div>
			<div class="footer">
				Sincerely, <br>
				Raheem Sterling
				<a href="#modal" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored right absolute trigger">
					<i class="mdi mdi-pencil"></i>
				</a>
			</div>
		</div>
	</div>
	<div class="collapse-card shadow" style="margin-bottom: 5px;">
		<div class="collapse-card__heading">
			<div class="collapse-card__title">
				<span class="sender left"><i class="mdi mdi-account"></i>Luis Suarez <i class="mdi mdi-check-all"></i></span> <span class="subjecth">Things are good in Catalunya.</span><span class="time right">2:06 p.m.</span>
			</div>
		</div>
		<div class="collapse-card__body">
			<div class="subject">
				Things are good in Catalunya.
			</div>
			<div class="body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, saepe ex ipsam, nemo maiores eius incidunt. Sint unde laborum, eligendi praesentium voluptates incidunt ex animi dolor nobis possimus odio autem.</p>
			</div>
			<div class="footer">
				Sincerely, <br>
				Luis Suarez
				<a href="#modal" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored right absolute trigger">
					<i class="mdi mdi-pencil"></i>
				</a>
			</div>
		</div>
	</div>	

	<div class="remodal shadow" data-remodal-id="modal" data-remodal-options="closeOnOutsideClick: false">
		<button data-remodal-action="close" class="remodal-close"></button>
		<div class="panel-header">Compose</div>
		<div class="modal-body">
		<form action="#">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
				<input class="mdl-textfield__input" type="email" id="sample3" />
				<label class="mdl-textfield__label" for="sample3">Email</label>
			</div>
		</form>	
		<form action="#">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
				<input class="mdl-textfield__input" type="text" id="sample3" />
				<label class="mdl-textfield__label" for="sample3">Subject</label>
			</div>
		</form>		
		<form action="#">
			<div class="mdl-textfield mdl-js-textfield textfield-demo">
				<textarea class="mdl-textfield__input" type="text" rows= "8" id="sample5" ></textarea>
				<label class="mdl-textfield__label" for="sample5">Content</label>
			</div>
		</form>	
		<br>

		<button data-remodal-action="cancel" class="remodal-cancel mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect cancel">Cancel</button>
		<button data-remodal-action="confirm" class="remodal-confirm mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect send">Send</button>
		</div>
	</div>


@stop

@section('js')

    @parent

    <script>
    	$(function () {
			$('.collapse-card').paperCollapse();
			$('.collapse-card__heading').click(function() {				
				$(this).find('.subjecth').toggle();
			})				
		});

    </script>

@endsection