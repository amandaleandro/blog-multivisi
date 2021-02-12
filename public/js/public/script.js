$(function(){
  $(".card").hover(function(){
    if($(this).find('.card-img-top').hasClass("efeito")== false){
        $(this).find('.card-img-top').addClass("efeito");
        $(this).find('.botao').css('z-index',"2");
    }
    else{
        $(this).find('.card-img-top').removeClass("efeito");
        $(this).find('.botao').css('z-index',"-1");
      }
});
});