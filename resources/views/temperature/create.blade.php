@extends('layouts.app')

@section('content')
<style>
.txtbx,.selectbx{margin: 0 5px 0 25px;}
#dot,#deg{ 
  font-weight: bold;
  font-size: 24px;
}
</style>
<div class="container">
  <div class="row">
    <form method="POST" action="{{ route('temperature.store') }}">
    @csrf
      <!--日付-->
      <div class="form-group">
        <label for="year">日付</label>
      </div>
      <div class="form-inline">
        <select name="year" id="year" class="form-control selectbx">
            @foreach($years as $key => $value)
              @if ($value == true)
                <option value="{{$key}}" selected>{{$key}}</option>
              @else
                <option value="{{$key}}">{{$key}}</option>
              @endif
            @endforeach
        </select>年
        <select name="month" id="month" class="form-control selectbx">
            @foreach($months as $key => $value)
              @if ($value == true)
                <option value="{{$key}}" selected>{{$key}}</option>
              @else
                <option value="{{$key}}">{{$key}}</option>
              @endif
            @endforeach
        </select>月
        <select name="day" id="day" class="form-control selectbx">
            @foreach($days as $key => $value)
              @if ($value == true)
                <option value="{{$key}}" selected>{{$key}}</option>
              @else
                <option value="{{$key}}">{{$key}}</option>
              @endif
            @endforeach
        </select>日
      </div>
      <br><br>

      <!--時刻-->
      <div class="form-group">
        <label for="hour">時刻</label>
      </div>
      <div class="form-inline">
      <select name="hour" id="hour" class="form-control selectbx">
            @foreach($hours as $key => $value)
              @if ($value == true)
                <option value="{{$key}}" selected>{{$key}}</option>
              @else
                <option value="{{$key}}">{{$key}}</option>
              @endif
            @endforeach
        </select>時
        <select name="minute" id="minute" class="form-control selectbx">
            @foreach($minutes as $key => $value)
              @if ($value == true)
                <option value="{{$key}}" selected>{{$key}}</option>
              @else
                <option value="{{$key}}">{{$key}}</option>
              @endif
            @endforeach
        </select>分
        <select name="second" id="second" class="form-control selectbx">
            @foreach($seconds as $key => $value)
              @if ($value == true)
                <option value="{{$key}}" selected>{{$key}}</option>
              @else
                <option value="{{$key}}">{{$key}}</option>
              @endif
            @endforeach
        </select>秒
        
      </div>
      <br><br>

      <!--体温-->
      <div class="form-group">
        <label for="weight1">体温</label>
      </div>
      <div class="form-inline">
        <input name="weight1" type="text" class="form-control txtbx" id="weight1"><span id="dot">.</span>
        <input name="weight2" type="text" class="form-control txtbx" id="weight2"><span id="deg">°</span>
      </div>
      <br><br>

      <!--更新ボタン-->
      <input class="btn btn-info" type="submit" value="登録">
    </form>
  </div>
</div>
@endsection
