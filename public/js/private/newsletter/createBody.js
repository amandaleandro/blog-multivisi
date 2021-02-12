$(function(){
    var form = $('.form_body');
    var error = false;
    var tag;

    form.submit(function(){
        $(this).serializeArray().forEach(element => {
            if(!element.value){
                error = true;
            }
        });

        if(!error){
            $.ajax({
                data: 'jController=admin-panel&admAction=newsletter&'+$(this).serialize(),
                success: function(rest){
                    console.log(rest);
                    location.href = '?page=newsletter/';
                }
            });
        }else{
            console.log('campos em branco!');
        }

        return false;
    });


    
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
           data: 'jController=admin-panel&admAction=newsletter&action=delete_newsletter&newsletter_id='+id,
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