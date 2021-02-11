//Animate dropdown menu of user profil and prevent closing if button Profile is not clicked
$(document).ready(function(){
    $('.dropdown-menu.dropdown-menu-right').on('click', function(e) {
        e.stopPropagation();
    });

    $("#login_btn_dropdown_list").on('click', function(){
      $("#dropdown-list").animate({
        height: 'toggle'
      });
    });
});