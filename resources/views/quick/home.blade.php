@extends('layout.layout')
@section('hl')
    @endsection
@section('hc')
    便捷操作
@endsection
@section('hr')

@endsection
@section('main')
    <?php
           for($i=0;$i<count($quick);$i++){
               ?>
    <a href="/quick/groupInfo/{{$quick[$i]['id']}}" style="color: #000011"><div class='quickGroup'>{{$quick[$i]['name']}}</div></a>
    <?php
           }
    ?>
    <div class='quickGroup'>+</div>

@endsection