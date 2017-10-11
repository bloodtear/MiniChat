
$(document).ready(function() {
    $("#update-face").click(function() {
        $("#face-file").click();
    });

    $("#face-file").change(function() {
        if (typeof FileReader == 'undefined') {
            alert("您的浏览器不支持上传，请更换浏览器重试！");
            return false;
        }

        var file = this.files[0];
        if (!/image\/\w+/.test(file.type)) {
            alert("文件不是图像类型！");
            return false;
        }

        var reader = new FileReader();
        reader.onload = function(e){
            $("#face").attr("src", e.target.result);
        }
        reader.readAsDataURL(file);
        return true;
    });

    $(".do_register").click(function() {
        console.log('do_register...');
        var username = $("#username").val();
        var password_2nd = $("#password_2nd").val();
        var password = $("#password").val();
        if (password_2nd !== password) {
            alert('密码输入不一致');
            return false;
        }
        //var face = $("#face").attr("src");
        if (username == "" || password_2nd == "" || password == "" ) {
            alert("请补全数据。");
            return false;
        }

        __ajax("minichat.login.register", {username: username, password: password}, "?minichat/login/index");
    });



});



