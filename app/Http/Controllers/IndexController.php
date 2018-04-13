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
use Illuminate\Support\Collection;

class IndexController extends SiteController
{
    protected $today;
    protected $yesterday;
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
        $this->today = Carbon::now()->format('d-m-Y');
        $this->yesterday = Carbon::now()->subDay()->format('d-m-Y');
    }

    public function index(Server $server, Request $request)
    {
        $rate_id = isset($request->rate) ? $request->rate : "all";
        $chronicle_id = isset($request->chronicle) ? $request->chronicle : "all";
        $rates = Rate::orderBy('sort')->get();
        $chronicles = Chronicle::orderBy('sort')->get();
        $ads = Ad::get();
        $partners = Partner::get();
        $this->inc_js = "
        <script>
        jQuery(document).ready(function(){
            $('.drop-filter').click(function(){
                $('#rate').prop('selectedIndex',0);
                $('#chronicle').prop('selectedIndex',0);
            })
        });
        </script>
        ";
        $inp_rates = array("all" => "Все рейты");
        $inp_chronicles = array("all" => "Все хроники");
        foreach ($rates as $rate) {
            $inp_rates = array_add($inp_rates, $rate->id, $rate->name);
        }
        foreach ($chronicles as $chronicle) {
            $inp_chronicles = array_add($inp_chronicles, $chronicle->id, $chronicle->name);
        }
        $this->inputs = array_add($this->inputs, "rates", $inp_rates);
        $this->inputs = array_add($this->inputs, "chronicles", $inp_chronicles);
        $date = Carbon::now();
        $start_week = $date->copy()->startOfWeek();
        //@TODO:Ордер
        $date_week = [
            $start_week->format('d') => $server->Day($start_week->toDateString())->Active()->get(),
            $start_week->addDay()->format('d') => $server->Day($start_week->toDateString())->Active()->get(),
            $start_week->addDay()->format('d') => $server->Day($start_week->toDateString())->Active()->get(),
            $start_week->addDay()->format('d') => $server->Day($start_week->toDateString())->Active()->get(),
            $start_week->addDay()->format('d') => $server->Day($start_week->toDateString())->Active()->get(),
            $start_week->addDay()->format('d') => $server->Day($start_week->toDateString())->Active()->get(),
            $start_week->addDay()->format('d') => $server->Day($start_week->toDateString())->Active()->get()
        ];
        setlocale(LC_TIME, 'ru_RU.utf8');
        $this_day = $date->format('d');
//        $this_month = iconv("cp1251", "UTF-8", $date->formatLocalized('%B'));
        $this_month = $date->formatLocalized('%B');
        $nominations = $this->nom_rep->get("*");
        $servers["yesterday"] = $this->getServers($server->Yesterday()->Active()->orderBy("start_at", "desc"), $rate_id, $chronicle_id);
        $servers["week"] = $this->getServers($server->Week()->Active()->orderBy("start_at", "desc"), $rate_id, $chronicle_id);
        $servers["seven_days"] = $this->getServers($server->SevenDays()->Active()->orderBy("start_at", "desc"), $rate_id, $chronicle_id);
        $servers["opened"] = $this->getServers($server->Opened()->Active()->orderBy("start_at", "desc"), $rate_id, $chronicle_id);
        $servers["vipOpened"] = $this->getServers($server->OpenedVip()->orderBy("start_at", "desc"), $rate_id, $chronicle_id);
        $servers["vipOpen"] = $this->getServers($server->OpenVip()->orderBy("start_at", "desc"), $rate_id, $chronicle_id);
        $this->content = view('main')->with(["servers" => $servers, "nominations" => $nominations, "date_week" => $date_week, "this_day" => $this_day, "this_month" => $this_month, "inputs" => $this->inputs, "ads" => $ads, "today" => $this->today, "yesterday" => $this->yesterday])->render();
        return $this->renderOutput();
    }


    private function randomizeDuplicate(Collection $group)
    {
        $unique = $group->unique(function ($item) {
            return $item->start_at->format('d-m-Y');
        });
        $dublicated = $group->diffAssoc($unique);
        // Проверяем есть дубликаты?
        if ($dublicated->count() > 0) {
            // Проверяем сколько разновидностей дубликатов встречелось
            $unique_dublicated = $dublicated->unique(function ($item) {
                return $item->start_at->format('d-m-Y');
            });
            //Идем по дубликатам
            foreach ($unique_dublicated as $dub) {
                //Значение дублированного поля
                $dublicate_value = $dub->start_at->format('d-m-Y');
                //Отбираем из исходной коллекции все объекты по дублированному полю
                $temp_dublicate = $group->filter(function ($value, $key) use ($dublicate_value) {
                    return $value->start_at->format("d-m-Y") == $dublicate_value;
                });
                //Перемешиваем отобранные
                $random_temp_dub = $temp_dublicate->shuffle();
                //Получем ключи в основном массиве
                $keys = $temp_dublicate->keys()->toArray();
                //Заменяем на перемешенные
                $i = 0;
                foreach ($random_temp_dub as $random) {
                    $group->splice($keys[$i], 1, [$random]);
                    $i++;
                }
            }
        }

        return $group;
    }

    private function getServers($query, $rate, $chronicle)
    {
        if ($rate != "all") {
            $query->Rate($rate);
        }
        if ($chronicle != "all") {
            $query->Chronicle($chronicle);
        }
        $servers = $query->get();
        $groups = $servers->groupBy("status_id");
        foreach ($groups as $group) {
            $group = $this->randomizeDuplicate($group);
        }
        return $groups;
    }
}
