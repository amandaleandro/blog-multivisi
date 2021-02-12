$(function(){
    var limit_title     = $('.limit_max'),
        name_prod       = $('.name_prod'),
        cover           = $('#cover'),
        form            = $('#form_category');
    

    name_prod.on('keyup', function(){
        limit_title.html(`75 / ${$(this).val().length}`);
    });

    cover.change(function(){
        $('.coveimg img').attr('src', URL.createObjectURL(this.files[0]));
    });

    form.submit(function(){
        $(this).ajaxSubmit({
            type: "post",
            url: "/src/controller/Api.class.php",
            data: { jController: "admin-panel", admAction: "tutorial_category"},
            dataType: "json",
            success: function(rest) {
                if(rest[1] == 'accept'){
                    console.log('Heeyy Good');
                }
            }
        });

        return false;
    });
});