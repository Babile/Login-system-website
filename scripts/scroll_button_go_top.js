window.onscroll = function(ev) {
    var mybutton = document.getElementById("btnGoTop");
    
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
    } 
    else {
        mybutton.style.display = "none";
    }
};

$(document).ready(function() {
    $('#btnGoTop').on('click', function() {
        $("html, body").animate( {
            scrollTop: 0
        }, 700);
    });
})