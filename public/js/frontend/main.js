
$(document).ready(function() {

    $(".nav li").each(function() {
        let _this = $(this);
        var li_parent = _this.attr("id");
        let dropdown = _this.hasClass("dropdown");
        
        //menu level 2
        if(dropdown !== false) {
            let str_child_id = $(this).attr("child-id");
            let child_id = str_child_id.substring(0, str_child_id.indexOf('-'));
            let child_id_clone = $(this).parent('.border-item-1').html();

            if($(".nav li[id="+child_id+"]").find('ul').length == 0) {
                $(".nav li[id="+child_id+"]").append('<ul class="dropdown-menu">');
                    $(".nav li[id="+child_id+"] ul").append(child_id_clone);
                $(".nav li[id="+child_id+"]").append('</ul>');
            } else {
                $(".nav li[id="+child_id+"] ul").append(child_id_clone);
            }
            $(this).parent('.border-item-1').remove();
        }
     });

     $('li.dropdown').removeClass('dropdown').addClass('dropdown-submenu');
     $(".border-item-2 li").each(function() {
         //menu lever 3
        let _this = $(this);
        let dropdown_submenu = _this.hasClass("dropdown-submenu");
        if(dropdown_submenu !== false) {
            let str_children_child_id = $(this).attr("children-child-id");
            if (typeof(str_children_child_id) != "undefined") {
                
                let children_child_id = str_children_child_id.substring(0,str_children_child_id.indexOf('|'));
                let children_child_id_clone = $(this).parent('.border-item-2').html();
               
                if($(".dropdown-submenu[child="+children_child_id+"]").find('ul').length == 0) {
                    $(".dropdown-submenu[child="+children_child_id+"]").append('<ul class="dropdown-menu">');
                        $(".dropdown-submenu[child="+children_child_id+"] ul").append(children_child_id_clone);
                    $(".dropdown-submenu[child="+children_child_id+"]").append('</ul>');
                } else {
                    $(".dropdown-submenu[child="+children_child_id+"] ul").append(children_child_id_clone);
                }
                $(".dropdown-submenu[child="+children_child_id+"] ul li").removeClass('dropdown-submenu');
            } //end typeof
            $(this).parent('.border-item-2').remove();
        }
     });  
     
   $(".nav li").each(function() {
        var _this = $(this);
        $('ul.dropdown-menu li').removeClass('dropdown');
        // debugger;
        if(_this.find('ul.dropdown-menu').length != 0) {
            _this.addClass('dropdown');
            $('li.dropdown').find('a:first').attr('class','dropdown-toggle').attr('data-toggle','dropdown').append('<b class="caret" style="margin-left:5px"></b>');
        }
        $('ul.dropdown-menu li').removeClass('dropdown');
        $('ul.dropdown-menu').find('a').removeAttr('class').removeAttr('data-toggle');
        $('ul.dropdown-menu').find('a').find('b').remove();
        $('li.dropdown').find('a:first b:gt(0)').remove();
        
    });

   $(".nav li").each(function() {
        var _this = $(this);
        if(_this.hasClass('dropdown-submenu') != false) {
            if(_this.find('ul.dropdown-menu').length != 0) {
                _this.find('a:first').append('<b class="caret" style="margin-left:5px"></b>')
            }
        }
    });

    // if($('.dropdown-submenu').find('ul.dropdown-menu').length != 0) {

    // }

});
