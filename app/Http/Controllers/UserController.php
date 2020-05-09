<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;       //ユーザーモデル
use App\Weight;     //weightモデル
use App\Temperature;//temperatureモデル

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

        //set graph data
        $send_views_js_json = array();
        $index_arr_1d = -1;
        foreach($weights as $value){
            
            //fecth year and month from weights table for create array label name;
            $json_val_year_month = date('Y/m', strtotime($value->measure_dt));

            //set new year_month to json array
            $lblnm_year_month = "year_month";
            if ($index_arr_1d == -1 || 
                $send_views_js_json[$index_arr_1d][$lblnm_year_month] != $json_val_year_month){
                $index_arr_1d++;
                $send_views_js_json[$index_arr_1d] = ['year_month' => $json_val_year_month]; 
            }

            //set day's info to json array
            $measure_day    = date('d',strtotime($value->measure_dt));
            $measure_weight = $value->weight;
            $arr_day_and_weight = ['day' => $measure_day, 'weight' => $measure_weight];
            $arr_weight_info = ['weight_info' => $arr_day_and_weight];
            $send_views_js_json[$index_arr_1d][] = $arr_weight_info;
        }

        //encode array to json
        $dates_and_weights_json = json_encode($send_views_js_json);

        return view('user.index', compact('weights','temps','dates_and_weights_json'));
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
