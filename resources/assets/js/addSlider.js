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
