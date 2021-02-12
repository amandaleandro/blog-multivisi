$(function(){
    var form = $('#form_suport');
    form.submit(function(){
        $.ajax({
            data: $(this).serialize()+"&jController=admin-panel&admAction=support&action=auto&emailRemetente="+$('.profilephot').data('email'),
            beforeSend: function(){
                $('.toast').toast({delay: 2000});
                $('.toast').toast('show');
            },
            success: function(rest){
                console.log(rest);  
            }
        });
        
        return false;
    });


      // check limit characteres name product
      $('.name_prod').keyup(function(){
        var value = $(this);
        $(this).val(limitString(value, 75, $('.limit_max')));
    });
});