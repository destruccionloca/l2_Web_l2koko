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
    protected $tomorrow;
    protected $nom_rep;
    protected $seo_text;
    protected $filter_url;

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
        $this->h1 = $this->settings['h1'];
        $this->filter_url = explode("-",$this->settings['filter_url']);
        $this->seo_text = null;
        $this->nom_rep = $nom_rep;
        $this->today = Carbon::now()->format('d-m-Y');
        $this->yesterday = Carbon::now()->subDay()->format('d-m-Y');
        $this->tomorrow = Carbon::now()->addDay()->format('d-m-Y');
    }

    public function index(Server $server, Request $request)
    {
        $rate_id = isset($request->rate) ? $request->rate : "all";
        $chronicle_id = isset($request->chronicle) ? $request->chronicle : "all";
        $rates = Rate::orderBy('sort')->get();
        $chronicles = Chronicle::orderBy('sort')->get();
        if($rate_id != "all" && $chronicle_id != "all") {
            $temp_rate = Rate::find($rate_id);
            $temp_chronicle = Chronicle::find($chronicle_id);
            $this->title = preg_replace(["%rate%", "%chronicle%", "/\[R\]/", "/\[\/R\]/", "/\[C\]/", "/\[\/C\]/"],[$temp_rate->name, $temp_chronicle->name, "", "", "", ""],$this->settings['filter_title']);
            $this->description = preg_replace(["%rate%", "%chronicle%", "/\[R\]/", "/\[\/R\]/", "/\[C\]/", "/\[\/C\]/"],[$temp_rate->name, $temp_chronicle->name, "", "", "", ""],$this->settings['filter_description']);
            $this->keywords = preg_replace(["%rate%", "%chronicle%", "/\[R\]/", "/\[\/R\]/", "/\[C\]/", "/\[\/C\]/"],[$temp_rate->name, $temp_chronicle->name, "", "", "", ""],$this->settings['filter_keywords']);
            $this->h1 = preg_replace(["%rate%", "%chronicle%", "/\[R\]/", "/\[\/R\]/", "/\[C\]/", "/\[\/C\]/"],[$temp_rate->name, $temp_chronicle->name, "", "", "", ""],$this->settings['filter_h1']);
            $this->seo_text = preg_replace(["%rate%", "%chronicle%", "/\[R\]/", "/\[\/R\]/", "/\[C\]/", "/\[\/C\]/"],[$temp_rate->name, $temp_chronicle->name, "", "", "", ""],$this->settings['filter_seotext']);
        } else if ($rate_id != "all") {
            $temp_rate = Rate::find($rate_id);
            $this->title = preg_replace(["%rate%", "/\[C\].*\[\/C\]/", "/\[R\]/", "/\[\/R\]/"], [$temp_rate->name, "", "", ""],$this->settings['filter_title']);
            $this->description = preg_replace(["%rate%", "/\[C\].*\[\/C\]/", "/\[R\]/", "/\[\/R\]/"], [$temp_rate->name, "", "", ""],$this->settings['filter_description']);
            $this->keywords = preg_replace(["%rate%", "/\[C\].*\[\/C\]/", "/\[R\]/", "/\[\/R\]/"], [$temp_rate->name, "", "", ""],$this->settings['filter_keywords']);
            $this->h1 = preg_replace(["%rate%", "/\[C\].*\[\/C\]/", "/\[R\]/", "/\[\/R\]/"], [$temp_rate->name, "", "", ""],$this->settings['filter_h1']);
            $this->seo_text = preg_replace(["%rate%", "/\[C\].*\[\/C\]/", "/\[R\]/", "/\[\/R\]/"], [$temp_rate->name, "", "", ""],$this->settings['filter_seotext']);
        } else if ($chronicle_id != "all") {
            $temp_chronicle = Chronicle::find($chronicle_id);
            $this->title = preg_replace(["%chronicle%", "/\[R\].*\[\/R\]/", "/\[C\]/", "/\[\/C\]/"], [$temp_chronicle->name, "", "", ""],$this->settings['filter_title']);
            $this->description = preg_replace(["%chronicle%", "/\[R\].*\[\/R\]/", "/\[C\]/", "/\[\/C\]/"], [$temp_chronicle->name, "", "", ""],$this->settings['filter_description']);
            $this->keywords = preg_replace(["%chronicle%", "/\[R\].*\[\/R\]/", "/\[C\]/", "/\[\/C\]/"], [$temp_chronicle->name, "", "", ""],$this->settings['filter_keywords']);
            $this->h1 = preg_replace(["%chronicle%", "/\[R\].*\[\/R\]/", "/\[C\]/", "/\[\/C\]/"], [$temp_chronicle->name, "", "", ""],$this->settings['filter_h1']);
            $this->seo_text = preg_replace(["%chronicle%", "/\[R\].*\[\/R\]/", "/\[C\]/", "/\[\/C\]/"], [$temp_chronicle->name, "", "", ""],$this->settings['filter_seotext']);
        }
        $ads = Ad::get();
        $this->inc_js = "
        <script>
        jQuery(document).ready(function(){
            $('#filter-form').submit(function(e){
                e.preventDefault();
                var rate = $('#rate').val();
                var chronicle = $('#chronicle').val();                
                document.location.href = 'http://l2oko.ru/filter/' + rate + '-' + chronicle;
            })
        });
        </script>
        ";
        $partners = Partner::get();
//        $this->inc_js = "
//        <script>
//        jQuery(document).ready(function(){
//            $('.drop-filter').click(function(){
//                $('#rate').prop('selectedIndex',0);
//                $('#chronicle').prop('selectedIndex',0);
//                $('#div-chronicles .select-selected').html('Все хроники');
//                $('#div-rate .select-selected').html('Все рейты');
//            })
//        });
//        </script>
//        ";
        $inp_rates = array("all" => "Все рейты");
        $inp_chronicles = array("all" => "Все хроники");
        foreach ($rates as $rate) {
            $inp_rates = array_add($inp_rates, $rate->name, $rate->name);
        }
        foreach ($chronicles as $chronicle) {
            $inp_chronicles = array_add($inp_chronicles, $chronicle->name, $chronicle->name);
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
        $servers["tomorrow"] = $this->getServers($server->Tomorrow()->Active()->orderBy("start_at"), $rate_id, $chronicle_id);
        $servers["today"] = $this->getServers($server->Today()->Active()->orderBy("start_at"), $rate_id, $chronicle_id);
        $servers["week"] = $this->getServers($server->Week()->Active()->orderBy("start_at"), $rate_id, $chronicle_id);
        $servers["seven_days"] = $this->getServers($server->SevenDays()->Active()->orderBy("start_at"), $rate_id, $chronicle_id);
        $servers["opened"] = $this->getServers($server->Opened()->Active()->orderBy("start_at", "desc"), $rate_id, $chronicle_id);
        $servers["vipOpened"] = $this->getServers($server->OpenedVip()->orderBy("start_at", "desc"), $rate_id, $chronicle_id);
        $servers["vipOpen"] = $this->getServers($server->OpenVip()->orderBy("start_at"), $rate_id, $chronicle_id);
        $this->content = view('main')->with(["servers" => $servers, "nominations" => $nominations, "date_week" => $date_week, "this_day" => $this_day, "this_month" => $this_month, "inputs" => $this->inputs, "ads" => $ads, "today" => $this->today, "yesterday" => $this->yesterday, "tomorrow" => $this->tomorrow, "seotext" => $this->seo_text])->render();
        return $this->renderOutput();
    }

    public function filter(Server $server, $param1) {
        //Оптимизировать
        $this->inc_js = "
        <script>
        jQuery(document).ready(function(){
            $('#filter-form').submit(function(e){
                e.preventDefault();
                var rate = $('#rate').val();
                var chronicle = $('#chronicle').val();                
                document.location.href = 'http://l2oko.ru/filter/' + rate + '-' + chronicle;
            })
        });
        </script>
e        ";
        $models = $this->getModelsArray(explode("-", $param1));
        $rate_id = (isset($models["rate"]) && $models["rate"]) ? $models["rate"]->id : "all";
        $rate_name = (isset($models["rate"]) && $models["rate"]) ? $models["rate"]->name : "all";
        $chronicle_id = (isset($models["chronicle"]) && $models["chronicle"]) ? $models["chronicle"]->id : "all";
        $chronicle_name = (isset($models["chronicle"]) && $models["chronicle"]) ? $models["chronicle"]->name : "all";
        $rates = Rate::orderBy('sort')->get();
        $chronicles = Chronicle::orderBy('sort')->get();
        if($rate_id != "all" && $chronicle_id != "all") {
            $temp_rate = Rate::find($rate_id);
            $temp_chronicle = Chronicle::find($chronicle_id);
            $this->title = preg_replace(["%rate%", "%chronicle%", "/\[R\]/", "/\[\/R\]/", "/\[C\]/", "/\[\/C\]/"],[$temp_rate->name, $temp_chronicle->name, "", "", "", ""],$this->settings['filter_title']);
            $this->description = preg_replace(["%rate%", "%chronicle%", "/\[R\]/", "/\[\/R\]/", "/\[C\]/", "/\[\/C\]/"],[$temp_rate->name, $temp_chronicle->name, "", "", "", ""],$this->settings['filter_description']);
            $this->keywords = preg_replace(["%rate%", "%chronicle%", "/\[R\]/", "/\[\/R\]/", "/\[C\]/", "/\[\/C\]/"],[$temp_rate->name, $temp_chronicle->name, "", "", "", ""],$this->settings['filter_keywords']);
            $this->h1 = preg_replace(["%rate%", "%chronicle%", "/\[R\]/", "/\[\/R\]/", "/\[C\]/", "/\[\/C\]/"],[$temp_rate->name, $temp_chronicle->name, "", "", "", ""],$this->settings['filter_h1']);
            $this->seo_text = preg_replace(["%rate%", "%chronicle%", "/\[R\]/", "/\[\/R\]/", "/\[C\]/", "/\[\/C\]/"],[$temp_rate->name, $temp_chronicle->name, "", "", "", ""],$this->settings['filter_seotext']);
        } else if ($rate_id != "all") {
            $temp_rate = Rate::find($rate_id);
            $this->title = preg_replace(["%rate%", "/\[C\].*\[\/C\]/", "/\[R\]/", "/\[\/R\]/"], [$temp_rate->name, "", "", ""],$this->settings['filter_title']);
            $this->description = preg_replace(["%rate%", "/\[C\].*\[\/C\]/", "/\[R\]/", "/\[\/R\]/"], [$temp_rate->name, "", "", ""],$this->settings['filter_description']);
            $this->keywords = preg_replace(["%rate%", "/\[C\].*\[\/C\]/", "/\[R\]/", "/\[\/R\]/"], [$temp_rate->name, "", "", ""],$this->settings['filter_keywords']);
            $this->h1 = preg_replace(["%rate%", "/\[C\].*\[\/C\]/", "/\[R\]/", "/\[\/R\]/"], [$temp_rate->name, "", "", ""],$this->settings['filter_h1']);
            $this->seo_text = preg_replace(["%rate%", "/\[C\].*\[\/C\]/", "/\[R\]/", "/\[\/R\]/"], [$temp_rate->name, "", "", ""],$this->settings['filter_seotext']);
        } else if ($chronicle_id != "all") {
            $temp_chronicle = Chronicle::find($chronicle_id);
            $this->title = preg_replace(["%chronicle%", "/\[R\].*\[\/R\]/", "/\[C\]/", "/\[\/C\]/"], [$temp_chronicle->name, "", "", ""],$this->settings['filter_title']);
            $this->description = preg_replace(["%chronicle%", "/\[R\].*\[\/R\]/", "/\[C\]/", "/\[\/C\]/"], [$temp_chronicle->name, "", "", ""],$this->settings['filter_description']);
            $this->keywords = preg_replace(["%chronicle%", "/\[R\].*\[\/R\]/", "/\[C\]/", "/\[\/C\]/"], [$temp_chronicle->name, "", "", ""],$this->settings['filter_keywords']);
            $this->h1 = preg_replace(["%chronicle%", "/\[R\].*\[\/R\]/", "/\[C\]/", "/\[\/C\]/"], [$temp_chronicle->name, "", "", ""],$this->settings['filter_h1']);
            $this->seo_text = preg_replace(["%chronicle%", "/\[R\].*\[\/R\]/", "/\[C\]/", "/\[\/C\]/"], [$temp_chronicle->name, "", "", ""],$this->settings['filter_seotext']);
        }
        $ads = Ad::get();
        $inp_rates = array("all" => "Все рейты");
        $inp_chronicles = array("all" => "Все хроники");
        foreach ($rates as $rate) {
            $inp_rates = array_add($inp_rates, $rate->name, $rate->name);
        }
        foreach ($chronicles as $chronicle) {
            $inp_chronicles = array_add($inp_chronicles, $chronicle->name, $chronicle->name);
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
        $servers["tomorrow"] = $this->getServers($server->Tomorrow()->Active()->orderBy("start_at"), $rate_id, $chronicle_id);
        $servers["today"] = $this->getServers($server->Today()->Active()->orderBy("start_at"), $rate_id, $chronicle_id);
        $servers["week"] = $this->getServers($server->Week()->Active()->orderBy("start_at"), $rate_id, $chronicle_id);
        $servers["seven_days"] = $this->getServers($server->SevenDays()->Active()->orderBy("start_at"), $rate_id, $chronicle_id);
        $servers["opened"] = $this->getServers($server->Opened()->Active()->orderBy("start_at", "desc"), $rate_id, $chronicle_id);
        $servers["vipOpened"] = $this->getServers($server->OpenedVip()->orderBy("start_at", "desc"), $rate_id, $chronicle_id);
        $servers["vipOpen"] = $this->getServers($server->OpenVip()->orderBy("start_at"), $rate_id, $chronicle_id);
        $this->content = view('main')->with(["servers" => $servers, "nominations" => $nominations, "date_week" => $date_week, "this_day" => $this_day, "this_month" => $this_month, "inputs" => $this->inputs, "ads" => $ads, "today" => $this->today, "yesterday" => $this->yesterday, "tomorrow" => $this->tomorrow, "seotext" => $this->seo_text, "rate_name" => $rate_name, "chronicle_name" => $chronicle_name])->render();
        return $this->renderOutput();
    }

    private function getModelsArray(array $param1) {
        return array($this->filter_url[0] => $this->getModel($this->filter_url[0], $param1[0]), $this->filter_url[1] => $this->getModel($this->filter_url[1], $param1[1]));
    }

    private function getModel($model, $param) {
        switch ($model) {
            case "rate":
                if($param != "all") {
                    return Rate::where('name',$param)->first();
                } else {
                    return false;
                }
                break;
            case "chronicle":
                if($param != "all") {
                    return Chronicle::where('name',$param)->first();
                } else {
                    return false;
                }
                break;
            default:
                return false;
        }
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

    private function deleteDublicate($today, $open) {
        for($i = 1; $i < 5; $i++) {
            if (isset($open[$i]) && isset($today[$i])) {
                foreach ($today[$i] as $server) {
                    $open[$i] = $open[$i]->reject(function ($value, $key) use ($server) {
                        return $value->id == $server->id;
                    });
                }
            }
        }
        return $open;
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
