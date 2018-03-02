<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomination extends Model
{
    public function server() {
        return $this->belongsTo('App\Server');
    }

    public function applications() {
        return $this->hasMany('App\Application');
    }
}
