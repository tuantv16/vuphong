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
            	$selected = ($items->id == $items->value_check_selected)?'selected':'';
                echo '<option value="'.$items->id.'" '.$selected.'>'.$char.$items->category_nm.'</option>';
                unset($categories[$key]);
                showCategories($categories, $items->id, $char.'|---');
            }
        }
    }
?>

<div class="row fontText">
	<div class="col-md-12">
      <div class="tile">
        <div class="table-responsive">
		<div class="col-md-12">
			<h2 class="tile-title">QUẢN LÝ BÀI VIẾT</h2>
      		<hr/>
		      <div class="tile">
		        <h3 class="tile-title">Cập nhật bài viết</h3>
		          	<form method="post" name="artice" action="{{url('/admin/bai-viet/luu-cap-nhat/'.$upd_post->id.'')}}" enctype="multipart/form-data" id="btnSubmit">
		          		{{ csrf_field() }}
					  <div class="form-group">
					    <label for="title">Tên bài viết</label>
					    <input type="text" id="title" class="form-control" name="title" value="{{$upd_post->title}}" placeholder="Nhập tên danh mục" >
					  </div>

					   <div class="form-group">
					    <label for="parent_id">Thuộc danh mục</label>
					    <select class="form-control" id="category_id" name="category_id">
					      <option value="0">Tạo mới (Không thuộc danh mục nào)</option>
					      {{showCategories($categories)}}
					    </select>
					  </div>

					  <div class="form-group">
					    <label for="author">Upload hình ảnh</label><br/>
					    <input type="file" class="" name="bookcover"/><br/><br/>
			 			<?php 
			 				$imageExists = asset("uploads/$upd_post->filename");
			 				$imageNotExists = asset("uploads/noimage/noimage.png");
							if ($upd_post->filename !='') {
								echo '<img src="'.$imageExists.'" height="140px" width="170px" />';
							} else {
								echo '<img src="'.$imageNotExists.'" height="140px" width="170px" />';
							}
						?>
					  </div>

		 			  <div class="form-group">
					    <label for="content">Nội dung bài viết</label>
						<textarea id="content" name="content" rows="7" class="form-control ckeditor" placeholder="Write your message..">
						{{$upd_post->content}}
						</textarea>
					  </div>

					  <div class="form-group">
					    <label for="content">Tên tác giả</label>
					    <input type="text" id="author" class="form-control" name="author" value="{{$upd_post->author}}">
					  </div>

					  <div class="form-group">
					    <label for="pwd">Slug</label>
					    <input type="text" id="slug" name="slug" class="form-control" value="{{$upd_post->slug}}" placeholder="Nhập tên danh mục dưới dạng 'ten-danh-muc', (tên không dấu và cách nhau bởi dấu - )" >
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
