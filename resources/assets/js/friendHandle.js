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


