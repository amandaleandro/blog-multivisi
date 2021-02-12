$(function(){
    var form = $('.form_user');

    $('.cover').change(function(){
        $(this).parent().attr('style', 'background: url('+URL.createObjectURL(this.files[0])+')');
    });

    form.submit(function(){

        $(this).ajaxSubmit({
            type: "post",
            url: "/src/controller/Api.class.php",
            data: {jController: 'admin-panel', admAction: 'user'},
            dataType: "json",
            success: function(rest) {
                if(rest[1] == 'accept'){
                    location.href = '?page';
                }
            }
        });

        return false;
    });
});