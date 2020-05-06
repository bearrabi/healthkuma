@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-2">
      <h2>Temperature</h2>
    </div>
    <div class="col-md-4">
      <a class="btn btn-primary" href="{{ action('TemperatureController@create')}}">新規作成</a>
    </div>
  </div>
  <div class="row">
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr><th scope="col">Date</th><th scope="col">Weight</th><th scope="col">Operation</th></tr>
      </thead>
      <tbody>
      @foreach ($temps as $temp)
        <tr>
          <td>{{$temp->measure_dt}}</td>
          <td>{{$temp->temperature}} kg</td>
          <td>
            <div class="container">
            <div class="row">
              <a class="btn btn-primary" href="{{ action('TemperatureController@edit', $temp->id)}}">編集</a>
              <form id="delete" method="POST" action="{{ action('TemperatureController@destroy', $temp->id)}}">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger" value="削除" onClick="delete_alert(event); return false;">
              </form>
              </div>
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
