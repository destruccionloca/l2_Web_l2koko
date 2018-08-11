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
        $this->template = 'index';
        $this->title = $this->settings['title'];
        $this->description = $this->settings['description'];
        $this->keywords = $this->settings['keywords'];
        $this->inc_js_lib = array_add($this->inc_js_lib,'mask',array('url' => '<script src='.$this->pub_path.'/js/jquery.maskedinput.min.js></script>'));

    }

    public function create() {
        $rates = Rate::orderBy('sort')->get();
        $chronicles = Chronicle::orderBy('sort')->get();
        $this->inc_js = "
        <script>
               $(function() {
                   
                    $(\"#rate\").mask(\"x9ZZZZZZZZ\", {
                            translation: {
                              'Z': {
                                pattern: /[0-9]/, optional: true
                              }
                            }
                          });
            
//                    $(\"input\").blur(function() {
//                        $(\"#info\").html(\"Unmasked value: \" + $(this).mask());
//                    }).dblclick(function() {
//                        $(this).unmask();
//                    });
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
        $this->content = view('server_create')->with(["inputs" => $this->inputs])->render();
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
        $this->title = $server->name;
        $this->content = view('server_show')->with(["server" => $server])->render();
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
}
