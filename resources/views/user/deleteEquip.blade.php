@extends('layout.layout')
@section('hl')
    <a href="javascript :;" onClick="javascript :history.back(-1);"><img src="{{url('images/header/back.png')}}" alt="返回" style="height: 70px;width: 70px;" /></a>
    @endsection
@section('hc')
    为{{$group[0]['to']}}删除设备
@endsection
@section('hr')

@endsection
@section('main')
    <br/><br/>
    <?php
    $num = count($equipId);?>
    <form action="/user/deleteEquip2" method="post">
        <input type="text" name="_token" value="{{csrf_token()}}" hidden="hidden"/>
        <input type="text" name="group_id" value="{{$group[0]['id']}}" hidden="hidden"/>
        <?php
            for($i=0;$i<$num;$i++){
                ?>
        <input type="checkbox" name="equip_id[]" value="{{$equipId[$i]}}"/>{{$equipName[$i]}}<br/>
        <?php
            }

        ?>
        <br><br>
        <input type="submit" value="确定"/>
    </form>
@endsection