<?php

namespace App\Http\Controllers;

use App\Chronicle;
use App\Http\Requests\ServerRequest;
use App\Rate;
use App\Repositories\PartnersRepository;
use Illuminate\Http\Request;
use App\Server;
use Carbon\Carbon;

class ServerController extends SiteController
{
    public function __construct()
    {
        parent::__construct(
            new \App\Repositories\ServersRepository(new \App\Server),
            new \App\Repositories\SettingsRepository(new \App\Setting()),
            new \App\Repositories\PagesRepository(new \App\Page()),
            new \App\Repositories\PartnersRepository(new \App\Partner())
        );
        setlocale(LC_TIME, 'ru_RU.utf8');
        $this->template = 'index';
        $this->title = $this->settings['title'];
        $this->description = $this->settings['description'];
        $this->keywords = $this->settings['keywords'];
//        $this->inc_js_lib = array_add($this->inc_js_lib,'mask',array('url' => '<script src='.$this->pub_path.'/js/jquery.maskedinput.min.js></script>'));
        $this->inc_js_lib = array_add($this->inc_js_lib,'ckeditor',array('url' => '<script src='.$this->pub_path.'/ckeditor/ckeditor.js></script>'));
    }

    public function create() {
        $this->title = $this->settings['add_server_title'];
        $this->h1 = $this->settings['add_server_h1'];
        $this->p = $this->settings['add_server_p'];
        $this->description = $this->settings['add_server_desc'];
        $rates = Rate::orderBy('sort')->get();
        $chronicles = Chronicle::orderBy('sort')->get();
        $this->inc_js = "
        <script>
               $(function() {                 
                   CKEDITOR.replace( 'description', {
                       customConfig: 'custom.js'
                })
                });
        </script>
        ";
        $inp_rates = array();
        $inp_chronicles = array();
        foreach ($rates as $rate) {
            $inp_rates = array_add($inp_rates, $rate->id, $rate->name );
        }
        foreach ($chronicles as $chronicle) {
            $inp_chronicles = array_add($inp_chronicles, $chronicle->id, $chronicle->name );
        }
        $this->inputs = array_add($this->inputs, "rates", $inp_rates);
        $this->inputs = array_add($this->inputs, "chronicles", $inp_chronicles);
        $this->content = view('server_create')->with(["inputs" => $this->inputs, "h2" => $this->settings['add_server_h2'], "right_text" => $this->settings["right_text"]])->render();
        return $this->renderOutput();
    }

    public function store(ServerRequest $request) {
        $result = $this->ser_rep->add($request, "front_side");
        if(is_array($result) && (!empty($result['error']) || !empty($result['errors']))) {
            return back()->with($result);
        }

        return redirect('/')->with($result);
    }

    public function show(Server $server) {
        $this->title = $server->title . " - " . $server->chronicle->name . " " . $server->rate->name . " - " . $server->p;
        $this->h1 = $server->h1;
        $this->p = $server->p;
        $this->description = $server->description;
        $this->content = view('server_show')->with(["server" => $server, "seo_text" => $this->replaceSeo($this->settings['server_seo_text'], $server)])->render();
        return $this->renderOutput();
    }

    public function generateRandStr($length = 8){
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }

    private function monthTrans($month){
        $m = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
        $m_ = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
        for ($i = 0; $i < count($m); $i++) {
            if ($month == $m[$i]) {
                return $m_[$i];
            }
        }
    }

    private function replaceSeo($seo_text, Server $server) {
       $data = $server->start_at->format('d') . " " . $this->monthTrans($server->start_at->formatLocalized('%B')) . " " . $server->start_at->format('Y в, H:i');
       return preg_replace(["%rate%", "%chronicle%", "%name%", "%date%", "%desc%", "/\[R\]/", "/\[\/R\]/", "/\[C\]/", "/\[\/C\]/", "/\[N\]/", "/\[\/N\]/", "/\[D\]/", "/\[\/D\]/", "/\[DC\]/", "/\[\/DC\]/" ],[ $server->rate->name, $server->chronicle->name, $server->name, $data, $server->description, "", "", "", "", "", "", "", "", "", ""], $seo_text);
    }
}
