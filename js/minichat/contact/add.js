$(document).ready(function (){
    
    $('.search_input').focus(function (){
        var input = $(this).val();
        $(this).val('');
        $('.search_it').removeClass('hidden');
        $('.search_result').html('');
    });
    
    $('.search_input').bind('keypress',function(event){  
        if(event.keyCode == "13"){
           $('.search_it').click();
        }  
    });
    
    $('.search_it').click(function (){
        var userid = $('.search_input').val();
        __ajax('minichat.contact.search', {userid: userid}, function(data){
            console.log(data);
            $('.search_it').addClass('hidden');
            if (data.ret == 'fail') {
                $('.search_result').html('未找到此用户...');
            }else if (data.ret == 'success') {
                var userinfo = data.userinfo;
                var user = "<div>用户名称：";
                user += userinfo.username;
                user += '';
                user += '';
                user += "</div>";
                
                $('.search_result').html(user);
            }
        });
        
    });
    
    
    
    
    
    
    
    
    
    
});