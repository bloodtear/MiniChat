$(document).ready(function() {

    $(".do_login").click(function() {
        
        
        
    __ajax("minichat.login.get_salt", {}, function (data){
        console.log(data);
        var salt = data.salt;
        var username = $("#username").val();
        var password = $("#password").val();
        var cipher = md5(username + salt + password);

        console.debug("username = " + username);
        console.debug("password = " + password);
        console.debug("salt = " + salt);
        console.debug("cipher = " + cipher);
        __ajax("minichat.login.login", {username: username, cipher: cipher}, function(data) {
            if (data.ret == 'success') {
                go('minichat/index/index');
            }
            console.log(data.refer);
            document.location.href = "?";
            //document.location.href = data.refer;
        });
        return;
    });
        return;
        
        $.ajax({
            url: "ajax.php?action=" + "minichat.login.get_salt" ,
            type: 'post',
            data: '',
            success: function (data) {
                console.debug(data);
                data = eval("(" + data + ")");
                
                var salt = data.ret;
                
                var username = $("#username").val();
                var password = $("#password").val();
                var cipher = md5(username + salt + password);

                console.debug("username = " + username);
                console.debug("password = " + password);
                console.debug("salt = " + salt);
                console.debug("cipher = " + cipher);
//return;
                __ajax("minichat.login.login", {username: username, cipher: cipher}, function(data) {
                    if (data.ret == 'success') {
                        go('minichat/index/index');
                    }
                    console.log(data.refer);
                    document.location.href = "?";
                    //document.location.href = data.refer;
                });
            }
        });
    });
});
