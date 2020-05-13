@extends('layouts.app')
@include('layouts.sections.header')
@include('layouts.sections.navbar')
@section('content')
<style>
.txtbx,.selectbx{margin: 0 5px 0 25px;}
#dot{ 
  font-weight: bold;
  font-size: 24px;
}
</style>
<div class="container">
  <div class="row">
    <form method="POST" action="{{ route('weight.store') }}">
    @csrf

    @component('layouts.components.date_create_form', ['years' => $years, 'months' => $months, 'days' => $days])
    @endcomponent

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

      <!--体重-->
      <div class="form-group">
        <label for="weight1">体重</label>
      </div>
      <div class="form-inline">
        <input name="weight1" type="text" class="form-control txtbx" id="weight1"><span id="dot">.</span>
        <input name="weight2" type="text" class="form-control txtbx" id="weight2">kg
      </div>
      <br><br>

      <!--更新ボタン-->
      <input class="btn btn-info" type="submit" value="登録">
    </form>
  </div>
</div>
@endsection
