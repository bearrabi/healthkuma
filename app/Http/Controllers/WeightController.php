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
        return view('weight.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('weight.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $weight->weight = $request->weight1.".".$request->weight2;
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
       
    }
}
