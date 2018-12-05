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
        'name',
        'h1',
        'p',
        'title'
    ];



    public function scopeYesterday($query) {
        return $query->whereDate('start_at', date('Y-m-d', strtotime( '-1 days' )));
    }

    public function scopeTomorrow($query) {
        return $query->whereDate('start_at', date('Y-m-d', strtotime( '+1 days' )));
    }

    public function scopeToday($query) {
        return $query->whereDate('start_at', date('Y-m-d'));
    }

    public function scopeOpened($query) {
        return $query->whereDate('start_at', "<", date("Y-m-d"))->whereDate('start_at', '>', date("Y-m-d", strtotime("-30 days")));
    }

    public function scopeOpenVip($query) {
        return $query->whereDate('start_at', ">=", date("Y-m-d"))->whereModerated('1')->where("status_id", ">", "2");
    }

    public function scopeOpenedVip($query) {
        return $query->whereDate('start_at', "<", date("Y-m-d"))->whereModerated('1')->where("status_id", ">", "2")->whereDate('start_at', '>', date("Y-m-d", strtotime("-30 days")));
    }

    public function scopeDay($query, $date) {
        return $query->whereDate('start_at', $date);
    }

    public function scopeWeek($query) {
        return $query->whereDate('start_at', ">", date("Y-m-d", strtotime( '+7 days' )));
    }

    public function scopeSevenDays($query) {
        return $query->whereDate('start_at', ">", date("Y-m-d", strtotime( '+1 days' )))->whereDate('start_at', "<", date("Y-m-d", strtotime( '+8 days' )));
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

    public function scopeNotVip($query) {
        $query->where("status_id", "<", "3");
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
