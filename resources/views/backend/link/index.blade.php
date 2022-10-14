@extends('backend.dashboard')
<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-message-box@3.2.1/dist/messagebox.min.css">
	
	<script>
      $(document).ready(function() {
          $('#post').DataTable();
      });
    </script>
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
      	<h2 class="tile-title">QUẢN LÝ LIÊN KẾT</h2>
      	<hr/>
        <h3 class="tile-title">Hiển thị danh sách liên kết</h3>
        <a id="add_new" class="btn btn-primary col-md-2 col-12" href="{{ asset("admin/lien-ket/them-moi") }}" style="margin-bottom: 10px">Thêm mới</a>
        <div class="table-responsive">
	        <table id="post" class="table" width="100%" cellspacing="0">
	        	<thead>
		            <tr>
						<th style="min-width: 100px">URL</th>
						<th style="min-width: 100px">Hình ảnh đại diện</th>
						<th style="min-width: 100px">Người tạo</th>
						<th style="min-width: 100px">Thời gian tạo</th>
						<th style="min-width: 100px">Người sửa</th>
						<th style="min-width: 100px">Ngày sửa</th>
						<th style="min-width: 120px">Chức năng</th>
		            </tr>
		        </thead>
		        <tbody>
		            @if(isset($data_link))
				 		@foreach($data_link as $row)
				 			<?php $imageExists = asset("uploads/$row->filename") ?>
				 			<?php $imageNotExists = asset("uploads/noimage/noimage.png")?>
		         			<tr>		 
						 		<td>{{$row->url}}</td>
							 	<td style="text-align:center">
									<?php 
									if ($row->filename !='') {
										echo '<img src="'.$imageExists.'" height="40px" width="70px" />';
									} else {
										echo '<img src="'.$imageNotExists.'" height="40px" width="70px" />';
									}
									?>
							 	</td>
							 	<td>{{$row->register}}</td>
							 	<td>{{$row->register_date}}</td>
							 	<td>{{$row->updater}}</td>
							 	<td>{{$row->updater_date}}</td>
							 	<td class="function">
							 		<a id="btn_update" class="btn btn-primary" href="{{ asset("admin/lien-ket/cap-nhat/$row->id") }}" >Sửa</a>
							 		<a id="btn_delete" class="btn btn-danger btn-del" href="{{ asset("admin/lien-ket/xoa/$row->id") }}" >Xóa</a>
							 	</td>
			         		</tr>
		 				@endforeach
				 	@endif
		        </tbody>
		        <tfoot>
		            <tr>
						<th>URL</th>
						<th>Hình ảnh đại diện</th>
						<th>Người tạo</th>
						<th>Thời gian tạo</th>
						<th>Người sửa đổi</th>
						<th>Ngày sửa đổi</th>
						<th>Chức năng</th>
		            </tr>
		        </tfoot>
		    </table>
	    </div>
      </div>
    </div>
    
    
 </div>
@stop
