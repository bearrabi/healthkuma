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

      <!--年月日-->
      @component('layouts.components.date_create_form', ['years' => $years, 'months' => $months, 'days' => $days])
      @endcomponent

      <br><br>

      <!--時分秒-->
      @component('layouts.components.time_create_form', ['hours' => $hours, 'minutes' => $minutes, 'seconds' => $seconds])
      @endcomponent
      <br><br>

      <!--体重-->
      @component('layouts.components.main_create_form',['contents_name' => 'weight', 'label_name' => '体重', 'unit' => 'Kg'])
      @endcomponent
      <br><br>

      <!--更新ボタン-->
      <input class="btn btn-info" type="submit" value="登録">
    </form>
  </div>
</div>
@endsection
