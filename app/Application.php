<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public function nomination() {
        return $this->belongsTo('App\Nomination');
    }

    public function server() {
        return $this->belongsTo('App\Server');
    }
}
