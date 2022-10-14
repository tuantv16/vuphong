
$(document).ready(function(){

	$(document).on('click','.btn-del', function(e){ 
		e.preventDefault() 
		let id = $(this).attr("item_id");
		MessageBoxConfirm("Bạn có chắc chắn muốn xóa không?").done(function(){
			delRow(id);
		});
	});

	
});

function MessageBoxConfirm(message){
    return $.MessageBox({
        buttonDone  : "Yes",
        buttonFail  : "No",
        message     : message
    });
}
	

function delRow(id) {
	data = {};
	data.id = id;
	$.ajax({
        url: '/admin/bai-viet/xoa/'+id,
        type: 'GET',
        dataType: 'json',
        data: data
    }).done(function(res) {
    	if (res.status == 'OK') {
    		location.href= "/admin/bai-viet";
    	}   
    });
}
