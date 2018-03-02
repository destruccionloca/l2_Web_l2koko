<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public function servers() {
        return $this->hasMany('App\Server');
    }

    protected $fillable = [
        'name',
        'sort'
    ];
}
