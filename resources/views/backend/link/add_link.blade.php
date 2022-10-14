@extends('backend.dashboard')
<!-- datatables -->
	
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	@section('javascript')
		<script type="text/javascript" src="{{ asset('js/backend/post.js') }}"></script>
	@stop
@section('content')

<div class="row fontText">
	<div class="col-md-12">
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
	</div>
	<div class="col-md-12">
      <div class="tile">
        <div class="table-responsive">
		<div class="col-md-12">
			<h2 class="tile-title">QUẢN LÝ LIÊN KẾT</h2>
      		<hr/>
		      <div class="tile">
		        <h3 class="tile-title">Thêm mới liên kết</h3>
		          	<form method="post" name="artice" action="{{url('/admin/lien-ket/luu-thong-tin')}}" enctype="multipart/form-data" id="btnSubmit">
		          		{{ csrf_field() }}

				 	  <div class="form-group">
					    <label for="content">URL</label>
					    <input type="text" id="url" class="form-control" name="url">
					  </div>

					  <div class="form-group">
					    <label for="author">Upload hình ảnh</label><br/>
					    <input type="file" class="" name="bookcover"/>
					  </div>

					  <input type="submit" class="btn btn-primary" value="Thêm">
					</form>
		       
		      </div>
		    </div>
	    </div>
      </div>
    </div>
    
    
 </div>
@stop
