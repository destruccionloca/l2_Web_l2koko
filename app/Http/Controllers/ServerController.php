<?php

namespace App\Http\Controllers;

use App\Chronicle;
use App\Rate;
use Illuminate\Http\Request;
use App\Server;
use Carbon\Carbon;

class ServerController extends SiteController
{
    public function __construct()
    {
        parent::__construct(new \App\Repositories\ServersRepository(new \App\Server), new \App\Repositories\SettingsRepository(new \App\Setting()), new \App\Repositories\PagesRepository(new \App\Page()));
        $this->template = 'index';
        $this->title = $this->settings['title'];
        $this->description = $this->settings['description'];
        $this->keywords = $this->settings['keywords'];

    }

    public function create(Rate $rate, Chronicle $chronicle) {
        $rates = $rate->get();
        $chronicles = $chronicle->get();
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

    public function store(Request $request, Server $server) {
        $data = $request->all();
        $server->create([
            'unumber' => $this->generateRandStr(10),
            'link' => $data['link'],
            'chronicles' => $data['chronic'],
            'date_start' => Carbon::createFromFormat( 'd.m.Y H:i' ,$data['date']),
            'rate' => $data['rate'],
            'email' => $data['email'],
            'social_vk' => $data['vk'],
            'description' => $data['desc'],
            'social_groupvk' => $data['vkgroup'],
            'social_groupfb' => $data['fb'],
            'social_grouptw' => $data['tw'],
            'social_groupicq' => $data['icq'],
            'name' => $data['name'],
        ]);
        return redirect('/');
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
