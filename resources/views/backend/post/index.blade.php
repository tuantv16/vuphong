@extends('backend.dashboard')
<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	
	<script type="text/javascript" src="{{ asset('js/backend/main_post.js') }}"></script>

	<script>
      $(document).ready(function() {
          $('#post').DataTable();

      });
    </script>
@section('content')
<script>
    CKEDITOR.replace( 'content', {
	  	fullPage: true,
		extraPlugins: 'font,panelbutton,colorbutton,colordialog,justify,indentblock,aparat,buyLink',
		allowedContent: true,
		autoGrow_onStartup: true,
		enterMode: CKEDITOR.ENTER_BR,

      	filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
      	filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
      	filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
      	filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
      	filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
      	filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'

      });
</script>

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
      	<h2 class="tile-title">QUẢN LÝ BÀI VIẾT</h2>
      	<hr/>
        <h3 class="tile-title">Hiển thị danh sách bài viết</h3>
        <a id="add_new" class="btn btn-primary col-md-2 col-12" href="{{ asset("admin/bai-viet/them-moi") }}" style="margin-bottom: 10px">Thêm mới</a>
        <div class="table-responsive">
	        <table id="post" class="table" width="100%" cellspacing="0">
	        	<thead>
		            <tr>
		                <th style="min-width: 100px">Tên bài viết</th>
						<th>Nội dung</th>
						<th style="min-width: 100px">Tác giả</th>
						<th style="min-width: 100px">Hình ảnh đại diện</th>
						<th style="min-width: 100px">Danh mục (tự tạo)</th>
						<th style="min-width: 100px">Danh mục (cố định)</th>
						<th>Slug</th>
						<th style="min-width: 100px">Người tạo</th>
						<th style="min-width: 100px">Thời gian tạo</th>
						<th style="min-width: 100px">Người sửa</th>
						<th style="min-width: 100px">Ngày sửa</th>
						<th style="min-width: 120px">Chức năng</th>
		            </tr>
		        </thead>
		        <tbody>  
		            @if(isset($data_post))
				 		@foreach($data_post as $row)
				 			<?php $imageExists = asset("uploads/$row->filename") ?>
				 			<?php $imageNotExists = asset("uploads/noimage/noimage.png")?>
		         			<tr>		 
						 		<td>{{$row->title}}</td>
							 	<td>
								 <?php 
									 $content = getplaintextintrofromhtml($row->content);
									 echo _cutTect($content,30);
								 ?>
								
								 </td>
							 	<td>{{$row->author}}</td>
							 	<td style="text-align:center">
									<?php 
									if ($row->filename !='') {
										echo '<img src="'.$imageExists.'" height="40px" width="70px" />';
									} else {
										echo '<img src="'.$imageNotExists.'" height="40px" width="70px" />';
									}
									?>
							 	</td>
							 	<td>{{$row->category_nm}}</td>
							 	<td>{{cat_fixed($row->featured_article)}}</td>
							 	<td>{{$row->slug}}</td>
							 	<td>{{$row->register}}</td>
							 	<td>{{$row->register_date}}</td>
							 	<td>{{$row->updater}}</td>
							 	<td>{{$row->updater_date}}</td>
							 	<td class="function">
							 		<a id="btn_update" class="btn btn-primary" href="{{ asset("admin/bai-viet/cap-nhat/$row->id") }}" >Sửa</a> 
							 		<a id="btn_delete" class="btn btn-danger btn-del" item_id="{{$row->id}}" >Xóa</a>
							 	</td>
			         		</tr>
		 				@endforeach
				 	@endif
		        </tbody>
		        <tfoot>
		            <tr>
		                <th>Tên bài viết</th>
						<th>Nội dung</th>
						<th>Tác giả</th>
						<th>Hình ảnh đại diện</th>
						<th>Danh mục (tự tạo)</th>
						<th>Danh mục (cố định)</th>
						<th>Slug</th>
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
