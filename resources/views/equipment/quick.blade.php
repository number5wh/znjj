@extends('layout.layout')
@section('hl')
    <a href="/equipment/changeWatch/1"><img src="{{url('images/header/switch.jpg')}}" alt="切换" style="height: 70px;width: 70px;" /></a>


@endsection
@section('hc')
    便捷分组
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
    @foreach($equips as $group)
        <b class='equipblock'><a>{{$group['name']}}</a></b><br><ul class='equipGroup' style='display:none'>
        @foreach($group['equip_name'] as $ename)
        <li class="equip">{{$ename}}</li>
        @endforeach
        </ul><br/><br/>

    @endforeach
    @endsection