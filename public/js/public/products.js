$(function(){
  // Variables
  var selectItem = $('.menus div'),
      item       = $('.ic_card_products > div'),
      iframe;

  selectItem.click(function(event){
      // Get the id item clicked
      var id = event.target.id;

      $.ajax({
          type: "post",
          url: "/src/controller/Api.class.php",
          dataType: "json",
          data: {
              jController: 'admin-panel',
              admAction: 'product',
              action: 'consultinhcategory',
              id
          },
          success: function(e){
              item.html('');
              e.forEach(element => {
                  var img = element[0].product_cover.split(',');
                  item.append('<div class="card"><img src="/public/img/upload/'+img[2]+'"><h3>'+element[0].product_name+'</h3><a href="/products/'+element[0].product_url+'">Vem ver</a></div>');
              });
          }
      }); 
  });


  $('.btn_play').click(function(){
      iframe = $(this).data('video');
      var n = iframe.split(',');
      $('.framevideo').css('display', 'flex');
      $('.showvideo').html('').append('<iframe width="800" height="500" src="https://www.youtube.com/embed/'+n[0]+'?autoplay=1&controls=1&rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>').append('<div class="more"></div>');
      n.forEach(codv => {
          $('.more').append('<div data-vd="'+codv+'"><img src="https://img.youtube.com/vi/'+codv+'/maxresdefault.jpg"/></div>');
      });

      $('.more div').click(function(){
          var cod = $(this).data('vd');
          $('.showvideo iframe').attr('src', 'https://www.youtube.com/embed/'+cod+'?autoplay=1&rel=0&controls=1');
      });
  });

  

  $(document).click(function(e){
      if(e.target.id == 'shw'){
          $('.framevideo').css('display', 'none');
          $('.showvideo').html('');
      }
  });
  if ($(window).width() < 768) {
  $('.menus').slick({
    infinite: false,
    arrows:false,
    slidesToShow: 2,
    slidesToScroll: 1
  });
  }
});