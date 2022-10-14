@extends('backend.dashboard')
<!-- datatables -->
	
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	@section('javascript')
		<script type="text/javascript" src="{{ asset('js/backend/category.js') }}"></script>
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
               if($char == "|---|---" ) {
                  echo '<option value="'.$items->id.'" disabled>'.$char.$items->category_nm.'</option>';
               } else {
                  echo '<option value="'.$items->id.'">'.$char.$items->category_nm.'</option>';
               }
                
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
            <h2 class="tile-title">QUẢN LÝ DANH MỤC</h2>
                <hr/>
                 <div class="tile">
                    <h3 class="tile-title">Thêm mới danh mục</h3>
                    <form action="{{url('/admin/danh-muc/luu-thong-tin')}}" method="post" name="category" id="btnSubmit" >
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="category_nm">Tên danh mục</label>
                      <input type="text" id="category_nm" name="category_nm" class="form-control" placeholder="Nhập tên danh mục" >
                    </div>

                     <div class="form-group">
                      <label for="parent_id">Thuộc danh mục</label>
                      <select class="form-control" id="parent_id" name="parent_id">
                        <option value="0">Tạo mới (Không thuộc danh mục nào)</option>
                        {{showCategories($categories)}}
                      </select>
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
    
    
 </div>
@stop