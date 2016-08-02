/**
 * Created by root on 16-8-2.
 */
$(function(){
    $("div input#hostAdd").click(function(){

        $.post(
            "/equipment/addHost2",
        {
            name:$('input[name=name]').val(),
            _token:$('input[name=_token]').val(),
            password:$('input[name=password]').val()
        },
            function(data){
                if(data == 'right'){
                    alert('添加主机成功');
                    window.location.href="/equipment/home";
                }else if(data=='wrong host name'){
                    alert('主机名称有误');
                    window.location.href="/equipment/addHost1";
                }else if(data=='already login'){
                    alert('主机已经被添加过了');
                    window.location.href="/equipment/addHost1";
                }else if(data=='wrong password'){
                    alert('密码错误');
                    window.location.href="/equipment/addHost1";
                }

            }
        );
    });

});