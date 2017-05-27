$(function(){

    var server   = window.location.pathname+"server.php",
        roomName = window.location.href.split("?",2)[1];
    createUsername(server);
    setInterval(function(){
        showMessages();
    },1500);

    $("#send-msg").on('keydown',function(e){
                    $("body,html").scrollTop($(document).height());
        
        var code = e.which;
        if(code == 13 && !e.shiftKey)
        {
            var msg  = $(this).val().trim(),
                type = "sendMessage";
            if(msg != "")
            {
                $(this).val("");
                $.post(server,{message:msg,type:type,roomName:roomName}).done(function(data){
                    $(".messages").append(data)
                    $("body,html").scrollTop($(document).height());
                    

                });
            }
        }
    });

    // Function Create Username To User
    function createUsername(server)
    {

        console.log(window.location.href);
        var Username = prompt('Enter Your Username ?'),
            type     = "addUser";
        Username = !Username ? "Anonymous" : Username.trim();
        console.log(Username);
        $.post(server,{Username:Username,type:type,roomName:roomName}).done(function(data){
            $(".messages").append(data)
        });
    }

    // Function Show Messages Of Browser
    function showMessages()
    {
        $.post(server,{type:"showMessages",roomName:roomName}).done(function(data){
            $(".messages").append(data)
            $("body,html").scrollTop($(document).height());

            
        });
    }

});

