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
      @component('user.components.inline_btn',['id'               => $weight->id,
                                      'action_edit'    => 'WeightController@edit',
                                      'action_destroy' => 'WeightController@destroy']
        )
      @endcomponent
      </td>
    </tr>
  @endforeach
  </tbody>
</table>