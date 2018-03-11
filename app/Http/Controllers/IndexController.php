<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Chronicle;
use App\Partner;
use App\Rate;
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
        parent::__construct(
            new \App\Repositories\ServersRepository(new \App\Server),
            new \App\Repositories\SettingsRepository(new \App\Setting()),
            new \App\Repositories\PagesRepository(new \App\Page()),
            new \App\Repositories\PartnersRepository(new \App\Partner())
        );
        $this->template = 'index';
        $this->title = $this->settings['title'];
        $this->description = $this->settings['description'];
        $this->keywords = $this->settings['keywords'];
        $this->nom_rep = $nom_rep;
    }

    public function index(Server $server, Request $request) {
        $rate_id = isset($request->rate)? $request->rate : "all";
        $chronicle_id = isset($request->chronicle)? $request->chronicle : "all";
        $rates = Rate::get();
        $chronicles = Chronicle::get();
        $ads = Ad::get();
        $partners = Partner::get();
        $inp_rates = array("all" => "Все рейты");
        $inp_chronicles = array("all" => "Все хроники");
        foreach ($rates as $rate) {
            $inp_rates = array_add($inp_rates, $rate->id, $rate->name );
        }
        foreach ($chronicles as $chronicle) {
            $inp_chronicles = array_add($inp_chronicles, $chronicle->id, $chronicle->name );
        }
        $this->inputs = array_add($this->inputs, "rates", $inp_rates);
        $this->inputs = array_add($this->inputs, "chronicles", $inp_chronicles);
        setlocale(LC_TIME, 'RU');
        $date = Carbon::now();
        $start_week = $date->copy()->startOfWeek();
        $date_week = [
            $start_week->format('d') => $server->Day($start_week->toDateString())->Active()->get(),
            $start_week->addDay()->format('d') => $server->Day($start_week->toDateString())->Active()->get(),
            $start_week->addDay()->format('d') => $server->Day($start_week->toDateString())->Active()->get(),
            $start_week->addDay()->format('d') => $server->Day($start_week->toDateString())->Active()->get(),
            $start_week->addDay()->format('d') => $server->Day($start_week->toDateString())->Active()->get(),
            $start_week->addDay()->format('d') => $server->Day($start_week->toDateString())->Active()->get(),
            $start_week->addDay()->format('d') => $server->Day($start_week->toDateString())->Active()->get()
        ];
        $this_day = $date->format('d');
        $this_month = iconv("cp1251", "UTF-8", $date->formatLocalized('%B'));
        $servers = [];
        $nominations = $this->nom_rep->get("*");
        $servers["yesterday"] = $this->getServers($server->Yesterday()->Active()->orderBy("status_id", "desc")->orderBy("start_at", "desc"), $rate_id, $chronicle_id);
        $servers["week"] = $this->getServers($server->Week()->Active()->orderBy("status_id", "desc")->orderBy("start_at", "desc"), $rate_id, $chronicle_id);
        $servers["seven_days"] =  $this->getServers($server->SevenDays()->Active()->orderBy("status_id", "desc")->orderBy("start_at", "desc"), $rate_id, $chronicle_id);
        $servers["opened"] =  $this->getServers($server->Open()->Active()->orderBy("status_id", "desc")->orderBy("start_at", "desc"), $rate_id, $chronicle_id);
        $this->content = view('main')->with(["servers" => $servers, "nominations" => $nominations, "date_week" => $date_week, "this_day" => $this_day, "this_month" => $this_month, "inputs" => $this->inputs, "ads" => $ads])->render();
        return $this->renderOutput();
    }

    private function getServers($query, $rate, $chronicle) {
        if($rate != "all") {
            $query->Rate($rate);
        }
        if ($chronicle != "all") {
            $query->Chronicle($chronicle);
        }

        return $query->get();

    }
}
