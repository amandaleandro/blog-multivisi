$(function(){
  if ($(window).width() < 768) {
  $(".busca").click(function(){
    $(".pesquisa").css("width","160px");
    $(".busca").css("left","-30px");
    $(".pesquisa").css("padding","7px 0");
    $(".fechar").css("display","flex");
});
$(".fechar").click(function(){
    $(".busca").css("left","-49px");
    $(".pesquisa").css("width","0");
    $(".pesquisa").css("padding","0");
    $(".fechar").css("display","none");
});
  }
  if ($(window).width() > 768) {
  $(".busca").click(function(){
    $(".pesquisa").css("width","223px");
    $(".busca").css("left","-25px");
    $(".pesquisa").css("padding","10px 0");
    $(".fechar").css("display","flex");
});
$(".fechar").click(function(){
    $(".busca").css("left","166px");
    $(".pesquisa").css("width","0");
    $(".pesquisa").css("padding","0");
    $(".fechar").css("display","none");
});
}
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