$('#messageOk').hide();
$('#close').on("click",function(){
    $('#messageOk').hide(500);
});
$( document ).ready(function() {

    $('#btn-add').on("click",function(event){
    event.preventDefault();
    let dataS = new Map();
    let tagInput = document.querySelectorAll('input[send]');
    let itm = 0;
    for(i=0; i < tagInput.length; i++){
        let input = tagInput[i];
        let value = input.value;
        let name = input.name;
        if(value == ''){
            itm++;
            $('input[name="'+name+'"]').val('The field is empty!');
        }else{
            dataS.set(name,value);
        }
    }
    let message = function(ask){
        $('#messageOk').show(500);
        $('#modal-body-message').html(
            'Folder with files:<b> '+ask.file+ 
            '</b><br>Path ini file: <b>'+ask.pathIni+'</b>'+
            '<br>Path php file: <b>'+ask.pathPhp+'</b>'
            );
    }
    if(itm == 0 ){
        let sendData = Object.fromEntries(dataS);
        $.ajax({
            method:"POST",
            url: '/settings/group/add/request',
            data:sendData,
            success: function(data){
                let ask = JSON.parse(data);
                if(ask.status == 1){    
                    $('#modal-title-message').html('The file was successfully created!');
                    $('#modal-background').css('background','#d1e7dd');
                    message(ask);
                    
                }else{
                    console.log(ask.status);
                    $('#modal-title-message').html('Error, such a file already exists!');
                    $('#modal-background').css('background','#f8d7da');
                    message(ask);
                }
            }
        });
    }
    })
});
