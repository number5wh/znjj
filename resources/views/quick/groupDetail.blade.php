@extends('layout.layout')
@section('hl')
    @endsection
@section('hc')
    {{$groupName[0]['name']}}
@endsection
@section('hr')
    <ul>
        <li class="sl">
            <img src="{{url('images/header/add.jpg')}}" alt="添加" style="height: 70px;width: 70px;" class="addImg"/>
            <ul class="sub_list" style="display:none">
                <li class="sub_li"><a href="/quick/group/{{$id}}/addEquip1">添加设备</a></li>
                <li class="sub_li"><a href="/quick/group/{{$id}}/deleteEquip1">从分组中删除</a></li>
            </ul>
        </li>
    </ul>
@endsection
@section('main')
    <?php
           for($i=0;$i<count($equipInfo);$i++){
               ?>
    <a id="singleSwitch" style="color: #000011"><div class='quickGroup'>设备名:{{$equipInfo[$i]['name']}}<br/>
            <input type="text" name="_token" value="{{csrf_token()}}" hidden="hidden"/>
            <input type="text" name="equip_id" value="{{$equipInfo[$i]['id']}}" hidden="hidden"/>
            {{--<input type="text" name="group_id" value="{{$id}}" hidden="hidden"/>--}}
            <?php
            if($equipInfo[$i]['status'] == 0){
                echo "<input type='text' name='status' value='1' hidden='hidden'/>";
            echo "状态:关</div></a>";
            }
                else{
                    echo "<input type='text' name='status' value='0' hidden='hidden'/>";
                    echo "状态:开</div></a>";
                }

           }
    ?>
    <a href="/quick/group/{{$id}}/addEquip1" style="color: #000011"><div class='quickGroup'>+</div></a>

@endsection