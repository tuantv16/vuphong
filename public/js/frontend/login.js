$(document).ready(function(){
    const params = new URLSearchParams(window.location.search);
    if (params == 'register=') {
        $(".show-register").css('display','block');
    }

    $(document).on('click','#btn-register', function() {
        $(".show-register").css('display','block');
        //alert(111116666);
    });

});