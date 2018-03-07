<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Dashboard\DashboardController;

class IndexController extends DashboardController
{
    public function __construct()
    {
        parent::__construct(new \App\Repositories\ServersRepository(new \App\Server), new \App\Repositories\SettingsRepository(new \App\Setting()));
        $this->template = 'dashboard.index';
    }

    public function index()
    {
        $this->content = view('dashboard.main')->with(array("user" => $this->user))->render();
        $this->title = 'Добро пожаловать';
        return $this->renderOutput();

    }
}
