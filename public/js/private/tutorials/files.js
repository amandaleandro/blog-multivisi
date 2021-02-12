$(function(){


    var file = $('.fileprod'),
        form = $('#form_file');

    $('.filesuploadeds').on('click', 'i', function(){
       $(this).parent().remove();
     });


    file.change(function(){
        var arr = $(this)[0].files;
        $('.filesuploadeds ul').html('<li class="list-group-item position-relative shadow-sm border-0">'+arr[0].name+'<i class="fas fa-window-close ml-3 text-danger position-absolute" style="right: 15px; top: 17px"></i></li>');
        $('.sizeupload').html('size: ' + arr[0].size + 'kb');
       
        return false;
    });

    form.submit(function(){
        $(this).ajaxSubmit({
            type: "post",
            url: "/src/controller/Api.class.php",
            data: { jController: "admin-panel", admAction: "tutorial_file"},
            dataType: "json",
            success: function(rest) {
                if(rest[1] == 'accept'){
                    console.log('Heeyy Good');
                    file.val('');
                }
            }
        });

        return false;
    });

    $('tbody').on('click', 'tr .trash', function(){
        $('.btnyes').data({id: $(this).data('id')});
        $('.nameprod').html($(this).data('name'));
        tag = $(this).parents('tr');
    });

    $('.btnyes').click(function(){
       var id = $(this).data('id');

       $.ajax({
           data: 'jController=admin-panel&admAction=tutorial_file&action=delete_file&file_id='+id,
           beforeSend: function(){
               tag.remove();
           },
           success: function(rest){
               console.log(rest);
               $('.modal').modal('hide');
           }
       });
    });

    $('#form_search input').keyup(function(){
        var value = $(this).val();

        $('tbody tr').filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
    

});