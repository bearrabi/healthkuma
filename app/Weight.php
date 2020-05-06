<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    //ユーザーテーブルとのリレーション
    public function user(){ return $this->belongsTo('App\User');    }
}
