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