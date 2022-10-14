
$(document).ready(function(){
	$(document).on('click','#btnSave', function(){ 
		let result = 0;
		let exsist_image = $("#upload_image").val();
		let exsist_category = $("#check_category").val();
		if (exsist_image == '') {
			alert('Bạn chưa đăng tải hình ảnh');
			result++;
		}

		if (exsist_category == '') {
			alert('Bạn chưa lựa chọn danh mục');
			result++;
		}

	    $("form[name='artice'] .form-group input[type!=file]").each(function(){
	        let input = $(this).val();
	        if (input == '') {
	        	 result++;
	        	$(this).css("border","1px solid red");
	        	let label = $(this).prev().text();
	        	let message = '<p class="error">'+label+' không được để trống.</p>';
	        	$(this).prev().after(message);
	        }
	    });

	    if (result == 0) {
			$("#btnSubmit").submit();
		}

     });

	$("#cat_auto").css("display","none");
	$("#cat_fix").css("display","none");
	$(document).on('click','#btn-auto', function(){
		$("#btn-auto").hide();
		$("#btn-fix").show();
		$("#cat_auto").show(500);
		$("#cat_fix").fadeOut(500);
		$("#category_id option[value=0]").attr("selected",true);
		$("#check_category").val('fix');
	});	

	$(document).on('click','#btn-fix', function(){
		$("#btn-fix").hide();
		$("#btn-auto").show();
		$("#cat_fix").show(500);
		$("#cat_auto").fadeOut(500);
		$("#featured_article option[value=0]").attr("selected",true);
		$("#check_category").val('auto');
	});	
	

});


