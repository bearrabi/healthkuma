<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Weight;

class WeightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get db data from weights table by id
        $id = auth()->user()->id;
        $weights = Weight::where('user_id', $id)->get();
        //dd($weights);
        return view('weight.index', compact('weights'));
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
        
        return view('weight.create', compact('years','months','days','hours','minutes','seconds'));
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
        $weight_req = (double)$request->weight1.'.'.$request->weight2;
    
        //write db data to weights table
        $weight = new Weight;
        $weight->user_id = $id;
        $weight->measure_dt = $date.$time;
        $weight->weight = $weight_req;
        $weight->save();

        return redirect('weight');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('weight.show');
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
        $weight_info = Weight::find($id);

        //divide date time 
        $dt_all = $weight_info->measure_dt;
        $arr_weight = explode(".", $weight_info->weight);

        $weights = [
            'id' => $id,
            'year' => date('Y', strtotime($dt_all)),
            'month' => date('m',strtotime($dt_all)),
            'day' => date('d',strtotime($dt_all)),
            'hour' => date('H', strtotime($dt_all)),
            'minute' => date('i', strtotime($dt_all)),
            'second' => date('s', strtotime($dt_all)),
            'weight1' => $arr_weight[0],
            'weight2' => $arr_weight[1]
        ];
        //dd($weights);
        return view('weight.edit', compact('weights'));        
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
        $weight = Weight::find($id);
        
        //set request data to weights table
        $weight_req = (double)$request->weight1.".".$request->weight2;
        $weight->weight = $weight_req;
        $weight->save();

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
        //delete db data from weights table by id
        $weight = Weight::find($id);
        $weight->delete();

        return redirect('user');
    }
}
