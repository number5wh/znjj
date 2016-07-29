/**
 * Created by root on 16-7-29.
 */
$(document).ready(function(){
    $("img.addImg").mouseenter(function(){
        $(this).find("ul").slideDown();
    });
    $("img.addImg").mouseleave(function(){
        $(this).find("ul").slideUp();
    });
});

//# sourceMappingURL=all.js.map
