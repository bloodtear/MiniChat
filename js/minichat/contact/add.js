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
        if (userid == '') {
            return false;
        }
        __ajax('minichat.contact.search', {userid: userid}, function(data){
            console.log(data);
            $('.search_it').addClass('hidden');
            if (data.ret == 'fail') {
                $('.search_result').html('未找到此用户...');
            }else if (data.ret == 'success') {
                var userinfo = data.userinfo;
                var user = "<div class='rearched_user' userid=" + userinfo.id + ">用户名称：";
                user += userinfo.username;
                user += '';
                user += '<div style="float: right;" class="add_thiz_user btn btn-default">添加好友</div>';
                user += "</div>";
                
                $('.search_result').html(user);
            }
        });
    });
    
    $(document).on('click', '.add_thiz_user', function (){
        console.log('add_user');
        var add_userid = $(this).parents('.rearched_user').attr('userid');
        console.log(add_userid);
        
        __ajax('minichat.contact.add_friend', {add_userid: add_userid}, function(data){
            console.log(data);
            if (data.ret == 'success') {
                document.location.href = "?minichat/contact/index";
            }
        });
        
        
        
        
        
    });
    
    
    
    
    
    
    
    
    
    
});