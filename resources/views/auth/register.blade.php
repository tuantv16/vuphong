@extends('templates.master_login')
    @section('title','Trang quản lý')
    @section('content')
    <?php //Hiển thị thông báo thành công?>
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
    @if ( Session::has('error') )
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
    <div class="container" style="margin-top: 10%">
    	<div class="row">
    		<div class="col-sm-6 col-md-4 col-md-offset-4">
    			<div class="panel panel-default">
    				<div class="panel-heading">
    					<h4 class="panel-title">ĐĂNG KÝ THÀNH VIÊN</h4>
    				</div>
    				<div class="panel-body">
    					<form role="form" method="POST" action="{{ url('/admin/register') }}">
    						{!! csrf_field() !!}
    						<div class="form-group">
    							<div class="input-group">
    								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    								<input class="form-control" placeholder="Họ và tên" name="name" type="text" value="{{ old('name') }}" autofocus>
    							</div>
    						</div>
    						<div class="form-group">
    							<div class="input-group">
    								<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
    								<input class="form-control" placeholder="Email" name="email" type="text" value="{{ old('email') }}">
    							</div>
    						</div>
    						<div class="form-group">
    							<div class="input-group">
    								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    								<input class="form-control" placeholder="Mật khẩu" name="password" type="password">
    							</div>
    						</div>
    						<div class="form-group">
    							<div class="input-group">
    								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    								<input class="form-control" placeholder="Xác nhận mật khẩu" name="password_confirmation" type="password">
    							</div>
    						</div>
    						<div class="form-group">
    							<button type="submit" class="btn btn-lg btn-primary btn-block">Đăng ký</button>
    						</div>
    						<center><a href="{{ url('/admin/login') }}">Quay về đăng nhập</a></center>
    					</form>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <style>
    body{
    	background: #17568C;
    }
    .panel{
    	border-radius: 5px;
    }
    .panel-heading {
        padding: 10px 15px;
    }
    .panel-title{
    	text-align: center;
    	font-size: 15px;
    	font-weight: bold;
    	color: #17568C;
    }
    .panel-footer {
    	padding: 1px 15px;
    	color: #A0A0A0;
    }
    .profile-img {
    	width: 120px;
    	height: 120px;
    	margin: 0 auto 10px;
    	display: block;
    	-moz-border-radius: 50%;
    	-webkit-border-radius: 50%;
    	border-radius: 50%;
    }
    </style>
    @endsection