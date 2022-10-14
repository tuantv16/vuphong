@extends('backend.dashboard')

	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<style>
		.parent0 {
			color: red
		}
	</style>
	<script type="text/javascript" src="{{ asset('js/backend/main_category.js') }}"></script>
	<script>
      $(document).ready(function() {
          $('#category').DataTable();
      });
    </script>
	
@section('content')

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

	function showCategoriesTable($categories, $parent_id = 0, $char = '')
    {
        foreach ($categories as $key => $items) 
        {
            if ($items->parent_id == $parent_id) 
            {
				echo '<tr>';
					echo '<td>';
						echo ($items->parent_id == 0)?("<b class='parent0'>".$char.$items->category_nm."</b>"):($char.$items->category_nm);
					echo '</td>';
					echo '<td>';
						echo $items->slug;
					echo '</td>';
					echo '<td>';
						echo $items->register;
					echo '</td>';
					echo '<td>';
						echo $items->register_date;
					echo '</td>';
					echo '<td>';
						echo $items->updater;
					echo '</td>';
					echo '<td>';
						echo $items->updater_date;
					echo '</td>';
					echo '<td class="text-center"> ';
						?> <a id="btn_update" style="margin-right:3px" class="btn btn-primary" href="{{ asset("admin/danh-muc/cap-nhat/$items->id") }}" >Sửa</a><?php
						echo '<a id="btn_delete" class="btn btn-danger btn-del" item_id="'.$items->id.'" >Xóa</a>';
					echo '</td>';
				echo '</tr>';
			
                unset($categories[$key]);
                showCategoriesTable($categories, $items->id, $char.'|---');
            }

        }
	}
	
?>

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
			<h3 class="tile-title">Quản lý danh mục</h3>
		</div>
	</div>
	<div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Hiển thị danh sách danh mục</h3>
         <a id="add_new" class="btn btn-primary col-md-2 col-12" href="{{ asset("admin/danh-muc/them-moi") }}" style="margin-bottom: 10px">Thêm mới</a>
		<!-- <a id="add_new" class="btn btn-primary col-md-6" href="{{ asset("admin/danh-muc/them-moi") }}">Thêm mới</a> -->
		
		<table border="1" cellspacing="0" cellpadding="5">
			<tr class="text-center">
				<td><strong>Tên danh mục</strong></td>
				<td><strong>Slug</strong></td>
				<td><strong>Người tạo</strong></td>
				<td><strong>Thời gian tạo</strong></td>
				<td><strong>Người sửa đổi</strong></td>
				<td><strong>Ngày sửa đổi</strong></td>
				<td style="min-width:150px"><strong>Chức năng</strong></td>
			</tr>
			<?php showCategoriesTable($categories); ?>
		</table>

        
      </div>
    </div>
   
    
 </div>
@stop
