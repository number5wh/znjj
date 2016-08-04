@extends('layout.layout')
@section('hl')
    <a href="javascript :;" onClick="javascript :history.back(-1);"><img src="{{url('images/header/back.png')}}" alt="返回" style="height: 70px;width: 70px;" /></a>
    @endsection
@section('hc')
    添加分组
@endsection
@section('hr')

@endsection
@section('main')
    <?php
    $num = count($equip);
    $hostName = array_keys($equip);?>
    <form action="/quick/addGroup2" method="post">
    <input type="text" name="_token" value="{{csrf_token()}}" hidden="hidden"/>
    请输入分组名：<input type="text" name="name" placeholder="分组名"/><br/>
    请选择加入的设备:<br>
    <?php
    for($i=0;$i<$num;$i++){

        echo "<b class='equipGroup'>".$hostName[$i]."</b>&nbsp;&nbsp;&nbsp;  <input type='checkbox' class='checkedAll1'/>(".count($equip[$hostName[$i]])."个设备)<br><div class='equipblock' style='display:none'>";
        for($j=0;$j<count($equip[$hostName[$i]]);$j++){
            echo "<input type='checkbox' name='equip_id[]' value='{$equip[$hostName[$i]][$j]['id']}'/>".$equip[$hostName[$i]][$j]['name']."<br>";
        }
        echo "</div>";
    }
    ?>
        <br><br>
        <input type="submit" value="确定"/>
    </form>
@endsection