$(function(){

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
           data: 'jController=admin-panel&admAction=video&action=del_video&id='+id,
           beforeSend: function(){
               tag.remove();
           },
           success: function(rest){
               $('.modal').modal('hide');
           }
       });
    });
    
    // check limit characteres name product
    $('.name_prod').keyup(function(){
        var value = $(this);
        $(this).val(limitString(value, 20, $('.limit_max')));
    });

    $("#form_video").submit(function(){
        $.ajax({
            type: "post",
            url: "/src/controller/Api.class.php",
            dataType: "json",
            data: $(this).serialize()+'&jController=admin-panel&admAction=video&action=create_video',
            success: function(e){
                location.href = '?page=videos';
            }
        });
        return false;
    });
});