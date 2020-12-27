$(document).ready(function(){
    $('.dropdown-menu.dropdown-menu-right').on('click', function(e) {
        e.stopPropagation();
    });
});

$(document).ready(function(){
    $("#login_btn_dropdown_list").on('click', function(){
      $("#dropdown-list").animate({
        height: 'toggle'
      });
    });
});
