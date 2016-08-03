@extends('layout.layout')
@section('hl')
    <img src="{{url('images/header/switch.jpg')}}" alt="切换" style="height: 70px;width: 70px;" />


    @endsection
@section('hc')
    主机分组
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
            <li>添加设备</li>
            <li>移除设备</li>
            <li class="sub_li"><a href="{{url('/equipment/addHost1')}}">添加主机</a></li>
        @endif
    </ul>
    </li>
</ul>
@endsection
@section('main')
    <?php
        if($equip!=null){
        $num = count($equip);
        $hostName = array_keys($equip);
        for($i=0;$i<$num;$i++){
            echo "<div class='equipblock'><a>".$hostName[$i]."</a><ul class='equipGroup' style='display:none'>";
            for($j=0;$j<count($equip[$hostName[$i]]);$j++){
                echo "<li class='equip'>".$equip[$hostName[$i]][$j]['name']."</li>";
            }
            echo "</ul></div><br><br>";
        }
        }else{
            echo "<b>您没有任何主机</b><br><br>";
            ?>

            <a href="/equipment/addHost1"><button>点我添加主机</button></a>
    <?php
        }
    ?>

@endsection