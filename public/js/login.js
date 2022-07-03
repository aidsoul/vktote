$( document ).ready(function() {
    $('#login').on('click',function(event){
        event.preventDefault();
        let modal = function(text){
            $('#alert').html('<div id="message" class="alert alert-dismissible fade show" role="alert">'+text+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }
        let alert = function(type,text){
            if(type == 1){
                modal(text);
                $('#message').css('background','#d1e7dd');
            }else{
                modal(text);
                $('#message').css('background','#f8d7da');
            }
        
        }
        let send = $('#password');
        $.ajax({
            method:'POST',
            url:'/login',
            dataType:'json',
            data:{password:send.val()},
            success:function(data){
                let status = data.status;
                
                if(status == 1){ 
                    alert(1,'Authorized');
                    window.location.replace('/');
                }
                if(status == 2){
                    alert(0,'Invalid login information');
                }
                if(status == 3){
                    alert(0,'POST "password" not exist');
                }
                if(status == 4){
                    alert(0,'You are already logged in');
                }
                if(status == 5){
                    alert(0,'Something is wrong with session');
                }

            }
        });
    });

});
