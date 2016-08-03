/**
 * Created by root on 16-8-2.
 */
$(function(){
    $("div input#friendGroupSubmit").click(function(){

        $.post(
            "/user/addFriendGroup2",
        {
            groupName:$('input[name=groupName]').val(),
            _token:$('input[name=_token]').val(),
            user_id:$('input[name=user_id]').val()
        },
            function(data){
                if(data == 1){
                    alert('添加分组成功');
                    window.location.href="/user/home";
                }

            }
        );
    });

});
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
/**
 * Created by root on 16-7-29.
 */
$(document).ready(function(){
    $("li.sl").mouseenter(function(){
        $(this).find("ul").slideDown();
    });
    $("li.sl").mouseleave(function(){
        $(this).find("ul").slideUp();
    });

    $("div.block").click(function(){
        $(this).find("ul").slideToggle();
    });
    $("li.eqsl").click(function(){
        $(this).find("ul").toggle();
    });
    $("div.equipblock").click(function(){
        $(this).find("ul").toggle();
    })
    $("b.equipGroup").click(function(){
        $(this).next("input").next("br").next("div").toggle();
    })
});

/**
 * Created by root on 16-8-3.
 */
$(function(){
    $('input.checkedAll1').click(function() {
        if(this.checked){
            $(this).next().next().find("[name=equip_id[]]:checkbox").attr('checked',true);
        }else{
            $(this).next().next().find("[name=equip_id[]]:checkbox").attr('checked',false);
        }
    });
});
/**
 * Created by root on 16-8-1.
 */
$(document).ready(function(){
    $("li select#friendHandle").change(function(){
       var value = $(this).children('option:selected').val();
        if(value == -1) {
            $(this).siblings("div.handleAgree").css('display','none');//jquery样式改变
            $(this).siblings("div.handleDeny").css('display','none');
            $(this).siblings("div.handleIgnore").css('display','none');
        }
        if(value == 1) {
            $(this).siblings("div.handleAgree").css('display','block');//jquery样式改变
            $(this).siblings("div.handleDeny").css('display','none');
            $(this).siblings("div.handleIgnore").css('display','none');
        }
        if(value == 0) {
            $(this).siblings("div.handleAgree").css('display','none');//jquery样式改变
            $(this).siblings("div.handleDeny").css('display','block');
            $(this).siblings("div.handleIgnore").css('display','none');
        }
        if(value == 3) {
            $(this).siblings("div.handleAgree").css('display','none');//jquery样式改变
            $(this).siblings("div.handleDeny").css('display','none');
            $(this).siblings("div.handleIgnore").css('display','block');
        }
    });
});

$(function(){
    $("div.handleAgree input.btn").click(function(){
        //alert($(this).siblings("select").val()== null ? null :$(this).siblings("select").val());

        $.post("/user/friendHandle",
            {_token:$('input[name=_token]').val(),
                from:$('input[name=from]').val(),
                to:$('input[name=to]').val(),
                pass:$('select[name=pass]').val(),
                group:$(this).siblings("select").val()== null ? null :$(this).siblings("select").val()
            },
            function(data){
                if(data==1){
                    alert('已添加');
                }else if(data==2){
                    alert('已拒绝');
                }else if(data==3){
                    alert('已忽略');
                }else{
                    alert(data);
                }
                window.location.href="/user/home";
            });
        //return false;
    });

});
$(function(){
    $("li.deny,li.pass").click(function(){
        $(this).css('display','none');
    });
});



//# sourceMappingURL=all.js.map
