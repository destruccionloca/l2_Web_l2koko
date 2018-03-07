<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Rate;
use DB;

class RatesController extends DashboardController
{

    public function __construct()
    {
        parent::__construct(new \App\Repositories\ServersRepository(new \App\Server), new \App\Repositories\SettingsRepository(new \App\Setting()));
        $this->template = 'dashboard.index';
        $this->inc_js_lib = array_add($this->inc_js_lib,'jq-ui',array('url' => '<script src='.$this->pub_path.'/js/plugins/jquery-ui/jquery-ui.min.js></script>'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Rate $rate)
    {
        $this->checkUser();
        $rates = $rate->orderBy('sort')->get();
        $this->inc_js = "
        <script>
            jQuery(function () {
                // Init page helpers (jQueryUI)
                Codebase.helpers('draggable-items');
            });
                function setOrder() {
                    var inputValue = \"\";
                    $(\".rate\").each(function (index, e) {
                        inputValue += $(e).attr(\"data-id\") + \",\";
                    });
                    $(\"#sort\").val(inputValue);
                    return true;
                }
        </script>
        ";
        $this->content = view("dashboard.rate")->with(['rates' => $rates])->render();
        $this->title = 'Рейт';
        return $this->renderOutput();
    }

    public function sort(Request $request) {
        $sort = rtrim($request->sort, '\,');
        $sort = explode(',', $sort);
        for($i = 0;count($sort) > $i; $i++) {
            $model = Rate::select('*')->where("id", $sort[$i])->first();
            $model->sort = $i;
            $model->update();
        }
        return back()->with(['status' => 'Порядок сохранен']);
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
        $max_id = Rate::max('id');
        $max_id++;
        Rate::create([
            'name' => $request->name,
            'sort' => $max_id
        ]);

        return back()->with(['status' => 'Рейт добавлен']);
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
