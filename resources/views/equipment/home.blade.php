@extends('layout.layout')
@section('hl')
    <img src="{{url('images/header/switch.jpg')}}" alt="切换" style="height: 70px;width: 70px;" />


    @endsection
@section('hc')
    设备
@endsection
@section('hr')
<ul>
    <li class="sl">
    <img src="{{url('images/header/switch.jpg')}}" alt="切换" style="height: 70px;width: 70px;" class="switchImg"/>
    <ul class="sub_list" style="display:none">
        <li class="sub_li"><a href="{{url('/user/addFriend')}}">添加好友</a></li>
        <li class="sub_li"><a href="{{url('/user/addFriendGroup1')}}">添加分组</a></li>
    </ul>
    </li>
</ul>
@endsection
@section('main')

@endsection