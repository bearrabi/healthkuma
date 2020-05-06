<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temperature;

class TemperatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get db data from weights table by id
        $temps = auth()->user()->temperatures;
        
        return view('temperature.index',compact('temps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //set years     ※±1month
        $now_year = date('Y');
        for ($i=0;$i<3;$i++){
            $year = $now_year - 1 + $i;
            if ($year == $now_year){    $years[$year] = true;}
            else{ $years[$year] = false;  }
        }

        //set months
        $now_month = date('m');
        for ($i=1;$i<13;$i++){  
            if ($i == $now_month){  $months[$i] = true; }
            else{   $months[$i] = false;   }
        }

        //set days
        $now_day = date('d');
        for ($i=1;$i<32;$i++){  
            if ($i == $now_day){    $days[$i] = true; }
            else{   $days[$i] = false; }
        }

        //set hours
        $now_hour = date('H');
        for ($i=0;$i<25;$i++){
            if ($i == $now_hour){  $hours[$i] = true;  }
            else{   $hours[$i] = false; }
        }

        //set minutes
        $now_minute = date('i');
        for ($i=0;$i<60;$i++){
            if ($i == $now_minute){  $minutes[$i] = true;  }
            else{   $minutes[$i] = false; }
        }
         
        //set seconds
        $now_second = date('s');
        for ($i=0;$i<60;$i++){
            if ($i == $now_second){  $seconds[$i] = true;  }
            else{   $seconds[$i] = false; }
        }
        
        return view('temperature.create', compact('years','months','days','hours','minutes','seconds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //set db data from auth id
        $id = auth()->user()->id;
        $date = $request->year.'-'.$request->month.'-'.$request->day;
        $time = ' '.$request->hour.':'.$request->minute.':'.$request->second;
        $temperature_req = (double)$request->temperature1.'.'.$request->temperature2;
    
        //write db data to weights table
        $temperature = new Temperature;
        $temperature->user_id = $id;
        $temperature->measure_dt = $date.$time;
        $temperature->temperature = $temperature_req;
        $temperature->save();

        return redirect('temperature');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('temperature.show');        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get db data from weights tables by id
        $temperature_info = Temperature::find($id);

        //divide date time 
        $dt_all = $temperature_info->measure_dt;
        $arr_temperature = explode(".", $temperature_info->temperature);

        //set argvs to edit view
        $temperatures = [
            'id' => $id,
            'year' => date('Y', strtotime($dt_all)),
            'month' => date('m',strtotime($dt_all)),
            'day' => date('d',strtotime($dt_all)),
            'hour' => date('H', strtotime($dt_all)),
            'minute' => date('i', strtotime($dt_all)),
            'second' => date('s', strtotime($dt_all)),
            'temperature1' => $arr_temperature[0],
            'temperature2' => $arr_temperature[1]
        ];

        return view('temperature.edit',compact('temperatures'));
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
         //get db data from weights table by id
         $temperature = Temperature::find($id);
        
         //set request data to weights table
         $temperature_req = (double)$request->temperature1.".".$request->temperature2;
         $temperature->temperature = $temperature_req;
         $temperature->save();
 
         return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $temperature = Temperature::find($id);
        $temperature->delete();

        return redirect('user');
    }
}
