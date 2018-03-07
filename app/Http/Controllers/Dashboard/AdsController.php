<?php

namespace App\Http\Controllers\Dashboard;

use App\Ad;
use App\Http\Requests\AdRequest;
use App\Repositories\AdsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdsController extends DashboardController
{
    protected $ad_rep;

    public function __construct(AdsRepository $ad_rep)
    {
        parent::__construct(new \App\Repositories\ServersRepository(new \App\Server), new \App\Repositories\SettingsRepository(new \App\Setting()));
        $this->template = 'dashboard.index';
        $this->ad_rep = $ad_rep;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = $this->ad_rep->get('*');
        $this->content = view('dashboard.ads')->with(array("user" => $this->user, "ads" => $ads))->render();
        $this->title = 'Партнеры';
        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checkUser();
        $this->content = view("dashboard.ad_create")->render();
        $this->title = 'Создание нового рекламного блока';
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdRequest $request)
    {
        $this->checkUser();
        $result = $this->ad_rep->add($request);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('dashboard/ad/')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(ad $ad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        $this->checkUser();
        $this->content = view("dashboard.ad_create")->with(['ad' => $ad])->render();
        $this->title = 'Редактирование рекламного блока ' . $ad->title;
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(AdRequest $request, ad $ad)
    {
        $this->checkUser();
        $result = $this->ad_rep->update($request, $ad);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('dashboard/ad/')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(ad $ad)
    {
        $this->checkUser();
//        if($this->user->cant('delete', $object)) {
//            return back()->with(array('error' => 'Доступ запрещен'));
//        }
        if ($ad->forceDelete()) {
            return back()->with(['status' => 'Блок удален']);
        } else {
            return back()->with(['error' => 'Ошибка удаления']);
        }
    }
}
