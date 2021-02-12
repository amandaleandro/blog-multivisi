$(function(){
    var 
    b = function(obj, tag){ searchFilter(obj, tag); },
    c = function(tag, tagProp){
        if(tag.is(':checked')){
            tagProp.find('input').prop('checked', true);
        }else{
            tagProp.find('input').prop('checked', false);
            tagProp.find('input').removeProp('checked');
        }
    };




    // form send
    $('#form_product').submit(function(){         
        var error = false,
            listYtb = [],
            listSeo = [];

        // transform array in string with delimiter
        listYtb = cutString($('.youtubelist li'));
        listSeo = cutString($('.tag-container .tag'));

        $(this).serializeArray().forEach(element => {
            if(element.value.length <= 0){
                error = true;
            }
        });

        if(!error){
            $(this).ajaxSubmit({
                type: "post",
                url: "/src/controller/Api.class.php",
                data: { jController: "admin-panel", admAction: "product", product_video: listYtb, product_seo_tags: listSeo},
                dataType: "json",
                success: function(rest) {
                    if(rest[1] == 'accept'){
                        location.href = '?page=products';
                    }
                }
            });
        }else{
            $('.toast').toast({delay: 2000});
            $('.toast').toast('show');
        }

        return false;  
    });

    // check limit characteres name product
    $('.name_prod').keyup(function(){
        var value = $(this);
        $(this).val(limitString(value, 75, $('.limit_max')));
    });

    // list files
    $('#searchfile').keyup(function(){ b($(this), $('.listfiles li')); });

    // list category
    $('#search').keyup(function() { b($(this), $('listcategory li')); });

    // check all inputs
    $('#checkall').click(function(){ c($(this), $('.listcategory li'));  });
    $('#checkal').click(function(){  c($(this), $('.listfiles')); });

    // change the cover
    $('#cover').change(function(){  $('.coveimg img').attr('src', URL.createObjectURL(this.files[0]));  });

    // add and remove link youtube
    $('.ybtinput i').click(function(){
        var length = $(this).parent().find('input').val().length;
        if(length <= 0){
            $('.txterror').removeClass('d-none');
        }else{
            $('.txterror').addClass('d-none');
            $('.youtubelist').prepend(`
                <li class="list list-group-item d-flex justify-content-between align-items-center border-light" data-url="${$(this).parent().find('input').val()}">
                    <small><i>${$(this).parent().find('input').val()}</i></small>
                    <i class="fas fa-minus-square text-danger delety"></i>
                </li>
            `);
            $(this).parent().find('input').val('');
        }
    });

    $('.youtubelist').on('click', '.delety', function(){ $(this).parent().remove(); });

    $('#prdurl').keyup(function(){
        var value = $(this);
        $(this).val(formaterLink(value));
    });

    $('.seodescript input').keyup(function(){
        var value = $(this);
        $(this).val(limitString(value, 155, value.parent().find('span')));
    });


});

const tagContainer = document.querySelector('.tag-container');
const input = document.querySelector('.tag-container input');

let tags = [];

if(tagContainer.dataset.seo != undefined){
    var nt = tagContainer.dataset.seo.split(',');
    if(nt[0]){
        nt.forEach(tag => {
            tags.push(tag);
        });
        addTags();
        tagContainer.removeAttribute('data-seo');
    }
}


input.addEventListener('keyup', (e) => {
    e.preventDefault();
   if (e.key === 'Enter') {
      
     e.target.value.split(',').forEach(tag => {
       tags.push(tag);  
     });
     
     addTags();
     input.value = '';
   }
   return false;
});

document.addEventListener('click', (e) => {
 if (e.target.classList[5] == 'excl') {
   const tagLabel = e.target.getAttribute('data-item');
   const index = tags.indexOf(tagLabel);
   tags = [...tags.slice(0, index), ...tags.slice(index+1)];
   addTags();    
 }
});

input.focus();