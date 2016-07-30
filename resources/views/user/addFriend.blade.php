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
                <li class="sub_li"><a href="">添加分组</a></li>
            </ul>
        </li>
    </ul>
@endsection
@section('main')


    <div class="add">
        <form action="{{url('user/addFriend')}}" method="post">
            {{csrf_field()}}
            手机号:<input type="text" name="phone" placeholder="请输入对方手机号" id="phone"/>
            选择分组:<select name="group">
                @foreach($groups as $group)
                    <option value="{{$group}}">{{$group}}</option>
                    @endforeach
                    <input type="submit" value="添加"/>
            </select>
        </form>
    </div>
@endsection