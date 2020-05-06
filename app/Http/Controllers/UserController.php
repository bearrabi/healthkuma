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
        return view('user.index', compact('weights','temps'));
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
