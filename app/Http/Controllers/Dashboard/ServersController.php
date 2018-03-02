<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\ServerRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Rate;
use App\Chronicle;
use App\Server;

class ServersController extends DashboardController
{

    public function __construct()
    {
        parent::__construct(new \App\Repositories\ServersRepository(new \App\Server));
        $this->template = 'dashboard.index';
        $this->inc_css_lib = array_add($this->inc_css_lib,  'dataTables', array('url' => '<link rel="stylesheet" href="'.$this->pub_path.'/js/plugins/datatables/dataTables.bootstrap4.min.css">'));
        $this->inc_css_lib = array_add($this->inc_css_lib,  'datapicker', array('url' => '<link rel="stylesheet" href="/css/datepicker.min.css">'));
        $this->inc_js_lib = array_add($this->inc_js_lib,'jq-dataTables',array('url' => '<script src="'.$this->pub_path.'/js/plugins/datatables/jquery.dataTables.min.js"></script>'));
        $this->inc_js_lib = array_add($this->inc_js_lib,'jq-Tables',array('url' => '<script src="'.$this->pub_path.'/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>'));
        $this->inc_js_lib = array_add($this->inc_js_lib,'jq-cbtables',array('url' => '<script src="'.$this->pub_path.'/js/pages/be_tables_datatables.js"></script>'));
        $this->inc_js_lib = array_add($this->inc_js_lib,'data-picker',array('url' => '<script src="/js/datepicker.min.js"></script>'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servers = $this->ser_rep->get('*');
        $this->content = view('dashboard.servers')->with(array("user" => $this->user, "servers" => $servers))->render();
        $this->title = 'Сервера';
        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Rate $rate, Chronicle $chronicle)
    {
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
        $this->content = view('dashboard.server_create')->with(array("user" => $this->user, "inputs" => $this->inputs))->render();
        $this->title = 'Добавление сервера';
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServerRequest $request)
    {
        $this->checkUser();
        $result = $this->ser_rep->add($request);
        if(is_array($result) && (!empty($result['error']) || !empty($result['errors']))) {
            return back()->with($result);
        }

        return redirect('/dashboard/server/')->with($result);
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
    public function edit(Server $server, Rate $rate, Chronicle $chronicle)
    {
        $this->checkUser();
//        if($this->user->cant('update', $object)) {
//            return back()->with(array('error' => 'Доступ запрещен'));
//        }
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
        $this->content = view('dashboard.server_create')->with(array("user" => $this->user, "inputs" => $this->inputs, "server" => $server))->render();
        $this->title = 'Редактирование сервера';
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServerRequest $request, Server $server)
    {
        $this->checkUser();
//        if($this->user->cant('update', $object)) {
//            return back()->with(array('error' => 'Доступ запрещен'));
//        }
        $result = $this->ser_rep->update($request, $server);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect('/dashboard/server')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Server $server)
    {
        $this->checkUser();
//        if($this->user->cant('delete', $object)) {
//            return back()->with(array('error' => 'Доступ запрещен'));
//        }
        if ($server->forceDelete()) {
            return back()->with(['status' => 'Сервер удален']);
        } else {
            return back()->with(['error' => 'Ошибка удаления']);
        }
    }
}
