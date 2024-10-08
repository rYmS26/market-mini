<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
        html,body {
	height: 100%;
}

body.my-login-page {
	background-color: #f7f9fb;
	font-size: 14px;
}

.my-login-page .brand {
	width: 90px;
	height: 90px;
	overflow: hidden;
	border-radius: 50%;
	margin: 40px auto;
	box-shadow: 0 4px 8px rgba(0,0,0,.05);
	position: relative;
	z-index: 1;
}

.my-login-page .brand img {
	width: 100%;
}

.my-login-page .card-wrapper {
	width: 400px;
}

.my-login-page .card {
	border-color: transparent;
	box-shadow: 0 4px 8px rgba(0,0,0,.05);
}

.my-login-page .card.fat {
	padding: 10px;
	margin-top: 90px;
}

.my-login-page .card .card-title {
	margin-bottom: 30px;
}

.my-login-page .form-control {
	border-width: 2.3px;
}

.my-login-page .form-group label {
	width: 100%;
}

.my-login-page .btn.btn-block {
	padding: 12px 10px;
}

.my-login-page .footer {
	margin: 40px 0;
	color: #888;
	text-align: center;
}

@media screen and (max-width: 425px) {
	.my-login-page .card-wrapper {
		width: 90%;
		margin: 0 auto;
	}
}

@media screen and (max-width: 320px) {
	.my-login-page .card.fat {
		padding: 0;
	}

	.my-login-page .card.fat .card-body {
		padding: 15px;
	}
}
.teks {
    display: flex;
    justify-content: space-between; /* Mengatur posisi elemen secara horizontal */
    align-items: center; /* Menyelaraskan elemen secara vertikal */
    width: 100%;
}

.login-teks {
    margin: 0;
    font-size: 1.2em; /* Ubah ukuran font sesuai keinginan */
}

.home-teks {
    margin: 0;
    font-size: 1.2em; /* Ubah ukuran font sesuai keinginan */
}

    </style>
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
                    @if(session('error'))
            <div class="alert alert-danger">
                <b>Opps!</b> {{session('error')}}
            </div>
            @endif
            <form action="{{ route('actionlogin') }}" method="post">
            @csrf
					<div class="card fat">
						<div class="card-body">
						<div class="teks">
    						<h4 class="login-teks">Login</h4>
    						<h4 class="home-teks"><a href="{{route('home')}}" style="color:  #228be6;">Home</a></h4>
						</div>
							<form method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password
										<a href="forgot.html" class="float-right" style="color:  #228be6;">
											Forgot Password?
										</a>
									</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember" id="remember" class="custom-control-input">
										<label for="remember" class="custom-control-label">Remember Me</label>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-block" style="background-color: #228be6; color: white; font-weight: 500;">
										Login
									</button>
									<a href="{{ url('auth/google') }}" class="btn btn-danger btn-block">
                    					<strong>Login dengan Google</strong>
                					</a>
								</div>
								<div class="mt-4 text-center">
									Don't have an account? <a href="{{route('register')}}" style="color:  #228be6;">Create One</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2017 &mdash; Your Company 
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha384-SgWQX71pbKZ07bMycZTAwQFcxB6JCMzhVDgMDop3HYGPGb5xpR3apEy99Dx86uYH" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-DAsBR0AHcfe/V5zA3FdvYX3t8RoGaTy7CENrq9l5Al32rdU6OTc0AOMmUsZzsjZn" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-h4MUkkV3ZNUcAE28zTX5QJQ3ng/ABXHhzHQ7JS5wWCDuzKT2Bz7X0GQUbS9fEYYx" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
</body>
</html>