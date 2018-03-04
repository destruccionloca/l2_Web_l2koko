<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\PartnerRequest;
use App\partner;
use App\Repositories\PartnersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnersController extends DashboardController
{

    protected $par_rep;

    public function __construct(PartnersRepository $par_rep)
    {
        parent::__construct(new \App\Repositories\ServersRepository(new \App\Server));
        $this->template = 'dashboard.index';
        $this->par_rep = $par_rep;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = $this->par_rep->get('*');
        $this->content = view('dashboard.partners')->with(array("user" => $this->user, "partners" => $partners))->render();
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
        $this->content = view("dashboard.partner_create")->render();
        $this->title = 'Создание нового партнера';
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerRequest $request)
    {
        $this->checkUser();
        $result = $this->par_rep->add($request);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('dashboard/partner/')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        $this->checkUser();
        $this->content = view("dashboard.partner_create")->with(['partner' => $partner])->render();
        $this->title = 'Редактирование партнера ' . $partner->title;
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(PartnerRequest $request, Partner $partner)
    {
        $this->checkUser();
        $result = $this->par_rep->update($request, $partner);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('dashboard/partner/')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(partner $partner)
    {
        $this->checkUser();
//        if($this->user->cant('delete', $object)) {
//            return back()->with(array('error' => 'Доступ запрещен'));
//        }
        if ($partner->forceDelete()) {
            return back()->with(['status' => 'Партнер удален']);
        } else {
            return back()->with(['error' => 'Ошибка удаления']);
        }
    }
}
