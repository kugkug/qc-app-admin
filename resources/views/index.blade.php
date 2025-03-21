
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('images/au_logo.png') }}" type="image/x-icon">
  <title>Log in | Admin</title>

  <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/fontawesome-free/css/all.min.css') }} ">
  <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/dist/css/adminlte.min.css') }}">

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
          <p class="login-box-msg">Please sign in to start your session</p>
      
            <form method="post" action="/execute/login">
              @csrf
              <div class="input-group mb-3">
                <input type="text" name="email" class="form-control rounded-0" placeholder="Username" value="{{ old('email')}}">
                <div class="input-group-append">
                    <div class="input-group-text rounded-0">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control rounded-0" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text rounded-0">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
              <div class="row">
                <div class="col-12">
                @error('message')
                      <p class="text-danger">
                          {{$message}}
                      </p>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                      Remember Me
                    </label>
                  </div>
                </div>
              </div>
              <div class="row">
                <!-- /.col -->
                <div class="col-12">
                  
                  {{-- <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button> --}}
                  <a href="/admin" class="btn btn-primary btn-block btn-flat">
                    Sign In
                  </a>
                </div>
                <!-- /.col -->
              </div>
              
            </form>
          </div>
        
    </div>
</div>
<script src="{{ asset('assets/adminlte3.2/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/bootstrap/js/bootstrap.bundle.min.j') }}"></script>
<script src="{{ asset('assets/adminlte3.2/dist/js/adminlte.js') }}"></script>
</body>
</html>
