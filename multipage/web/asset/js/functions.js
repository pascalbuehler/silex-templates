$(document).ready(function(){
    $('.img-responsive').hover(function() {
        $(this).addClass('transition');
    
    }, function() {
        $(this).removeClass('transition');
    });
});