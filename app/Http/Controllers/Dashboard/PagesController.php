<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Repositories\PagesRepository;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Page;

class PagesController extends DashboardController
{

    protected $p_rep;

    public function __construct(PagesRepository $p_rep)
    {
        parent::__construct(new \App\Repositories\ServersRepository(new \App\Server));
        $this->p_rep = $p_rep;
        $this->template = 'dashboard.index';
        $this->inc_js_lib = array_add($this->inc_js_lib,'ckeditor',array('url' => '<script src='.$this->pub_path.'/ckeditor/ckeditor.js></script>'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkUser();
        $pages = $this->p_rep->get("*");
        $this->content = view("dashboard.pages")->with(["pages" => $pages])->render();
        $this->title = 'Страницы';
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
        $this->inc_js = "
        <script>
            CKEDITOR.replace( 'editor' );
        </script>
        ";
        $this->content = view("dashboard.page_create")->render();
        $this->title = 'Создание новой страницы';
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkUser();
        $result = $this->p_rep->addPage($request);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect(route("dashboard.index"))->with($result);
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
    public function edit(Page $page)
    {
        $this->checkUser();
        $this->content = view('dashboard.page_create')->with(['page' => $page])->render();
        $this->title = $page->title;
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $this->checkUser();
        $result = $this->p_rep->editPage($request, $page);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect(route("page.index"))->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $this->checkUser();
        $result = $this->p_rep->deletePage($page);
        return back()->with($result);
    }
}
