"use strict";
/**
 * Set ajax setup
 */
$.ajaxSetup({
    type: "post",
    url: "/src/controller/Api.class.php",
    dataType: "json"
  });

/**
 * Check input
 * return bool true or false
 */

 const checkInput = value => {
     value = value || false;
     if(value){
        return /^([a-z0-9_\.\-]+@[a-z\.]*[a-z]{2,4}\.[a-z]{2,4})$/.test(value);
     }
 }

 const logoutUser = () => {
   $.ajax({
     data: 'jController=admin-panel&admAction=logout',
     beforeSend: function(){
         location.reload(true);
     }
   });
 }

 

 const cutString = (string, start = 0, end = 1, delimiter = ',') => {
     var list = [],
         index = 0;

         for(index; index < string.length; index++){
             list += string[index].dataset.url + delimiter;
         }

         if(list.length > 0){
             return list.substr(start, list.length - end);
         }
 }

 const limitString = (string, max, tagCount) => {
     var val = string[0].value;

     if(val.length <= max){
         tagCount[0].innerHTML = max + ' / ' + val.length;
     }
    
     return val.substr(0, max);    
      
 }

 const searchFilter = (string, input) => {
     var value = string[0].value.toLowerCase().trim().replace(/(<([^>]+)>)/gi, ""),
         index = 0,
         text;

     for(index; index < input.length; index++){
         text = input[index].textContent || input[index].innerText;

         if (text.toLowerCase().indexOf(value) > -1) {
            input[index].style.display = "";
        } else {
            input[index].style.display = "none";
        }
     }
 }

 const formaterLink = string => {
     var value = string[0].value;

     return value.normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            .replace(/ /g, '-') 
            .replace(/\-\-+/g, '-')
            .toLowerCase()
            .trim();
            
 }



function createTag(label) {
    const div = document.createElement('div');
    div.setAttribute('class', 'tag border-primary bg-primary text-white shadow-sm btn');
    div.setAttribute('data-url', label);
    const span = document.createElement('span');
    span.innerHTML = label;
    const closeIcon = document.createElement('i');
    closeIcon.setAttribute('class', 'fal fa-times text-light mt-1 ml-3 excl');
    closeIcon.setAttribute('data-item', label);
    div.appendChild(span);
    div.appendChild(closeIcon);
    return div;
}

function clearTags() {
    document.querySelectorAll('.tag').forEach(tag => {
        tag.parentElement.removeChild(tag);
    });
} 

function addTags() {
 clearTags();
 tags.slice().reverse().forEach(tag => {
   tagContainer.prepend(createTag(tag));
 });
}



