<div class="container">
  <div class="row">
    <a class="btn btn-primary" href="{{ action($action_edit, $id)}}">編集</a>
    <form id="delete" method="POST" action="{{ action($action_destroy, $id)}}">
      @csrf
      @method('DELETE')
      <input type="submit" class="btn btn-danger" value="削除" onClick="delete_alert(event); return false;">
    </form>
  </div>
</div>
