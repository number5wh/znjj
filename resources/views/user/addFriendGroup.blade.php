@extends('layout.layout')
@section('hl')
    <img src="{{url('images/header/find.png')}}" alt="查找" style="height: 70px;width: 70px;" />


@endsection
@section('hc')
    添加好友
@endsection
@section('hr')
    <ul>
        <li class="sl">
            <img src="{{url('images/header/add.jpg')}}" alt="添加" style="height: 70px;width: 70px;" class="addImg"/>
            <ul class="sub_list" style="display:none">
                <li class="sub_li"><a href="{{url('/user/addFriend')}}">添加好友</a></li>
                <li class="sub_li"><a href="{{url('/user/addFriendGroup1')}}">添加分组</a></li>
            </ul>
        </li>
    </ul>
@endsection
@section('main')
    <div id="addFriendGroup">
            <input type="text" hidden="hidden" name="_token" value="{{csrf_token()}}"/>
            <input type="text" hidden="hidden" name="user_id" value="{{session('user_id')}}"/>
           分组名称: <input type="text" name="groupName" placeholder="请输入分组名"/>
            <input type="submit" value="确定" id="friendGroupSubmit"/>

    </div>

@endsection