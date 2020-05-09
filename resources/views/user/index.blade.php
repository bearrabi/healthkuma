@extends('layouts.app')

@section('content')
<style>
  .graph{ 
    width: 100%;
    }
</style>
<div class="container">
  <h2>Weight</h2>
  <div class="row">
    <div class="graph" id="graph-0"></div>
  </div>
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
<script src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    // パッケージのロード
    google.charts.load('current', {packages: ['corechart']});
    // ロード完了まで待機
    google.charts.setOnLoadCallback(drawChart);

    // コールバック関数の実装
    function drawChart() {

        // PHPからjsonデータは取得
        let json_data = <?php echo $dates_and_weights_json; ?>;

        // 月毎のデータをセット
        let last_graph_obj;
        for(let i=0;i<json_data.length;i++){

          //変数の初期化
          let array_dates_and_weights = [['日付','体重']];
          let year_month = "";
          
          //日毎のデータをセット
          Object.keys(json_data[i]).forEach(function(key){
            if (key == 'year_month'){ year_month = json_data[i]['json_data'];}
            else{
              day_number = json_data[i][key]['weight_info']['day'];
              weight_float = parseFloat(json_data[i][key]['weight_info']['weight']);
              array_dates_and_weights.push([day_number,weight_float]);
            }
          });

          //表示用データに置換
          var data = google.visualization.arrayToDataTable(array_dates_and_weights);
          
          // オプション設定
          var options = {
              title: '体重の推移 '+json_data[i]['year_month'],
              seriesType: "line",
              series: {1: {type: "line"}}
          };

          //グラフの挿入場所を検索
          let id_name = "graph-"+i.toString();        

          // インスタンス化と描画
          let graph_obj = document.getElementById(id_name);
          var chart = new google.visualization.ComboChart(graph_obj);
          chart.draw(data, options);

          let next_graph_id_name = "graph-"+(i+1).toString();
          graph_obj.insertAdjacentHTML('afterend',"<div class='graph' id='"+next_graph_id_name+"'></div>");
        }

        
        //console.log('{{$dates_and_weights_json}}');
        //let domope = document.getElementById('graph');
        //domope.InnerText = '<p>{{Auth()->user()->id}}</p>';
    }
  </script>
@endsection
