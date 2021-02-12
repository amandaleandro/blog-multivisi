$(function(){
    if ($(window).width() < 768) {
    $(".menu").click(function(){
        $(".menu-mobile").css('display','flex');
    });
    $(".fechar,#fecha").click(function(){
        $(".menu-mobile").css('display','none');
    }); 
}
    $(".nav-item").hover(function(){
        $(".nav-item .barra").hasClass('borda');
        if( $(".nav-item .barra").hasClass('borda') === true){
            $(this).find('.barra').removeClass('borda');
        }
        else{
            $(this).find('.barra').addClass('borda');
        }
    });
    $('#busca img').click(function(){
        let valor = $(this).parents('form').find('input').val();
       location.href='/busca/busca?p='+valor;
   });

   $('#pesquisa').keydown(function(e){
       let valor = $(this).val()
       if(e.key == "Enter"){
           location.href='/busca?p='+valor;
           return false;
       }

   });

});