
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <meta name="_url" content="{!! URL::to('/') !!}" />
    <title>{{ $page_name }} | {{ $app_title }}</title>

  	<link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/fontawesome-free/css/all.min.css') }} ">
  	<link rel="stylesheet" href="{{ asset('assets/adminlte3.2/dist/css/adminlte.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/toastr/toastr.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/confirm/css/jquery-confirm.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
	<link rel="shortcut icon" href="{{ asset($app_favicon) }}" type="image/x-icon">

</head>

<body class="hold-transition login-page ">
    
<div class="login-box">
    <div class="login-logo">
        <a href="/">
          <img src="{{ asset('assets/images/system/qc_health_logo.png')}}" alt="" style="width: 150px;">
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
			<form>
				<p class="login-box-msg">Please sign in to start your session</p>
				<div class="input-group mb-3">
					<input type="text" name="email" class="form-control rounded-0" placeholder="Username" data="req" data-key="email">
					<div class="input-group-append">
						<div class="input-group-text rounded-0">
							<span class="fas fa-envelope"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="password" name="password" class="form-control rounded-0" placeholder="Password" data="req" data-key="password">
					<div class="input-group-append">
						<div class="input-group-text rounded-0">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-12">
						<button type="button" class="btn btn-primary btn-block btn-flat " data-trigger="login">Sign In</button>
					</div>
				</div>	
			</form>
		</div>
    </div>
</div>
<script src="{{ asset('assets/adminlte3.2/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/bootstrap/js/bootstrap.bundle.min.j') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/confirm/js/jquery-confirm.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/login.js') }}"></script>
</body>
</html>
