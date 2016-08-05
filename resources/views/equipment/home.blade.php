@extends('layout.layout')
@section('hl')
    <a href="/equipment/changeWatch/0"><img src="{{url('images/header/switch.jpg')}}" alt="切换" style="height: 70px;width: 70px;" /></a>


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
            echo "<b class='equipblock'><a>".$hostName[$i]."</a></b><br><ul class='equipGroup' style='display:none'>";
            for($j=0;$j<count($equip[$hostName[$i]]);$j++){
                echo "<li class='equip'>".$equip[$hostName[$i]][$j]['name']."</li>";
            }
            echo "</ul><br><br>";
        }
        }else{
            echo "<b>您没有任何主机</b><br><br>";
            ?>

            <a href="/equipment/addHost1"><button>点我添加主机</button></a>
    <br/><br/>
    <?php
        }
            if($equip2!=null){
                $num2 = count($equip2);
                echo "<b class='equipblock'><a>别人分配的设备</a></b><br><ul class='equipGroup' style='display:none'>";
                for($i=0;$i<$num2;$i++){
                    echo "<li class='equip'>".$equip2[$i]['name']."</li>";
                }
                echo "</ul><br><br>";
            }else{
                echo "<b>别人还未分配设备给您</b><br><br>";
            }
    ?>

@endsection