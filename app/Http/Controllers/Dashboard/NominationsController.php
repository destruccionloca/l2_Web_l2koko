<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\NominationRequest;
use App\Nomination;
use Illuminate\Http\Request;
use App\Repositories\NominationsRepository;

class NominationsController extends DashboardController
{
    protected $nom_rep;

    public function __construct(NominationsRepository $nom_rep)
    {
        parent::__construct(new \App\Repositories\ServersRepository(new \App\Server), new \App\Repositories\SettingsRepository(new \App\Setting()));
        $this->inc_css_lib = array_add($this->inc_css_lib,  'select2', array('url' => '<link rel="stylesheet" href="'.$this->pub_path.'/js/plugins/select2/select2.min.css">'));
        $this->inc_css_lib = array_add($this->inc_css_lib,  'select2-bs', array('url' => '<link rel="stylesheet" href="'.$this->pub_path.'/js/plugins/select2/select2-bootstrap.min.css">'));
        $this->inc_js_lib = array_add($this->inc_js_lib,'select2',array('url' => '<script src="'.$this->pub_path.'/js/plugins/select2/select2.full.min.js"></script>'));
        $this->template = 'dashboard.index';
        $this->nom_rep = $nom_rep;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nominations = $this->nom_rep->get('*');
        $this->content = view('dashboard.nominations')->with(array("user" => $this->user, "nominations" => $nominations))->render();
        $this->title = 'Номинации';
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
        $servers = $this->ser_rep->get('*',false, false, ["moderated", "1"]);
        $inp_servers = array("" => "", "null" => "Без сервера");
        foreach ($servers as $server) {
            $inp_servers = array_add($inp_servers, $server->id, $server->name );
        }
        $this->inputs = array_add($this->inputs, "servers", $inp_servers);
        $this->inc_js = "
        <script>
            jQuery(function () {
                // Init page helpers (BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Input + Range Sliders + Tags Inputs plugins)
                Codebase.helpers(['select2']);
            });
        </script>
        ";
        $this->content = view("dashboard.nomination_create")->with(['inputs' => $this->inputs])->render();
        $this->title = 'Создание новой номинации';
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NominationRequest $request)
    {
        $this->checkUser();
        $result = $this->nom_rep->add($request);
        if(is_array($result) && (!empty($result['error']) || !empty($result['errors']))) {
            return back()->with($result);
        }

        return redirect('/dashboard/nomination/')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Nomination $nomination)
    {
        $this->checkUser();
        $servers = $this->ser_rep->get('*',false, false, ["moderated", "1"]);
        $inp_servers = array("" => "", "null" => "Без сервера");
        foreach ($servers as $server) {
            $inp_servers = array_add($inp_servers, $server->id, $server->name );
        }
        $this->inputs = array_add($this->inputs, "servers", $inp_servers);
        $this->inc_js = "
        <script>
            jQuery(function () {
                // Init page helpers (BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Input + Range Sliders + Tags Inputs plugins)
                Codebase.helpers(['select2']);
            });
        </script>
        ";
        $this->content = view("dashboard.nomination_create")->with(['inputs' => $this->inputs, 'nomination' => $nomination])->render();
        $this->title = 'Редактирование номинации';
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NominationRequest $request, Nomination $nomination)
    {
        $this->checkUser();
//        if($this->user->cant('update', $object)) {
//            return back()->with(array('error' => 'Доступ запрещен'));
//        }
        $result = $this->nom_rep->update($request, $nomination);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect('/dashboard/nomination')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nomination $nomination)
    {
        $this->checkUser();
//        if($this->user->cant('delete', $object)) {
//            return back()->with(array('error' => 'Доступ запрещен'));
//        }
        if ($nomination->forceDelete()) {
            return back()->with(['status' => 'Номинация удалена']);
        } else {
            return back()->with(['error' => 'Ошибка удаления']);
        }
    }

    public function showApplications(Nomination $nomination)
    {
        $applications = $nomination->applications;
        $this->content = view('dashboard.applications')->with(array("user" => $this->user, "applications" => $applications, 'nomination' => $nomination))->render();
        $this->title = 'Заявки '. $nomination->name;
        return $this->renderOutput();

    }
}
