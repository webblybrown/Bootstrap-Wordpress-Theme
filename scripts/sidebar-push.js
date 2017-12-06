$('#nav-button').on('click', function() {
    $('#nav-button').toggleClass('opened');
    //setTimeout(function(){ 
        $('#outside-wrapper').toggleClass('menu-open');
    //}, 0);
    return false
});
$(document).on('click', '#outside-wrapper.menu-open #pusher', function() { 
    $('#outside-wrapper.menu-open').removeClass('menu-open');
    $('#nav-button').removeClass('opened');
    return false
});
