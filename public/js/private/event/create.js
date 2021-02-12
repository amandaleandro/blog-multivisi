$(function(){
    var file = $('.event_photos');
    var form = $('#form_event');
    var checkbranch = 0;
   
    

    


    // change the cover
    $('#cover').change(function(){  $('.coveimg img').attr('src', URL.createObjectURL(this.files[0]));  });

    $('.listcategory').on('change', '.event_photos', function(){
       var img = $(this)[0].files[0];
       $(this).parents('.media').find('img').attr('src', URL.createObjectURL(img));
       $(this).parent().find('.adphot').remove();

    });

    $('.addphoto').click(function(){
        var $tag = `
        <li class="list-group-item border-light" data-url="" style="font-size: 13px">
        <div class="custom-control custom-checkbox">
            <div class="media align-items-center">
                <img src="" class="mr-3 w-25" >
                    <div class="media-body text-right">
                        <label>
                            <input type="file" name="event_photos[]" id="" class="event_photos d-none">
                            <i class="fad fa-camera-retro text-primary adphot" style="font-size: 20px"></i>
                            
                        </label>
                        <i class="fad fa-window-close text-danger xpho" style="font-size: 20px;"></i>
                    </div>
            </div>
        </div>
    </li>`;

        $('.listcategory').prepend($tag);
    });


    $('.listcategory').on('click', '.xpho', function(){
        $(this).parents('li').remove();
       //removeLi($(this).parents('.listcategory'));
    });


      // add and remove link youtube
      $('.ybtinput i').click(function(){
        var length = $(this).parent().find('input').val().length;
        
        if(length <= 0){
            $('.txterror').removeClass('d-none');
        }else{
            $('.txterror').addClass('d-none');
            $('.youtubelist').prepend(`
                <li class="list list-group-item d-flex justify-content-between align-items-center border-light" data-url='${$(this).parent().find('input').val()}'>
                    <small><i>${$(this).parent().find('input').val()}</i></small>
                    <i class="fas fa-minus-square text-danger delety"></i>
                </li>
            `);
            $(this).parent().find('input').val('');
        }
    });

    $('.youtubelist').on('click', '.delety', function(){ $(this).parent().remove(); });

    if($('.checkbranch').is(':checked')){
        $('.addphoto').show();
    }
    $('.checkbranch').click(function(){
        if($(this).is(':checked')){
            checkbranch = 1;
            
            $('.addphoto').show();
        }else{
            checkbranch;
            $('.addphoto').hide();
           removeLi($('.listcategory'));
        }
    });

    form.submit(function(){
        var listTag = cutString($('.youtubelist li'));
        var phts = cutString($('.lisphot li'));

        var data = {jController: "admin-panel", admAction: "event", event_tag: listTag, event_branch: checkbranch, event_photos: phts}
                
        $(this).ajaxSubmit({
            type: "post",
            url: "/src/controller/Api.class.php",
            data,
            dataType: "json",
            success: function(rest) {
                if(rest[1] == 'accept'){
                    location.href = '?page=event';
                }
            }
        });
        return false;
    });

    function removeLi(tag){
        tag.find('li').remove();
    }

    var tag;
    $('#form_search input').keyup(function(){
        var value = $(this).val();

        $('tbody tr').filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('tbody').on('click', 'tr .trash', function(){
        $('.btnyes').data({id: $(this).data('id')});
        $('.nameprod').html($(this).data('name'));
        tag = $(this).parents('tr');
    });

    $('.btnyes').click(function(){
       var id = $(this).data('id');

       $.ajax({
           data: 'jController=admin-panel&admAction=event&action=delete_event&event_id='+id,
           beforeSend: function(){
               tag.remove();
           },
           success: function(rest){
               console.log(rest);
               $('.modal').modal('hide');
           }
       });
    });


    //Pagination
  $(".pag").on("click", ".page-link", function() {
    var data = {jController: "admin-panel", admAction: "event", action: "paginate", num: $(this).data("page") };

    $.ajax({
      data,
      success: function(e) {
        Pagination(e["reg"]);

        if (e["reg_total"] > e["limit"]) {
          var n = "";
          $(".pag ul").html("");
          n += '<li class="page-item shadow-sm"><a class="page-link border-0" href="#" tabindex="-1" aria-disabled="true" data-page="1"><small>Primeiro</small></a></li>';

          for ( var i = e["page_active"] - e["max_links"]; i <= e["page_active"] - 1; i++) {
            if (i >= 1) {
              n +=`<li class="page-item shadow-sm"><a class="page-link border-0" href="#" data-page="${i}"><small>${i}</small></a></li>`;
            }
          }

          n +=`<li class="page-item shadow-sm p-1" style="width:30px;"><small><b>${e["page_active"]}</b></small></li>`;

          for (var i = e["page_active"] + 1; i <= e["page_active"] + e["max_links"]; i++) {
            if (i <= e["pag_total"]) {
              n += `<li class="page-item shadow-sm"><a class="page-link border-0" href="#" data-page="${i}"><small>${i}</small></a></li>`;
            }
          }
          n += `<li class="page-item shadow-sm"><a class="page-link border-0" href="#" data-page="${e["pag_total"]}"><small>Último</small></a></li>`;
            $(".pag ul").append(n);
        }
      }
    });
    return false;
  });

  function Pagination(arrayg) {
    $(".box_list").html("");
    arrayg.forEach(element => {
      $(".box_list").append(
        ` <tr>
        <th scope="row" class="text-center">${element.event_id}</th>
        <td class="text-center">${element.event_title}</td>
        <td><span class="${element.event_status == 1 ? 'bg-success' : 'bg-danger'} d-block rounded-circle ml-3" style="width: 8px; height: 8px;"></span></td>
        <td>${element.event_date}</td>
        <td>${element.event_branch == 1 ? '<i class="fas fa-star text-warning"></i>' : '<i class="fas fa-star text-secondary"></i>'}</td>
        <td>${element.event_tag}</td>
        <td class="actionicon">
            <a href="?page=event/create/${element.event_id}" class="text-secondary"><i class="fad fa-pencil"></i></a>
            <a href="#" class="text-secondary"><i class="fad fa-trash-undo trash" data-id="${element.event_id}" data-toggle="modal" data-target="#exampleModal" data-name="${element.event_id}"></i></a>
        </td>
      </tr>`
      );
    });
  }
});