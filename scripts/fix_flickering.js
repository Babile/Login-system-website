$(document).ready(function() {
    $("a[target!='_blank'], #register_btn, #password_recovery_btn, #logout_btn, #reset_password_btn, #login_btn").on('click', function(event) {
        if ($(event.target).is('#register_btn')) {
            temp = checkInputs();
            if(!temp){
                return;
            }
            else{
               run();
            }
        }
        else if ($(event.target).is('#password_recovery_btn')) {
            temp = checkInputs();
            if(!temp){
                return;
            }
            else{
               run();
            }
        }
        else if ($(event.target).is('#reset_password_btn')) {
            temp = checkInputs();
            if(!temp){
                return;
            }
            else{
               run(); 
            }
        }
        else if ($(event.target).is('#login_btn')) {
            temp = checkInputs();
            if(!temp){
                return;
            }
            else{
               run(); 
            }
        }
        else{
            run();
        }
    });
});

function checkInputs() {
    $('input').each(function() {
      if($(this).val().length === 0) {
          return false;
      }
    });
}

function run(){
    $(".content-page-load").addClass('content-page-load2').removeClass('content-page-load');
        setTimeout(function(){
        $(".content-page-load2").hide();
    }, 500);
    event.stopPropagation();
}