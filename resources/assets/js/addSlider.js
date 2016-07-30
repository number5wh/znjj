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
});
