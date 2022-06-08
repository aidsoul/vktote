
document.addEventListener("DOMContentLoaded",function(){

    let items = document.querySelectorAll('input[rval]');

    let removeTag = function(data){
        return data.value.replace(/<[A-Za-zА-Яа-я]{1,}>|[<]{1}[>]{1}/g,"");
    }
    let removeRus = function(data){
        return data.replace(/[А-Яа-я ]/g,"");
    }
    let onTag = function(e){
        let input = e.target;
        let replaceTag = removeTag(input);
        let replaceRus = removeRus(replaceTag);
        input.value = replaceRus;
    }
    
    for(i=0; i< items.length; i++){
        items[i].addEventListener("input",onTag);
    }

    let count = document.querySelector('input[rnumb]');
    count.addEventListener("input",function(e){
        let item = e.target;
        
        item.value = item.value.replace(/[^0-9]/g,"");
        if(item.value > 100){
            item.value = 'Max count = 100';
        }
    });
})