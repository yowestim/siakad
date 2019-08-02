<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login Admin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendor/linearicons/style.css')}}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{asset('assets/css/demo.css')}}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/favicon.png')}}">
	<script type="text/javascript" src="{{URL::asset('assets/js/jquery-1.12.0.min.js')}}"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <!-- WRAPPER -->
	<div id="wrapper">
        @include('sweet::alert')
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="{{asset('assets/img/logo-dark.png')}}" alt="Klorofil Logo"></div>
                                <p class="lead">
                                    @if (session('alert'))
                                        {{-- <div class="alert alert-danger"> --}}
                                        {{ session('alert') }}
                                    @endif
                                </p>
                            </div>
							<form class="form-auth-small" id="form-login" method="get">
							{{ csrf_field() }}
									<div class="form-group">
										<label for="signin-email" class="control-label sr-only">Username</label>
										<input type="text" id="username" class="form-control" name="username" placeholder="Username">
									</div>
									<div class="form-group">
										<label for="signin-password" class="control-label sr-only">Password</label>
										<input type="password" id="password" class="form-control" name="password" placeholder="Password">
									</div>
									<div class="form-group">
									<h5>Dont have an account? <a href="{{url('registrasi')}}">Daftar</a></h5>
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
							</form><br>
							<div class="row">
								<a href="{{url('loginguru')}}" class="btn btn-info btn-lg">Login Guru</a>
								<a href="{{url('loginsiswa')}}" class="btn btn-warning btn-lg">Login Siswa</a>
							</div>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Login</h1>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
     $("#form-login").on('submit', function(e){
        e.preventDefault()
        var username = $('#username').val();
        var password = $('#password').val();
        if(username == ""){
           alert("Username harus di isi!!!");
        } else if (password == "") {
			alert("Password harus di isi!!!");
        } else{
            $.ajax({
                type: "get",
                url: "{{url('/login/loginPoststaff')}}",
                data: {
                    _token: "{{csrf_token()}}",
                    username: username,
                    password: password
                },
                success: function (data) {
					// console.log(data);
					if(data == 1){
						alert("Berhasil Masuk")
						window.location.replace("{{url('staff/index')}}");
                    }else{
                    	alert("Username atau Password tidak terdaftar");
                 	 }
                }
            });
        }
    })
</script>
</body>

</html>