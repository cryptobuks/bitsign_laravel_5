@extends('layouts.plain')

@section('body')

	<div class="login-overlay">
		<div class="logo">
			BitSign.it <br> <span class="smaller">Dashboard</span>
		</div>
		<div class="form-container shadow">
			<div class="icon">
				@yield('icon')
				<div class="header">
					@yield('name')
				</div>
			</div>
			<div class="inputs">
				@yield('login-content')							
			</div>
		</div>
	</div>
	<footer class="mdl-mini-footer login-footer">
			<div class="mdl-mini-footer__left-section">
					<div class="mdl-logo">&copy;Material Dashboard Theme</div>
				</ul>
			</div>
			<div class="mdl-mini-footer__right-section">
					<div class="mdl-logo">Terms and Conditions Apply</div>
				</ul>
			</div>
	</footer>


@stop

@section('js')

    @parent

    <script>
        
    </script>

@endsection