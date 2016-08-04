@extends('layout.layout')
@section('hl')
    @endsection
@section('hc')
    便捷操作
@endsection
@section('hr')
    <ul>
        <li class="sl">
            <img src="{{url('images/header/add.jpg')}}" alt="添加" style="height: 70px;width: 70px;" class="addImg"/>
            <ul class="sub_list" style="display:none">
                <li class="sub_li"><a href="{{url('/quick/addGroup1')}}">添加设备分组</a></li>
                <li class="sub_li"><a href="{{url('/quick/deleteGroup1')}}">删除分组</a></li>
            </ul>
        </li>
    </ul>
@endsection
@section('main')
    <?php
           for($i=0;$i<count($quick);$i++){
               ?>
    <a href="/quick/groupInfo/{{$quick[$i]['id']}}" style="color: #000011"><div class='quickGroup'>{{$quick[$i]['name']}}</div></a>
    <?php
           }
    ?>
    <a href="/quick/addGroup1" style="color: #000011"><div class='quickGroup'>+</div></a>

@endsection