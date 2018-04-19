<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\ServerRequest;
use App\Http\Requests\ServerUpdRequest;
use App\Partner;
use App\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Rate;
use App\Chronicle;
use App\Server;
use \BW\Vkontakte as Vk;

class ServersController extends DashboardController
{

    public function __construct()
    {
        parent::__construct(new \App\Repositories\ServersRepository(new \App\Server), new \App\Repositories\SettingsRepository(new \App\Setting()));
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
    public function index(Server $server, $type = 'active')
    {
        $this->checkUser();
        $partners = Partner::get();
        if ($type == 'active') {
            $servers = $server->Active()->get();
        } else {
            $servers = $server->Moderating()->get();
        }
        $count = ["active" => $server->Active()->count(), "moder" => $server->Moderating()->count()];
        $this->content = view('dashboard.servers')->with(array("user" => $this->user, "servers" => $servers, "count" => $count, "type" => $type, "partners" => $partners))->render();
        $this->title = 'Сервера';
        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Rate $rate, Chronicle $chronicle, Status $status)
    {
        $this->checkUser();
        $rates = $rate->get();
        $chronicles = $chronicle->get();
        $statuses = $status->get();
        $inp_rates = array();
        $inp_chronicles = array();
        $inp_statuses = array();
        foreach ($rates as $rate) {
            $inp_rates = array_add($inp_rates, $rate->id, $rate->name );
        }
        foreach ($chronicles as $chronicle) {
            $inp_chronicles = array_add($inp_chronicles, $chronicle->id, $chronicle->name );
        }
        foreach ($statuses as $status) {
            $inp_statuses = array_add($inp_statuses, $status->id, $status->name );
        }
        $this->inputs = array_add($this->inputs, "rates", $inp_rates);
        $this->inputs = array_add($this->inputs, "chronicles", $inp_chronicles);
        $this->inputs = array_add($this->inputs, "statuses", $inp_statuses);
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

        return redirect('/dashboard/servers/')->with($result);
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
    public function edit(Server $server, Rate $rate, Chronicle $chronicle, Status $status)
    {
        $this->checkUser();
//        if($this->user->cant('update', $object)) {
//            return back()->with(array('error' => 'Доступ запрещен'));
//        }
        $this->inc_js = "
        <script>
            var datepicker = $('#start_at').datepicker().data('datepicker');
            datepicker.selectDate(new Date(" . $server->start_at->format('Y, m-1, d, H, i, s') . "));
        </script>
        ";
        $rates = $rate->get();
        $chronicles = $chronicle->get();
        $statuses = $status->get();
        $inp_rates = array();
        $inp_chronicles = array();
        $inp_statuses = array();
        foreach ($rates as $rate) {
            $inp_rates = array_add($inp_rates, $rate->id, $rate->name );
        }
        foreach ($chronicles as $chronicle) {
            $inp_chronicles = array_add($inp_chronicles, $chronicle->id, $chronicle->name );
        }
        foreach ($statuses as $status) {
            $inp_statuses = array_add($inp_statuses, $status->id, $status->name );
        }
        $this->inputs = array_add($this->inputs, "rates", $inp_rates);
        $this->inputs = array_add($this->inputs, "chronicles", $inp_chronicles);
        $this->inputs = array_add($this->inputs, "statuses", $inp_statuses);
        $this->content = view('dashboard.server_create')->with(array("user" => $this->user, "inputs" => $this->inputs, "server" => $server))->render();
        $this->title = 'Редактирование сервера ' . $server->name;
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServerUpdRequest $request, Server $server)
    {
        $this->checkUser();
//        if($this->user->cant('update', $object)) {
//            return back()->with(array('error' => 'Доступ запрещен'));
//        }
        $result = $this->ser_rep->update($request, $server);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect('/dashboard/servers/')->with($result);
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
            if(!is_null($server->applications)){
                foreach ($server->applications as $application) {
                  $application->forceDelete();
                }
            }
            return back()->with(['status' => 'Сервер удален']);
        } else {
            return back()->with(['error' => 'Ошибка удаления']);
        }
    }

    public function toActive(Server $server) {
        $this->checkUser();
        $server->moderated = true;
        $result_cross = $this->crossPost($server, $this->settings["token"], $this->settings["group_id"]);
        if ($server->update()) {
            return back()->with(['status' => 'Сервер активирован']);
        } else {
            return back()->with(['error' => 'Ошибка активации']);
        }
    }

    public function toPost(Server $server, $partner = "default") {
        $this->checkUser();
        if($partner != "default") {
            $result = $this->crossPost($server, $partner->token, $partner->group_id);
        } else {
            $result = $this->crossPost($server, $this->settings["token"], $this->settings["group_id"]);
        }
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect('/dashboard/servers/')->with($result);
    }

    private function crossPost($server, $token, $group_id, $tags = array()) {
        $vkAPI = new Vk();
        $vkAPI->setAccessToken(["access_token" => $token]);
        isset($server->picture) ? $image = '/var/www/alexroot/data/www/l2oko.ru/public/uploads/servers/server-'. $server->id . $server->picture : $image = false;
        $text = $server->name. "\n" . $server->chronicle->name . "\n" . $server->rate->name . "\n" . $server->link. "\nОткрытие " . $server->start_at;
        if ($vkAPI->postToPublic($group_id, $text, $image, $tags)) {

            return ['status' => 'Кросспостинг завершен успешно'];

        } else {

            return ['error' => 'Кросспостинг прерван с ошибкой'];
        }
    }
}
