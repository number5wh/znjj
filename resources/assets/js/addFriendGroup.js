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