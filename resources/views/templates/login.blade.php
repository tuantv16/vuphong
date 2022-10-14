
<style>
	.close {
		position: absolute;
		right: 15px;
		top: 0
	}

	#btn-register:hover {
		cursor: pointer;
	}
</style>
@section('javascript')
	<script src="{{ asset('js/frontend/login.js') }}"></script>
@endsection

@extends('templates.default')
@section('master_layout_content')
	<section style="margin-bottom: 100px"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-1">
					@if ( Session::has('success') )
						<div class="alert alert-success alert-dismissible" role="alert">
							<strong>{{ Session::get('success') }}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
						</div>
					@endif
					<?php //Hiển thị thông báo lỗi?>
					@if ( Session::has('error') && Session::has('flag_login'))
						<div class="alert alert-danger alert-dismissible" role="alert">
							<strong>{{ Session::get('error') }}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
						</div>
					@endif

					@if ($errors->any())
						<div class="alert alert-danger alert-dismissible" role="alert">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
						</div>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập tài khoản</h2>
						<form role="form" action="{{ url('/login') }}" method="POST">
							{!! csrf_field() !!}
							<input class="form-control" placeholder="Email" name="email" type="text" value="{{ old('email') }}" autofocus>
							<input class="form-control" placeholder="Mật khẩu" name="password" type="password" value="">
							<span>
								<input id="register-check2" type="checkbox" class="checkbox"> 
								<label for="register-check2" style="margin-top: 2px">Ghi nhớ tài khoản - </label>
								<a id="btn-register">Đăng ký tài khoản</a> 
								
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1 show-register" style="display:none">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4 show-register" style="display:none">
					<!-- Hiển thị thông báo END -->
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký tài khoản</h2>
						<form role="form" method="POST" action="{{ url('/register') }}">
							{!! csrf_field() !!}
							<input placeholder="Họ và tên" name="name" type="text" value="{{ old('name') }}" autofocus>
							<input placeholder="Email" name="email" type="text" value="{{ old('email') }}">
							<input placeholder="Mật khẩu" name="password" type="password">
							<input placeholder="Xác nhận mật khẩu" name="password_confirmation" type="password">
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
@endsection