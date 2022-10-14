@extends('backend.dashboard')
<!-- datatables -->
	
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	@section('javascript')
		<script type="text/javascript" src="{{ asset('js/backend/post.js') }}"></script>
	@stop
@section('content')
<script>

        CKEDITOR.replace( 'content', {
    	  enterMode : CKEDITOR.ENTER_BR,
          filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
          filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
          filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
          filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
          filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
          filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
          });
</script>
<?php 
	function showCategories($categories, $parent_id = 0, $char = '')
    {
        foreach ($categories as $key => $items) 
        {
            if ($items->parent_id == $parent_id) 
            {
                echo '<option value="'.$items->id.'">'.$char.$items->category_nm.'</option>';
                unset($categories[$key]);
                showCategories($categories, $items->id, $char.'|---');
            }

        }
    }
?>
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
			<h2 class="tile-title">QUẢN LÝ BÀI VIẾT</h2>
      		<hr/>
		      <div class="tile">
		        <h3 class="tile-title">Thêm mới bài viết</h3>
		          	<form method="post" name="artice" action="{{url('/admin/bai-viet/luu-thong-tin')}}" enctype="multipart/form-data" id="btnSubmit">
		          		{{ csrf_field() }}
					  <div class="form-group">
					    <label for="title">Tên bài viết</label>
					    <input type="text" id="title" class="form-control" name="title" placeholder="Nhập tên danh mục" >
					  </div>

					  <button type="button" class="btn btn-warning" id="btn-auto">Lựa chọn danh mục (tự tạo)</button>
					  <button type="button" class="btn btn-info" id="btn-fix">Lựa chọn danh mục (cố định)</button>

					  <div class="form-group" id="cat_auto">
					    <label for="parent_id">Thuộc danh mục (tự tạo)</label>
					    <select class="form-control" id="category_id" name="category_id">
					      <option value="0">Tạo mới (Không thuộc danh mục nào)</option>
					      {{showCategories($categories)}}
					    </select>
					  </div>
						
					  <div class="form-group" id="cat_fix">
					    <label for="featured_article">Thuộc danh mục (cố định)</label>
					    <select class="form-control" id="featured_article" name="featured_article">
					      <option value="0"></option>
					      <option value="1">Bài viết nổi bật</option>
					      <option value="2">Thông báo toàn trường</option>
					      <option value="3">Kế hoạch của trường</option>
						  <option value="4">Thông tin chung</option>
						  <option value="5">Kết quả điểm thi các kỳ</option>
						  <option value="6">Tuyển sinh</option>
						  <option value="7">Thời khóa biểu</option>
						  <option value="8">Tài liệu môn học</option>
						  <option value="9">Thành tích</option>
						  <option value="10">Kết quả đạt được</option>
						  <option value="11">Học sinh tiêu biểu</option>
						  <option value="12">Báo đài</option>
					    </select>
					  </div>
					  <input type="hidden" id="check_category" name="check_category" value=""/>
					  <div class="form-group">
					    <label for="author">Upload hình ảnh</label><br/>
					    <input type="file" class="" name="bookcover" id="upload_image" />
					  </div>

		 			  <div class="form-group">
					    <label for="content">Nội dung bài viết</label>
						<textarea id="content" name="content" rows="7" class="form-control ckeditor" placeholder="Write your message..">
						</textarea>
					  </div>

					  <div class="form-group">
					    <label for="content">Giá tiền</label>
					    <input type="number" id="monney" class="form-control" name="monney">
					  </div>

					  <div class="form-group">
					    <label for="content">Tên tác giả</label>
					    <input type="text" id="author" class="form-control" name="author">
					  </div>

					  <div class="form-group">
					    <label for="pwd">Slug</label>
					    <input type="text" id="slug" name="slug" class="form-control" placeholder="Nhập tên danh mục dưới dạng 'ten-danh-muc', (tên không dấu và cách nhau bởi dấu - )" >
					  </div>

					  <input type="button" id="btnSave" name="btnSave" class="btn btn-primary" value="Thêm">
					</form>
		       
		      </div>
		    </div>
	    </div>
      </div>
    </div>
    
    
 </div>
@stop
