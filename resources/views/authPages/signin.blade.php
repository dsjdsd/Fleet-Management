@include('authCommonLayout.header')
<body class="theme-blush background">
	<div class="authentication">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-sm-12 m-auto">
					@if(session('error'))
						<div class="alert alert-danger">
							{{ session('error') }}
						</div>
					@endif
					<form class="card auth_form" method="POST" action="{{route('getloggedin')}}">
						@csrf
						<div class="header">
							<img class="logo" src="{{ asset('dashboard-assets/logo/up_police_logo.png') }}" alt="">
							<h5>Log in</h5>
						</div>
						<div class="body">
							<div class="input-group mb-3 pno_main_div">
								<input type="text" class="form-control" placeholder="Enter Your PNO / User Name" name="pno_number" id="pno_number" value="{{old('pno_number')}}"/>
								<div class="input-group-append">
									<span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
								</div>
							</div>
							@error('pno_number')
								<span class="error help-block">{{ $message }}</span>
                			@enderror

							<div class="input-group mb-3 registration_main_div">
								<input type="password" name="registration_number" id="password" class="form-control" placeholder="Vehicle Number / Password"/>
								<div class="input-group-append">
									<span class="input-group-text">
									<span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
									</span>
								</div>                            
							</div>
							@error('registration_number')
								<span class="error help-block">{{ $message }}</span>
                			@enderror

							<input type="submit" name="submit" id="submit" value="SIGN IN" class="btn btn-primary btn-block waves-effect waves-light" style="background: #2d3191;">                        
							<!-- <div class="signin_with mt-3">
								<p class="mb-0">or <a href="{{ route('forgetPassword') }}">Forget Password</a></p>
							</div> -->
						</div>
					</form>

<script>
$(function(){
    $(".auth_form").validate({
        rules: {
            pno_number:{
                required: true
            },
			registration_number:{
                required: true
            }
        },
        messages: {
            pno_number: {
                required: "Please enter a valid pno number"
            },
			registration_number: {
                required: "Please enter a valid registration number"
            }
        },
		errorPlacement: function(error, element) {
			if (element.attr("name") == "pno_number" ){
				error.insertAfter(".pno_main_div");
			}

			if (element.attr("name") == "registration_number" ){
				error.insertAfter(".registration_main_div");
			}
		}
    });
})
</script>
@include('authCommonLayout.footer')