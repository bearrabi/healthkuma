@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Weight</h2>
  <div class="row">
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr><th scope="col">Date</th><th scope="col">Weight</th><th scope="col">Operation</th></tr>
      </thead>
      <tbody>
      @foreach ($weights as $weight)
        <tr>
          <td>{{$weight->measure_dt}}</td>
          <td>{{$weight->weight}} kg</td>
          <td>
            <div class="container">
            <div class="row">
              <a class="btn btn-primary" href="{{ action('WeightController@edit', $weight->id)}}">編集</a>
              <form id="delete" method="POST" action="{{ action('WeightController@destroy', $weight->id)}}">
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
  <br>
  <br>
  <br>
  <h2>Temperature</h2>
  <div class="row">
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr><th scope="col">Date</th><th scope="col">Weight</th><th scope="col">Operation</th></tr>
      </thead>
      <tbody>
      @foreach ($temps as $temp)
        <tr>
          <td>{{$temp->measure_dt}}</td>
          <td>{{$temp->temperature}}°</td>
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
