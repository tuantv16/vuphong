@extends('backend.dashboard')
<!-- datatables -->	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
@section('content')

<div class="row fontText">
	<div class="col-md-12 flash-message">
           @foreach (['danger', 'warning', 'success', 'info'] as $msg)
               @if(Session::has('alert-' . $msg))
                   <p class="alert alert-{{ $msg }}" style="color: green">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
               @endif
           @endforeach
    </div> <!-- end .flash-message -->
	<div class="col-md-12">
      <div class="tile">
        <div class="table-responsive">
		<div class="col-md-12">
			<h2 class="tile-title">QUẢN LÝ VIDEO</h2>
      		<hr/>
		      <div class="tile">
		        <h3 class="tile-title">Cập nhật video</h3>
		          	<form method="post" name="video" action="{{url('/admin/video/luu-cap-nhat/'.$upd_video->id.'')}}">
		          		{{ csrf_field() }}
					  <div class="form-group">
					    <label for="title" style="color:red">Link URL (Link được lấy từ Youtube bằng cách tìm kiếm video tải lên và click Share/Embeb, copy link)</label>
					    <input type="text" id="url" class="form-control" name="url" value="{{$upd_video->url}}" placeholder="Nhập tên danh mục" >
					  </div>			
					  <input type="submit" class="btn btn-primary" value="Cập nhật">
					</form>
		       
		      </div>
		    </div>
	    </div>
      </div>
    </div>
    
    
 </div>
@stop
