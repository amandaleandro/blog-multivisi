$(function(){
    // hide arrow
    var DROP = $('.drop'),
    DROPP = $('.dropp');
    $('[data-toggle="tooltip"]').tooltip();
    DROP.click(function(){

        var tis =  $(this).find('i');

        $('.linksmenu').collapse('hide');
        $('.linkssub').collapse('hide');

        DROP.find('i').css({'transform': 'rotate(0deg)' });
        DROPP.find('i').css({'transform': 'rotate(0deg)'});
            
        if($(this).parent().find('.collapse').is(':hidden') == true){
            tis.css({ 'transform': 'rotate(90deg)' });
        }     

        DROPP.click(function(){
            DROPP.find('i').css({'transform': 'rotate(0deg)'});
            if($(this).parent().find('.collapse').is(':hidden') == true){
                $(this).find('i').css({ 'transform': 'rotate(90deg)' });
            }
        });
    });

  
});