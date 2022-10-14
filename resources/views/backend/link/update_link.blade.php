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
      <div class="tile">
        <div class="table-responsive">
		<div class="col-md-12">
			<h2 class="tile-title">QUẢN LÝ LIÊN KẾT</h2>
      		<hr/>
		      <div class="tile">
		        <h3 class="tile-title">Cập nhật liên kết</h3>
		          	<form method="post" name="artice" action="{{url('/admin/lien-ket/luu-cap-nhat/'.$upd_link->id.'')}}" enctype="multipart/form-data" id="btnSubmit">
		          		{{ csrf_field() }}
					  <div class="form-group">
					    <label for="title">URL</label>
					    <input type="text" id="url" class="form-control" name="url" value="{{$upd_link->url}}" placeholder="Nhập link url" >
					  </div>

					  <div class="form-group">
					    <label for="author">Upload hình ảnh</label><br/>
					    <input type="file" class="" name="bookcover"/><br/><br/>
			 			<?php 
			 				$imageExists = asset("uploads/$upd_link->filename");
			 				$imageNotExists = asset("uploads/noimage/noimage.png");
							if ($upd_link->filename !='') {
								echo '<img src="'.$imageExists.'" height="140px" width="170px" />';
							} else {
								echo '<img src="'.$imageNotExists.'" height="140px" width="170px" />';
							}
						?>
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
