<?php

namespace App\Http\Controllers\Dashboard;

use App\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicationsController extends DashboardController
{
    public function __construct()
    {
        parent::__construct(new \App\Repositories\ServersRepository(new \App\Server), new \App\Repositories\SettingsRepository(new \App\Setting()));
        $this->template = 'dashboard.index';
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
    }

    public function toAccept(Application $application) {
        $this->checkUser();
        $nomination = $application->nomination;
        $nomination->server_id = $application->server->id;
        if($nomination->update()) {
            return back()->with(['status' => 'Сервер принят в номинации']);
        } else {
            return back()->with(['error' => 'Ошибка принятия']);
        }
    }

    public function toDelete(Application $application) {
        $this->checkUser();
        $nomination = $application->nomination;
        $nomination->server_id = null;
        if($nomination->update()) {
            return back()->with(['status' => 'Сервер удален из номинации']);
        } else {
            return back()->with(['error' => 'Ошибка удаления']);
        }
    }
}
