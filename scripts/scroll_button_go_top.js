window.onscroll = function(ev) {
    var mybutton = document.getElementById("btnGoTop");
    
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        $("#btnGoTop").fadeIn("slow");
    } 
    else {
        $("#btnGoTop").fadeOut("slow");
    }
};

$(document).ready(function() {
    $('#btnGoTop').on('click', function() {
        $("html, body").animate( {
            scrollTop: 0
        }, 700);
    });
})