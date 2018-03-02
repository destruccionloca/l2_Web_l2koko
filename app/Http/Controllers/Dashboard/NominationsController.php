<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\NominationRequest;
use Illuminate\Http\Request;
use App\Repositories\NominationsRepository;

class NominationsController extends DashboardController
{
    protected $nom_rep;

    public function __construct(NominationsRepository $nom_rep)
    {
        parent::__construct(new \App\Repositories\ServersRepository(new \App\Server));
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
        $servers = $this->ser_rep->get('*');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
