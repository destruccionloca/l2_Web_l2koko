<?php

namespace App\Http\Controllers;

use App\Repositories\PagesRepository;
use Illuminate\Http\Request;
use App\Server;

class IndexController extends SiteController
{

    public function __construct()
    {
        parent::__construct(new \App\Repositories\ServersRepository(new \App\Server), new \App\Repositories\SettingsRepository(new \App\Setting()), new \App\Repositories\PagesRepository(new \App\Page()));
        $this->template = 'index';
        $this->title = $this->settings['title'];
        $this->description = $this->settings['description'];
        $this->keywords = $this->settings['keywords'];

    }

    public function index(Server $server) {
        $servers = $server->all();
        $yesterday = $server->Yesterday()->get();
        $opened = $server->Open()->get();
        $week = $server->Week()->get();
        $seven_days =  $server->SevenDays()->get();
        $this->content = view('main')->with(["servers" => $servers, "yesterday" => $yesterday, "opened" => $opened, "week" => $week, "seven_days" => $seven_days])->render();
        return $this->renderOutput();
    }
}
