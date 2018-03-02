<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $dates = ['start_at', "created_at", "updated_at"];

    protected $fillable = [
        'alias',
        'link',
        'start_at',
        'email',
        'short_desc',
        'description',
        'social_vk',
        'social_fb',
        'social_tw',
        'social_icq',
        'name'
    ];

    public function scopeYesterday($query) {
        return $query->whereDay('start_at', date('d', strtotime( '-1 days' )));
    }

    public function scopeOpen($query) {
        return $query->whereDate('start_at', "<", date("Y-m-d"));
    }

    public function scopeWeek($query) {
        return $query->whereDate('start_at', ">", date("Y-m-d", strtotime( '+7 days' )));
    }

    public function scopeSevenDays($query) {
        return $query->whereDate('start_at', ">", date("Y-m-d", strtotime( '-1 days' )))->whereDate('start_at', "<", date("Y-m-d", strtotime( '+8 days' )));
    }

    public function chronicle() {
        return $this->belongsTo('App\Chronicle');
    }

    public function rate() {
        return $this->belongsTo('App\Rate');
    }

    public function status() {
        return $this->belongsTo('App\Status');
    }

    public function applications() {
        return $this->hasMany('App\Application');
    }
}
