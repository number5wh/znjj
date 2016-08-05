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

    $("b.block").click(function(){
        $(this).next('br').next("ul").slideToggle();
    });
    $("li.eqsl").click(function(){
        $(this).find("ul").toggle();
    });
    $("b.equipblock").click(function(){
        $(this).next('br').next("ul").slideToggle();
    });
    $("b.equipGroup").click(function(){
        $(this).next("input").next("br").next("div").toggle();
    })
});
