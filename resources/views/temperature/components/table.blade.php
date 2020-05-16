<table class="table table-striped">
  <thead class="thead-dark">
    <tr><th scope="col">Date</th><th scope="col">Temperature</th><th scope="col">Operation</th></tr>
  </thead>
  <tbody>
  @foreach ($temps as $temp)
    <tr>
      <td>{{$temp->measure_dt}}</td>
      <td>{{$temp->temperature}} kg</td>
      <td>
      @component('user.components.inline_btn',['id'               => $temp->id,
                                      'action_edit'    => 'TemperatureController@edit',
                                      'action_destroy' => 'TemperatureController@destroy']
      )
      @endcomponent
      </td>
    </tr>
  @endforeach
  </tbody>
</table>