@extends('layouts.app')
@include('layouts.sections.header')
@include('layouts.sections.navbar')
@section('content')
<style>
  .graph{ width: 100%;  }
  .user-views{  height: 620px;}
</style>
<div class="container">

  <h2>Weight</h2>
  <div class="row user-views">
    <div class="graph" id="w-graph-0"></div>
  </div>

  <div class="row user-views">
    @component('weight.components.table',['weights' => $weights, 'title_base' => $title_base])   @endcomponent
  </div>

  <div class="row user-views">
    @component('layouts.components.calender', ['month' => $weights_calender, 'title_base' => $title_base])   @endcomponent
  </div>

  <br>
  <br>
  <br>

  <h2>Temperature</h2>
  <div class="row user-views">
    <div class="graph" id="t-graph-0"></div>
  </div>

  <div class="row user-views">
    @component('temperature.components.table',['temps' => $temps, 'title_base' => $title_base])  @endcomponent
  </div>

  <div class="row user-views">
    @component('layouts.components.calender', ['month' => $temps_calender, 'title_base' => $title_base])   @endcomponent
  </div>

</div>

<script src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    // パッケージのロード
    google.charts.load('current', {packages: ['corechart']});
    // ロード完了まで待機
    google.charts.setOnLoadCallback(drawChart_w);
    google.charts.setOnLoadCallback(drawChart_t); 

    // コールバック関数の実装
    function drawChart_w() {
        // PHPからjsonデータは取得
        let json_data = <?php echo $json_for_graph_w; ?>;
        
        let measured_contents = 'weight';
        let chart_labels_arr  = ['日付','体重'];
        let chart_title_base  = '体重の推移'
        let graph_tag_id_base = 'w-graph-';

        //チャートの描画
        DrawChart(measured_contents, chart_labels_arr, chart_title_base, graph_tag_id_base, json_data);
    }

    //コールバック関数の実装
    function drawChart_t() {
        // PHPからjsonデータは取得
        let json_data = <?php echo $json_for_graph_t; ?>;
        
        //描画用関数に渡す引数の準備
        let measured_contents = 'temperature';
        let chart_labels_arr  = ['日付','体温'];
        let chart_title_base  = '体温の推移'
        let graph_tag_id_base = 't-graph-';

        //チャートの描画
        DrawChart(measured_contents, chart_labels_arr, chart_title_base, graph_tag_id_base, json_data);
    }

    //チャート描画用関数
    function DrawChart(m_measured_contetns, m_arr_chart_labels, m_chart_title_base, m_graph_tag_id_base, m_json_data){

      //毎月のデータをセット
      for (let i=0;i<m_json_data.length;i++){
      
        //ラベルを初期化
        let json_labels_arr =[m_arr_chart_labels];
        
        //チャートを表示する対象の年月を取得
        let year_month = m_json_data[i]['year_month'];

        //グーグルチャートで表示するテーブルに変換前のデータを作成
        let datas_before_cnv_gtable = CreateDataBeforeConvGoogleTable(m_measured_contetns, m_arr_chart_labels, year_month, m_json_data[i]);

        //googleチャートで表示する様式に配列を変換する
        let show_gchart_table = google.visualization.arrayToDataTable(datas_before_cnv_gtable);

        //表示するグラフのオプションを設定
        var options = {
            title: m_chart_title_base + ' ' + year_month,
            seriesType: "line",
            series: {1: {type: "line"}}
        };

        //グラフの挿入場所を検索する時のID名
        let id_name = m_graph_tag_id_base + i.toString();
        
        // インスタンス化と描画
        let graph_obj = document.getElementById(id_name);
        var chart = new google.visualization.ComboChart(graph_obj);
        chart.draw(show_gchart_table, options);

        //次のグラフの準備
        let next_graph_id_name = m_graph_tag_id_base + (i+1).toString();
        graph_obj.insertAdjacentHTML('afterend',"<div class='graph' id='"+next_graph_id_name+"'></div>");
      }
    }

    //グーグルチャートに表示するテーブルデータに変換する前のデータを作成
    function CreateDataBeforeConvGoogleTable(m_measured_contetns, m_arr_chart_labels, m_year_month, m_json_data_row){

      //テーブル変換前の配列データを初期化　　※ヘッダーをセット
      let datas_before_conv_google_table = [m_arr_chart_labels];

      //jsonデータから日付に紐づいた情報を配列へ格納
      Object.keys(m_json_data_row).forEach(function(key){
        
        //PHPから受け取ったjsonデータから年月とそれぞれの値を取得
        if (key != 'year_month'){

            //取得対象のjsonデータのラベル名をセット
            let measured_contents_info_label = m_measured_contetns + '_info';

            //対象ラベル名から、日付と測定したデータを取得する
            let day_number = m_json_data_row[key][measured_contents_info_label]['day'];
            let measured_val_float = parseFloat(m_json_data_row[key][measured_contents_info_label][m_measured_contetns]);

            //取得したデータをグラフで表示するための配列に格納する
            datas_before_conv_google_table.push([day_number,measured_val_float]);
          }
        });

        return datas_before_conv_google_table;
    }
  </script>
@endsection
