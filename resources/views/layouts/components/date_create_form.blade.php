<div class="form-group">
  <label for="year">日付</label>
</div>
<div class="form-inline">
  <!--年-->
  <select name="year" id="year" class="form-control selectbx">
    @foreach($years as $key => $value)
      @if ($value == true)
        <option value="{{ $key }}" selected>{{ $key }}</option>
      @else
        <option value="{{ $key }}">{{ $key }}</option>
      @endif
    @endforeach
  </select>年

  <!--月-->
  <select name="month" id="month" class="form-control selectbx">
      @foreach($months as $key => $value)
        @if ($value == true)
          <option value="{{ $key }}" selected>{{ $key }}</option>
        @else
          <option value="{{ $key }}">{{ $key }}</option>
        @endif
      @endforeach
  </select>月

  <!--日-->
  <select name="day" id="day" class="form-control selectbx">
      @foreach($days as $key => $value)
        @if ($value == true)
          <option value="{{ $key }}" selected>{{ $key }}</option>
        @else
          <option value="{{ $key }}">{{ $key }}</option>
        @endif
      @endforeach
  </select>日
</div>