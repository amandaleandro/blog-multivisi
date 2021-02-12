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
       console.log(id);

       $.ajax({
           data: 'jController=admin-panel&admAction=product_category&action=delete_category&category_id='+id,
           beforeSend: function(){
               tag.remove();
           },
           success: function(rest){
               console.log(rest);
               $('.modal').modal('hide');
           }
       });
    });
});