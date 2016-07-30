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
    {{--好友添加请求--}}
    <div>

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