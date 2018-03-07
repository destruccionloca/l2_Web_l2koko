<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\SettingsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends DashboardController
{

    protected $s_rep;

    public function __construct(SettingsRepository $s_rep)
    {
        parent::__construct(new \App\Repositories\ServersRepository(new \App\Server), new \App\Repositories\SettingsRepository(new \App\Setting()));
        $this->template = 'dashboard.index';
        $this->s_rep = $s_rep;
    }

    public function edit()
    {
        $this->checkUser();
        $this->content = view('dashboard.setting_edit')->with(array("settings" => $this->settings))->render();
        $this->title = "Настройки";
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $result = $this->s_rep->updateSettings($request);
        return redirect("/dashboard")->with($result);
    }

    //
}
