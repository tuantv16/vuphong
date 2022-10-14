$(document).ready(function(){
	$(".app-menu li a").removeClass("active");
	$(document).on('click','.app-menu li',function() {
		$(".app-menu li a").removeClass("active_event");
		setTimeout(function(){
		   $(this).find("a").addClass("active_event");	
		}, 1000);
	});
});