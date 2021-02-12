$(function(){
    if ($(window).width() < 768) {
        $(".box-1").click(function(){
        $('.seta').css('transform',"rotate(0deg)");
        $('.box-1 .texto').slideUp();
        if($(this).find('.texto').is(':hidden') == false){
            $(this).find('.texto').slideUp();
        }
        else{
         $(this).find('.texto').slideDown();
         $(this).find('.seta').css('transform',"rotate(-90deg)");
        }
        });
    }
 });