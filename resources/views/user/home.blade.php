@extends('layout.layout')
@section('hl')
    <img src="{{url('images/header/find.png')}}" alt="查找" style="height: 70px;width: 70px;" class="addImg"/>
    <ul class="sub_list" style="display: none">
        <li class="sub_li"><a href="">添加好友</a></li>
        <li class="sub_li"><a href="">添加分组</a></li>
    </ul>

    @endsection
@section('hc')
    联系人
@endsection
@section('hr')
    <img src="{{url('images/header/add.jpg')}}" alt="添加" style="height: 70px;width: 70px;"/>
@endsection