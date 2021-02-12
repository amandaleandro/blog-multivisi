$(function(){
  var id = $('.codigo').text();
  var url = 'https://www.multivisi.com.br/web_api/products/'+id;
  console.log(id);

  $.ajax({
     type: 'get',
     url: url,
     success: function(Result){
        console.log(Result);
        $(".img-principal img").attr('src',Result.Product.ProductImage[0].https);
        for(var i = 0; i < 5; i++){
         $('.imgs-produto').append('<div class="item-img"><img src="'+Result.Product.ProductImage[i].https+'" width="100%" alt=""></div>')
        }
        init();
        $('.box-descricao p').html(Result.Product.description);
        $('.nome-produto').html(Result.Product.name);
        $('.mostra-video').attr('data-video',Result.Product.video);
     }

  });
  function number_format(price){
    return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(price);
}
  $(document).click(function(e){
    if(e.target.id == 'video' || e.target.id == '.poup-video'){
        $('.poup-video .video iframe').remove();
        $('.poup-video').hide();
    }
});
function init(){
      $('.imgs-produto').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 5,
        adaptiveHeight: true
      });
}

  $('.imgs-produto').on('click','.item-img',function(){
    var img  = $(this).find('img').attr('src');
    console.log(img);
    $('.img-principal img').attr('src',img);
  });

  $('.mostra-video').click(function(){
    var video = $(this).data('video');
    $('.poup-video').css('display','flex');
    $('.poup-video .video').html('<iframe width="100%" height="315" src="'+video+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
    });
    $(".fecha,.poup-video").click(function(){
      $(".poup-video").css('display','none');
      $('.poup-video .video iframe').remove();
      }); 
});