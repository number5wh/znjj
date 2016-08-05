@extends('layout.layout')
@section('hl')
    <a href="javascript :;" onClick="javascript :history.back(-1);"><img src="{{url('images/header/back.png')}}" alt="返回" style="height: 70px;width: 70px;" /></a>
    @endsection
@section('hc')
    添加分组
@endsection
@section('hr')

@endsection
@section('main')
    <?php
    $num = $equip==null?0:count($equip);
?>
    <form action="/quick/addGroup2" method="post">
        <input type="text" name="_token" value="{{csrf_token()}}" hidden="hidden"/>
        请输入分组名：<input type="text" name="name" placeholder="分组名"/><br/>
        请选择加入的设备:<br>
        <?php
    if($num != 0){
    $hostName = array_keys($equip);?>


    <?php
    for($i=0;$i<$num;$i++){

        echo "<b class='equipGroup'>主机部分:".$hostName[$i]."</b>&nbsp;&nbsp;&nbsp;  <input type='checkbox' class='checkedAll1'/>(".count($equip[$hostName[$i]])."个设备)<br><div class='equipblock' style='display:none'>";
        for($j=0;$j<count($equip[$hostName[$i]]);$j++){
            echo "<input type='checkbox' name='equip_id[]' value='{$equip[$hostName[$i]][$j]['id']}'/>".$equip[$hostName[$i]][$j]['name']."<br>";
        }
        echo "</div>";
    }}else{
            echo "目有主机或主机设备<br>";
        }


        $num2 = $equip2==null?0:count($equip2);
            if($num2 != 0){
                //dd($equip2);
                echo "<b class='equipGroup'>被分配的部分:</b>&nbsp;&nbsp;&nbsp;  <input type='checkbox' class='checkedAll1'/>(".count($equip2)."个设备)<br><div class='equipblock' style='display:none'>";

                for($k=0;$k<$num2;$k++){
                    echo "<input type='checkbox' name='equip_id[]' value='{$equip2[$k]['id']}'/>".$equip2[$k]['name']."<br>";
                } echo "</div>";
            }else{
                echo "目有被分配的设备<br>";
            }

    ?>
        <br><br>
        <input type="submit" value="确定"/>
    </form>
@endsection