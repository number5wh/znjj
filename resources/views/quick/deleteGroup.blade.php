@extends('layout.layout')
@section('hl')
    <a href="javascript :;" onClick="javascript :history.back(-1);"><img src="{{url('images/header/back.png')}}" alt="返回" style="height: 70px;width: 70px;" /></a>
    @endsection
@section('hc')
    删除分组
@endsection
@section('hr')

@endsection
@section('main')
    <?php
    $num = $group==null?0:count($group);
    if($num == 0){
       ?>
    <script>alert('您还没有分组！');window.location.href='/quick/addGroup1';</script>
    <?php
    }
    ?>
    <br/><br/>
    <form action="/quick/deleteGroup2" method="post">
        <input type="text" name="_token" value="{{csrf_token()}}" hidden="hidden"/>
    <?php

    for($i=0;$i<$num;$i++){
        ?>
    <input type="checkbox" name="groupId[]" value="{{$group[$i]['id']}}"/>{{$group[$i]['name']}}<br/>

    <?php
    }

    ?>
        <br><br>
        <input type="submit" value="删除"/>
    </form>
@endsection