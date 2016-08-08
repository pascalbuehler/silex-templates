$(document).ready(function(){
    $('.product').hover(function() {
        $('.img-responsive', this).addClass('img-hover-transition');
    
    }, function() {
        $('.img-responsive', this).removeClass('img-hover-transition');
    });
});