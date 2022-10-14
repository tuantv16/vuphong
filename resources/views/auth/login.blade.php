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
    				<div class="panel-body">
    					<form role="form" action="{{ url('/admin/login') }}" method="POST">
    						{!! csrf_field() !!}
    						<fieldset>
    							<div class="row">
    								<div class="center-block">
    									<img class="profile-img" src="/public/images/user-icon.png" alt="User">
    								</div>
    							</div>
    							<div class="row">
    								<div class="col-sm-12 col-md-10  col-md-offset-1 ">
    									<div class="form-group">
    										<div class="input-group">
    											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> 
    											<input class="form-control" placeholder="Email" name="email" type="text" value="{{ old('email') }}" autofocus>
    										</div>
    									</div>
    									<div class="form-group">
    										<div class="input-group">
    											<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    											<input class="form-control" placeholder="Mật khẩu" name="password" type="password" value="">
    										</div>
    									</div>
    									<div class="form-group">
    										<input type="submit" class="btn btn-lg btn-primary btn-block" value="Đăng nhập">
    									</div>
    									<div class="login-help">
    										<a href="/{{ url('/admin/register') }}" >Đăng ký</a> - <a href="#" >Quên mật khẩu</a>
    									</div>
    								</div>
    							</div>
    						</fieldset>
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