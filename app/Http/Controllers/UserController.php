<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;       //ユーザーモデル
use App\Weight;     //weightモデル
use App\Temperature;//temperatureモデル
use \Yasumi\yasumi;
use Carbon\CarbonImmutable;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //show grapgh
    public function index()  
    {
        //get auth ID
        $id = auth()->user()->id;

        //get user's weights info
        $weights = Weight::where('user_id', $id)->orderby('measure_dt')->get();

        //get user's templeture info
        $temps = Temperature::where('user_id', $id)->orderby('measure_dt')->get();

        //get current month calender info of weight
        $weights_calender = $this->CreateCalenderInfo($weights);

        //get current month calender info of temperature
        $temps_calender = $this->CreateCalenderInfo($temps);

        //create views graph data at weight
        $weights_info_before_json = $this->CretateViewsGraphData($weights , 'weight');
        
        //create views graph data at temperature
        $temps_info_before_json = $this->CretateViewsGraphData($temps , 'temperature');

        //encode array to json at weight
        $json_for_graph_w = json_encode($weights_info_before_json);

        //encode array to json at temperature
        $json_for_graph_t = json_encode($temps_info_before_json);

        return view('user.index', compact('weights','temps','json_for_graph_w','json_for_graph_t','weights_calender','temps_calender'));
    }

    //create view's graph data
    private function CretateViewsGraphData($m_arr_from_db, $m_contents_title){
        
        $send_to_view_json = array();
        $first_dimension_index = -1;

        //set graph data to array
        $year_month_lblnm = 'year_month';
        foreach($m_arr_from_db as $row){
            
            //fetch year_and_month from db row
            $year_month_value = date('Y/m', strtotime($row->measure_dt));

            //write year_month label name and value
            if ($first_dimension_index == -1 || 
                $send_to_view_json[$first_dimension_index][$year_month_lblnm] != $year_month_value){
                $first_dimension_index++;
                $send_to_view_json[$first_dimension_index] = ['year_month' => $year_month_value]; 
            }

            //fetch data per day from db row
            $measure_day    = date('d',strtotime($row->measure_dt));
            if ($m_contents_title == 'weight'       ){  $measure_value = $row->weight;       }
            if ($m_contents_title == 'temperature'  ){  $measure_value = $row->temperature;  }

            //write db data per day 
            $measure_values_from_row = ['day' => $measure_day, $m_contents_title => $measure_value];
            $arr_weight_info = [ $m_contents_title.'_info' => $measure_values_from_row];
            $send_to_view_json[$first_dimension_index][] = $arr_weight_info;
        }
        return $send_to_view_json;
    }


    //create view's current month calender info
    /*
            month[
                [
                    [ day => '31', type => 'sunday'],
                    [ day => '1', type => 'weekday' ],
                    [ day => '2', type => 'weekday' ],
                    [ day => '3', type => 'weekday' ],
                    [ day => '4', type => 'weekday' ],
                    [ day => '5', type => 'weekday' ],
                    [ day => '6', type => 'saturday']
                ],[
                    [ day => '7', type => 'sunday'],
                    [ day => '8', type => 'weekday'],
                    [ day => '9', type => 'weekday'],
                    [ day => '10', type => 'weekday'],
                    [ day => '11', type => 'holiday'],
                    [ day => '12', type => 'weekday'],
                    [ day => '13', type => 'saturday']
                ]
            ]....

            
    */
    private function CreateCalenderInfo(){

        //get today 
        $now = CarbonImmutable::now();

        //get current year
        $current_year = $now->year;

        //get Japan holidays
        $holidays = Yasumi::create('Japan', $current_year, 'ja_JP');

        //get month info
        $month = $this->CreateCalenderMonthInfo($now, $holidays);

        return $month;
    }

    //create first weeks info
    private function CreateCalenderMonthInfo($m_now, $m_holidays){

        //set week start adn week end
        CarbonImmutable::setWeekStartsAt(CarbonImmutable::SUNDAY);
        CarbonImmutable::setWeekEndsAt(CarbonImmutable::SATURDAY);

        //get first day and last day of month
        $first_day_of_month = $m_now->firstOfMonth();
        $last_day_of_month = $m_now->lastOfMonth();
        
        //get first day and last day of week
        $first_day_of_first_week = $first_day_of_month->startOfWeek();
        $last_day_of_last_week = $last_day_of_month->endOfWeek();

        //set month info array
        $month_info = [];
        $day = new Carbon($first_day_of_first_week);
        $index = 0;
        while(TRUE){
            //$type: 'sunday' or 'saturday' or 'weekday' or 'holiday' of 'other_month' for set color of calender
            $type = $this->GetDayType($day, $m_holidays);

            //array by 1week
            $week_info[] = ['day' => $day->day, 'type' => $type];
            
            //array by multi week for create 1month info
            if ($type == "saturday"){ $month_info[] = $week_info;   $week_info = [];  }
            
            //break while when day is last day of month
            if ($day->isSameday($last_day_of_last_week)){ $month_info[] = $week_info; break;    }

            //next day
            $day->addDay();
        }
        
        return $month_info;
    }
    
    //sunday or saturday or weekday or holiday
    private function GetDayType($m_day, $m_holidays_arr){
        
        if ( !$m_day->isCurrentMonth()){ return "other_month";   }
        if ( $m_day->isSunday()  ){     return "sunday";        }
        if ( $m_day->isSaturday()){     return "saturday";      }
        
        foreach($m_holidays_arr as $holiday){
            if ( $m_day->isSameday($holiday) ){   return "holiday";   }
        }

        return "weekday";

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //show list and graph
    public function show($id)
    {
        return view('user.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //edit username or password
    public function edit($id)
    {
        return view('user.edit');        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //delete user info
    public function destroy($id)
    {
        //
    }
}
