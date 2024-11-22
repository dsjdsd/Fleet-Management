@include('authCommonLayout.header')
		<body class="theme-blush background">
			<div class="authentication">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-sm-12 m-auto">
							<form class="card auth_form">
								<div class="header">
									<img class="logo" src="{{ asset('dashboard-assets/logo/up_police_logo.png') }}" alt="">
									<h5>Forgot Password?</h5>
									<span>Enter your e-mail address below to reset your password.</span>
								</div>
								<div class="body">
									<div class="input-group mb-3">
										<input type="text" class="form-control" placeholder="Enter Email">
										<div class="input-group-append">
											<span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
										</div>
									</div>
									<a href="{{route('dashboard')}}" class="btn btn-primary btn-block waves-effect waves-light">SUBMIT</a>                        
									<div class="signin_with mt-3">
										<a href="{{ route('Signin') }}" class="link">Sign-In ?</a>
									</div>
								</div>
							</form>
							@include('authCommonLayout.footer')