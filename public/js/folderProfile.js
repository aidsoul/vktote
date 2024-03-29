function modal (text){
    $('#alert').html('<div id="message" class="alert alert-dismissible fade show" role="alert">'+text+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
}
function alert(type,text){
    if(type == 1){
        modal(text);
        $('#message').css('background','#d1e7dd');
    }else{
        modal(text);
        $('#message').css('background','#f8d7da');
    }

}
function del(name){

    $.ajax({
        method:"GET",
        url: '/settings/group/delete',
        dataType:'json',
        data:{name:name},
        error: function(error){
            alert(0,error);
        },
        beforeSend:function(){
            $('#spinner-'+name).attr('class','spinner-border'); 
                
        },
        success: function(ask){
            console.log(ask);
            $('#spinner-'+name).attr('class','btn-close'); 
            // if(!ask.match(/[0-5]/s)){
            //     alert(0,data);
            // }

            if(ask.status == 1){  
                window.location.replace('/settings');
            }
            if(ask.status == 0){  
                alert(0,'Folder '+ask.name+' not found');
            }
            if(ask.status == 2){  
                alert(0,'Error, check the correctness of the database data in the config!<br>Enter the correct data to connect to the database or delete the folder manually.');
            }
            if(ask.status == 3){  
                alert(0,'Error. Table "'+ask.name+'" in database not exist!<br><b>To avoid data loss, delete the profile folder manually.</b>');
            }
            if(ask.status == 4){  
                alert(0,'Error. File "'+ask.name+'" not exist!');
            }
            if(ask.status == 5){  
                alert(0,'Error. File "'+ask.name+'" not exist!');
            }
        }
    });
}