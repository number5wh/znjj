@extends('layout.layout')
@section('hl')
    <a href="javascript :;" onClick="javascript :history.back(-1);"><img src="{{url('images/header/back.png')}}" alt="返回" style="height: 70px;width: 70px;" /></a>


    @endsection
@section('hc')
    设备分配
@endsection
@section('hr')
<ul>
    <li class="sl">
    <img src="{{url('images/header/add.jpg')}}" alt="添加" style="height: 70px;width: 70px;" class="addImg"/>
    <ul class="sub_list" style="display:none">
        <li class="sub_li"><a href="/user/addEquip1/{{$disId}}">添加设备</a></li>
        <li class="sub_li"><a href="/user/deleteEquip1/{{$disId}}">移除设备</a></li>
    </ul>
    </li>
</ul>
@endsection
@section('main')
    <div align="center">{{$phone}}可操控的设备</div>
    <div align="center">
    <?php
        $num =  $equipInfo==null?0:count($equipInfo);
        $equipInfo = array_values($equipInfo);
               // dd($name,$equipInfo);
    //            dd($equipInfo);
        for($i=0;$i<$num;$i++){
            echo "<b class='block'><a class='fg'>".$name[$i]['name']."</a></b></br><ul class='FriendGroup' style='display:none'>";
            for($j=0;$j<count($equipInfo[$i]);$j++){
                echo "<li class='friend'>".$equipInfo[$i][$j]."<li>";
            }
            echo "</ul>";
        }
    ?>
    </div>
    <div align="center"><a href="/user/addEquip1/{{$disId}}"><button>添加设备</button></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="/user/deleteEquip1/{{$disId}}"><button>移除设备</button></a>
    </div>
    @endsection