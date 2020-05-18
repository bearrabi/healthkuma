<table class="calender" border="1">
  <tr>
    <th class="day_name h_sunday">日</th>
    <th class="day_name h_weekday">月</th>
    <th class="day_name h_weekday">火</th>
    <th class="day_name h_weekday">水</th>
    <th class="day_name h_weekday">木</th>
    <th class="day_name h_weekday">金</th>
    <th class="day_name h_saturday">土</th>
  </tr>
  @foreach($month as $week)
    <tr>  <!--$day = 0：日,　1：月,　2：火,　3：水,　4：木,　5：金,　6：土-->
    @foreach($week as $day)
      <td>
        <div class="number {{$day['type']}}">{{$day['day']}}</div>
      </td>
    @endforeach
    </tr>
  @endforeach
</table>
<style>
  .calender{ width: 100%;}
  .calender tr th,.calender tr td{  text-align: center; }
  .calender tr th{  font-size: 16px; font-weight: bold; }
  .calender tr td{  height: 100px; }
  .calender tr td:hover{  background-color: rgba(127,255,212,0.5);}

  /*曜日に合わせて色をセット*/
  .h_sunday{      color: rgb(230,0,0);          }
  .h_saturday{    color: rgb(30,144,255);       }
  .sunday{        color: rgb(230,0,0);          }
  .saturday{      color: rgb(30,144,255);       }
  .weekday{       color: rgb(15,15,15);         }
  .other_month{   color: rgba(169,169,169,0.5); }
  .day_name,.number{ font-family:'メイリオ', 'Meiryo', sans-serif;   }
</style>