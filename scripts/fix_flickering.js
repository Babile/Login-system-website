//Check is tags a that dont contain "_blank", and buttons are clicked
$(document).ready(function() {
    $("a[target!='_blank'], #register_btn, #password_recovery_btn, #logout_btn, #reset_password_btn, #login_btn").on('click', function(event) {
        if($(event.target).is('#register_btn')) {
            temp = checkInputs();
            if(!temp){
                return;
            }
            else{
               run();
            }
        }
        else if($(event.target).is('#password_recovery_btn')) {
            temp = checkInputs();
            if(!temp){
                return;
            }
            else{
               run();
            }
        }
        else if($(event.target).is('#reset_password_btn')) {
            temp = checkInputs();
            if(!temp){
                return;
            }
            else{
               run(); 
            }
        }
        else if($(event.target).is('#login_btn')) {
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

//Check for input tag 
function checkInputs() {
    $('input').each(function() {
      if($(this).val().length === 0) {
          return false;
      }
    });
}

//Make animation of fadein to fadeout
function run(){
    $(".content-page-load-fadein").addClass('content-page-load-fadeout').removeClass('content-page-load-fadein');
        setTimeout(function(){
        $(".content-page-load-fadeout").hide();
    }, 500);
    event.stopPropagation();
}