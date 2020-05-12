@extends('layouts.app')
@include('layouts.sections.header')
@include('layouts.sections.navbar')
@section('content')
<style>
.txtbx{margin: 0 10px 0 20px;}
#dot{ 
  font-weight: bold;
  font-size: 24px;
}
</style>
<div class="container">
  <div class="row">
    <form method="POST" action="{{ action('WeightController@update', $weights['id']) }}">
    @csrf
    @method('PATCH')
      <!--日付-->
      <div class="form-group">
        <label for="year">日付</label>
      </div>
      <div class="form-inline">
        <input name="year" type="tet" class="form-control txtbx" id="year" value="{{$weights['year']}}" readonly>年 &nbsp;&nbsp;
        <input name="month" type="text" class="form-control txtbx" id="month" value="{{$weights['month']}}" readonly>月 &nbsp;&nbsp;
        <input name="day" type="text" class="form-control txtbx" id="day"  value="{{$weights['day']}}" readonly>日
      </div>
      <br><br>

      <!--時刻-->
      <div class="form-group">
        <label for="hour">時刻</label>
      </div>
      <div class="form-inline">
        <input name="hour" type="tet" class="form-control txtbx" id="hour" value="{{$weights['hour']}}" readonly>時 &nbsp;&nbsp;
        <input name="minute" type="text" class="form-control txtbx" id="minute" value="{{$weights['minute']}}" readonly>分 &nbsp;&nbsp;
        <input name="second" type="text" class="form-control txtbx" id="second"  value="{{$weights['second']}}" readonly>秒
      </div>
      <br><br>

      <!--体重-->
      <div class="form-group">
        <label for="weight1">体重</label>
      </div>
      <div class="form-inline">
        <input name="weight1" type="text" class="form-control txtbx" id="weight1"  value="{{$weights['weight1']}}"><span id="dot">.</span>
        <input name="weight2" type="text" class="form-control txtbx" id="weight2"  value="{{$weights['weight2']}}">kg
      </div>
      <br><br>

      <!--更新ボタン-->
      <input class="btn btn-info" type="submit" value="更新">
    </form>
  </div>
</div>
@endsection
