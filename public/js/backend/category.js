
$(document).ready(function(){
    $(document).on('click','#btnSave', function(){ 
        let result = 0;
        $("form[name='category'] .form-group input").each(function(){
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

});


