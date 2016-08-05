@extends('layout.layout')
@section('hl')
    <img src="{{url('images/header/switch.jpg')}}" alt="切换" style="height: 70px;width: 70px;" />


    @endsection
@section('hc')
    移除设备
@endsection
@section('hr')
<ul>
    <li class="eqsl">
    <img src="{{url('images/header/add.jpg')}}" alt="添加" style="height: 70px;width: 70px;" class="addEquip"/>
    <ul class="sub_list" style="display:none">
        @if(session('is_admin') == 1)
        <li class="sub_li"><a href="{{url('/equipment/addEquip1')}}">添加设备</a></li>
        <li class="sub_li"><a href="{{url('/equipment/deleteEquip1')}}">移除设备</a></li>
        <li class="sub_li"><a href="{{url('/equipment/addHost1')}}">添加主机</a></li>
            @else
            <li class="sub_li"><a href="{{url('/equipment/addHost1')}}">添加主机</a></li>
        @endif
    </ul>
    </li>
</ul>
@endsection
@section('main')
    <?php
        $num = $equip==null?0:count($equip);
        $hostName = array_keys($equip);?>
    <form action="/equipment/deleteEquip2" method="post">
        <input type="text" name="_token" value="{{csrf_token()}}" hidden="hidden"/>
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