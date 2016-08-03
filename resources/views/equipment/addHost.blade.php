@extends('layout.layout')
@section('hl')
    <img src="{{url('images/header/switch.jpg')}}" alt="切换" style="height: 70px;width: 70px;" />


@endsection
@section('hc')
    添加主机
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
    <div class="addHost">
        <input type="text" name="_token" value="{{csrf_token()}}" hidden="hidden"/>
        主机名称:<input type="text" name="name" placeholder="主机名"/><br/>
        密码:<input type="password" name="password"/><br/>
        <input type="submit" value="确定" id="hostAdd"/>
    </div>
@endsection