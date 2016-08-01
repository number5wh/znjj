/**
 * Created by root on 16-8-1.
 */
$(document).ready(function(){
    $("li form select#friendHandle").change(function(){
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
        var _token = $('input[name=_token]').val();
        var from = $('input[name=from]').val();
        var to = $('input[name=to]').val();
        var pass = $('input[name=pass]').val();
        var group = $(this).siblings("select").val()== null ? null :$(this).siblings("select").val();
        $.ajax({
            url:"/user/friendHandle",
            type:"post",
            async:trues,
            data:{
                '_token':_token,'from':from,'to':to,'pass':pass,'group':group
            },
            success:function(data) {
                alert(data);
                //window.location.href="/user/home";
            }
        });
        //return false;
    });

});




