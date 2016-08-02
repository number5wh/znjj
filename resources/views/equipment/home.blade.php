@extends('layout.layout')
@section('hl')
    <img src="{{url('images/header/switch.jpg')}}" alt="切换" style="height: 70px;width: 70px;" />


    @endsection
@section('hc')
    设备
@endsection
@section('hr')
<ul>
    <li class="eqsl">
    <img src="{{url('images/header/add.jpg')}}" alt="添加" style="height: 70px;width: 70px;" class="addEquip"/>
    <ul class="sub_list" style="display:none">
        @if(session('is_admin') == 1)
        <li class="sub_li"><a href="{{url('/equipment/addEquip1')}}">添加设备</a></li>
        <li class="sub_li"><a href="{{url('/equipment/addFriendGroup1')}}">移除设备</a></li>
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

@endsection