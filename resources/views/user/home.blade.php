@extends('layout.layout')
@section('hl')
    <img src="{{url('images/header/find.png')}}" alt="查找" style="height: 70px;width: 70px;" />


    @endsection
@section('hc')
    联系人
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
    {{--好友请求--}}
    <div>
        @if($frphoneAdd != null)
            <ul>
            @foreach($frphoneAdd as $add)
                <li class="addFriend">{{$add}}想添加你为好友
                    <form action="/user/friendHandle" method="post">
                        <input type="text" name="_token" value="{{csrf_token()}}" hidden="hidden"/>
                        <input type="text" name="from" value="{{$add}}" hidden="hidden"/>
                        <input type="text" name="to" value="{{session('user_id')}}" hidden="hidden"/>
                        <select name="pass" id="friendHandle">
                            <option value="-1">--请选择--</option>
                            <option value="1">同意</option>
                            <option value="0">拒绝</option>
                            <option value="3">忽略</option>
                        </select>
                        <div class="handleAgree" style="display: none">
                            <select name="group">
                                @foreach($group as $v)
                                    <option value="{{$v}}">{{$v}}</option>
                                    @endforeach
                            </select>
                            <input type="submit" class="btn" value="确定">

                        </div>
                        <div class="handleDeny" style="display: none">
                            <p>确定拒绝吗</p>
                            <input type="submit" class="btn" value="确定">
                        </div>
                        <div class="handleIgnore" style="display: none">
                            <p>确定忽略吗</p>
                            <input type="submit" class="btn" value="确定">
                        </div>
                    </form>
                </li>
            @endforeach
            </ul>
            @endif

    </div>



    <?php
            //dd($data);
        $name = $data['name'];
        $phones = $data['phones'];
        $groups = count($name);
        for($i=0;$i<$groups;$i++){
            echo "<div class='block'><a class='fg'>".$name[$i]."</a><ul class='FriendGroup' style='display:none'>";
            for($j=0;$j<count($phones[$i]);$j++){
                echo "<li class='friend'>".$phones[$i][$j]."<li>";
               // echo $friends[$i][$j];
            }
            echo "</ul></div>";
        }
    ?>
    @endsection