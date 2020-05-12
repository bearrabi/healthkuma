@extends('layouts.app')
@include('layouts.sections.header')
@include('layouts.sections.navbar')
@section('content')
<style>
.txtbx{margin: 0 10px 0 20px;}
#dot,#deg{ 
  font-weight: bold;
  font-size: 24px;
}
</style>
<div class="container">
  <div class="row">
    <form method="POST" action="{{ action('TemperatureController@update', $temperatures['id']) }}">
    @csrf
    @method('PATCH')
      <!--日付-->
      <div class="form-group">
        <label for="year">日付</label>
      </div>
      <div class="form-inline">
        <input name="year" type="tet" class="form-control txtbx" id="year" value="{{$temperatures['year']}}" readonly>年 &nbsp;&nbsp;
        <input name="month" type="text" class="form-control txtbx" id="month" value="{{$temperatures['month']}}" readonly>月 &nbsp;&nbsp;
        <input name="day" type="text" class="form-control txtbx" id="day"  value="{{$temperatures['day']}}" readonly>日
      </div>
      <br><br>

      <!--時刻-->
      <div class="form-group">
        <label for="hour">時刻</label>
      </div>
      <div class="form-inline">
        <input name="hour" type="tet" class="form-control txtbx" id="hour" value="{{$temperatures['hour']}}" readonly>時 &nbsp;&nbsp;
        <input name="minute" type="text" class="form-control txtbx" id="minute" value="{{$temperatures['minute']}}" readonly>分 &nbsp;&nbsp;
        <input name="second" type="text" class="form-control txtbx" id="second"  value="{{$temperatures['second']}}" readonly>秒
      </div>
      <br><br>

      <!--体重-->
      <div class="form-group">
        <label for="temperature1">体温</label>
      </div>
      <div class="form-inline">
        <input name="temperature1" type="text" class="form-control txtbx" id="temperature1"  value="{{$temperatures['temperature1']}}"><span id="dot">.</span>
        <input name="temperature2" type="text" class="form-control txtbx" id="temperature2"  value="{{$temperatures['temperature2']}}"><span id="deg">°</span>
      </div>
      <br><br>

      <!--更新ボタン-->
      <input class="btn btn-info" type="submit" value="更新">
    </form>
  </div>
</div>
@endsection
