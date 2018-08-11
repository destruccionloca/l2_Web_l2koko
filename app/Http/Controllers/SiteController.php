<?php

namespace App\Http\Controllers;

use App\Page;
use App\Repositories\PagesRepository;
use App\Repositories\PartnersRepository;
use App\Repositories\ServersRepository;
use App\Repositories\SettingsRepository;
use Illuminate\Http\Request;
use Auth;

class SiteController extends Controller
{

    protected $user;

    protected $ser_rep;

    protected $page_rep;

    protected $par_rep;

    protected $inputs = array();

    protected $settings = array();

    protected $pub_path;

    protected $inc_css_lib = FALSE;

    protected $inc_last_css_lib = FALSE;

    protected $inc_js_lib = FALSE;

    protected $inc_js = FALSE;

    protected $template;

    protected $content = FALSE;

    protected $title;

    protected $description;

    protected $keywords;

    protected $h1;

    protected $vars;

    public function __construct(ServersRepository $s_rep, SettingsRepository $settings, PagesRepository $page_rep, PartnersRepository $par_rep)
    {
        $this->ser_rep = $s_rep;
        $this->page_rep = $page_rep;
        $this->par_rep = $par_rep;
        $this->inc_css_lib = array(
            'animate' => array('url' => '<link rel="stylesheet" href="'.asset("css/animate.css").'">'),
            'font-awesome' => array('url' => '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">'),
            'data-picker' => array('url' => '<link rel="stylesheet" href="'.asset("css/datepicker.min.css").'">'),
            'main-style' => array('url' => '<link rel="stylesheet" href="'.asset("css/style.min.css?ver=1.60").'">'),
        );
        $this->inc_js_lib = array(
            'app' => array('url' => '<script src="'.asset('js/app.js?ver=1.07').'"></script>'),
            'data-picker' => array('url' => '<script src="'.asset('js/datepicker.min.js').'"></script>'),
            'bootstrap-notify' => array('url' => '<script src="'.asset('js/bootstrap-notify.min.js').'"></script>'),
        );
        $settings_col = $settings->get(["name", "param"]);
        foreach ($settings_col as $setting_col) {
            $this->settings[$setting_col->name] = $setting_col->param;
        }
    }

    public function checkUser() {
        $this->user = Auth::user();
        if(!$this->user) {
            abort(403);
        }
    }

    public function renderOutput() {
        $this->vars = array_add($this->vars,'title',$this->title);
        $this->vars = array_add($this->vars,'description',$this->description);
        $this->vars = array_add($this->vars,'keywords',$this->keywords);
        $this->vars = array_add($this->vars,'h1',$this->h1);
        $this->vars = array_add($this->vars,'main_pic', ["pic" => $this->settings['main_pic'], "last" => $this->settings['last_upd']]);
        $this->vars = array_add($this->vars, 'user', $this->user);
        $this->vars = array_add($this->vars, 'pages', $this->page_rep->get('*', false, false, ["type", "service"]));
        $this->vars = array_add($this->vars, 'pages_menu', $this->page_rep->get('*', false, false, ["type", "main"]));
        $this->vars = array_add($this->vars, 'partners', $this->par_rep->get('*'));
//
        if($this->content) {
            $this->vars = array_add($this->vars,'content',$this->content);
        }

        if($this->inc_css_lib) {
            $this->vars = array_add($this->vars,'inc_css_lib',$this->inc_css_lib);
        }

        if($this->inc_last_css_lib) {
            $this->vars = array_add($this->vars,'inc_last_css_lib',$this->inc_last_css_lib);
        }

        if($this->inc_js_lib) {
            $this->vars = array_add($this->vars,'inc_js_lib',$this->inc_js_lib);
        }

        if($this->inc_js) {
            $this->vars = array_add($this->vars,'inc_js',$this->inc_js);
        }


        return view($this->template)->with($this->vars);
    }
}
