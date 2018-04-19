<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        return $query->whereDate('start_at', date('Y-m-d', strtotime( '-1 days' )));
    }

    public function scopeToday($query) {
        return $query->whereDate('start_at', date('Y-m-d'));
    }

    public function scopeOpened($query) {
        return $query->whereDate('start_at', "<", date("Y-m-d"));
    }

    public function scopeOpenVip($query) {
        return $query->whereDate('start_at', ">=", date("Y-m-d"))->whereModerated('1')->where("status_id", ">", "2");
    }

    public function scopeOpenedVip($query) {
        return $query->whereDate('start_at', "<", date("Y-m-d"))->whereModerated('1')->where("status_id", ">", "2");
    }

    public function scopeDay($query, $date) {
        return $query->whereDate('start_at', $date);
    }

    public function scopeWeek($query) {
        return $query->whereDate('start_at', ">", date("Y-m-d", strtotime( '+7 days' )));
    }

    public function scopeSevenDays($query) {
        return $query->whereDate('start_at', ">", date("Y-m-d", strtotime( '-1 days' )))->whereDate('start_at', "<", date("Y-m-d", strtotime( '+8 days' )));
    }

    public function scopeRate($query, $rate){
        return $query->where("rate_id", $rate);
    }

    public function scopeChronicle($query, $chronicle) {
        return $query->where("chronicle_id", $chronicle);
    }

    public function scopeActive($query) {
        return $query->whereModerated('1');
    }

    public function scopeModerating($query) {
        return $query->whereModerated('0');
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
