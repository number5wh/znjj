@extends('layout.layout')
@section('hl')
    <a href="javascript :;" onClick="javascript :history.back(-1);"><img src="{{url('images/header/back.png')}}" alt="返回" style="height: 70px;width: 70px;" /></a>
    @endsection
@section('hc')
    添加设备到{{$group[0]['name']}}
@endsection
@section('hr')

@endsection
@section('main')
    <?php
    $num = count($equip);
    $hostName = array_keys($equip);?>
    <form action="/quick/addEquip2" method="post">
        <input type="text" name="_token" value="{{csrf_token()}}" hidden="hidden"/>
        <input type="text" name="group_id" value="{{$group[0]['id']}}" hidden="hidden"/>
        <?php
        for($i=0;$i<$num;$i++){

            echo "<b class='equipGroup'>".$hostName[$i]."</b>&nbsp;&nbsp;&nbsp;  <input type='checkbox' class='checkedAll1'/>(".count($equip[$hostName[$i]])."个设备)<br><div class='equipblock' style='display:none'>";
            for($j=0;$j<count($equip[$hostName[$i]]);$j++){
                if(!in_array($equip[$hostName[$i]][$j]['id'],$equipId)){
                    echo "<input type='checkbox' name='equip_id[]' value='{$equip[$hostName[$i]][$j]['id']}'/>"
                            .$equip[$hostName[$i]][$j]['name']."<br>";
                }else{
                    echo "<b>{$equip[$hostName[$i]][$j]['name']}</b>(已在分组中)<br>";
                }

            }
            echo "</div>";
        }
        ?>
        <br><br>
        <input type="submit" value="确定"/>
    </form>
@endsection