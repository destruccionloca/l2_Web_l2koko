<?php

namespace App\Http\Controllers;

use App\Repositories\NominationsRepository;
use App\Repositories\PagesRepository;
use Illuminate\Http\Request;
use App\Server;
use Carbon\Carbon;

class IndexController extends SiteController
{
    protected $nom_rep;

    public function __construct(NominationsRepository $nom_rep)
    {
        parent::__construct(new \App\Repositories\ServersRepository(new \App\Server), new \App\Repositories\SettingsRepository(new \App\Setting()), new \App\Repositories\PagesRepository(new \App\Page()));
        $this->template = 'index';
        $this->title = $this->settings['title'];
        $this->description = $this->settings['description'];
        $this->keywords = $this->settings['keywords'];
        $this->nom_rep = $nom_rep;
    }

    public function index(Server $server) {
        $date = Carbon::now();
        $start_week = (int) $date->copy()->startOfWeek()->format('d');
        $date_week = [$start_week, $start_week+1, $start_week+2, $start_week+3, $start_week+4, $start_week+5, $start_week+6];
        $this_day = (int) $date->format('d');
        $server_day = $server->Day(8,2)->get();
        dd($server_day);
        $servers = $server->all();
        $nominations = $this->nom_rep->get("*");
        $yesterday = $server->Yesterday()->get();
        $opened = $server->Open()->get();
        $week = $server->Week()->get();
        $seven_days =  $server->SevenDays()->get();
        $this->content = view('main')->with(["servers" => $servers, "yesterday" => $yesterday, "opened" => $opened, "week" => $week, "seven_days" => $seven_days, "nominations" => $nominations, "date_week" => $date_week, "this_day" => $this_day])->render();
        return $this->renderOutput();
    }
}
