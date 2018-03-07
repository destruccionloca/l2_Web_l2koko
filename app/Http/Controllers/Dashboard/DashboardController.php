<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\SettingsRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ServersRepository;

class DashboardController extends Controller
{

    protected $user;

    protected $ser_rep;

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

    protected $vars;

    public function __construct(ServersRepository $s_rep, SettingsRepository $settings)
    {
        $this->ser_rep = $s_rep;
        $this->pub_path = asset("assets");
        $this->inc_last_css_lib = array(
            'codebase' => array('url' => '<link rel="stylesheet" href="'.$this->pub_path.'/css/codebase.min.css">'),
        );
        $this->inc_js_lib = array(
            'jq' => array('url' => '<script src="'.$this->pub_path.'/js/core/jquery.min.js"></script>'),
            'popper' => array('url' => '<script src="'.$this->pub_path.'/js/core/popper.min.js"></script>'),
            'bootstrap' => array('url' => '<script src="'.$this->pub_path.'/js/core/bootstrap.min.js"></script>'),
            'slimscroll' => array('url' => '<script src="'.$this->pub_path.'/js/core/jquery.slimscroll.min.js"></script>'),
            'scrollLock' => array('url' => '<script src="'.$this->pub_path.'/js/core/jquery.scrollLock.min.js"></script>'),
            'appear' => array('url' => '<script src="'.$this->pub_path.'/js/core/jquery.appear.min.js"></script>'),
            'countTo' => array('url' => '<script src="'.$this->pub_path.'/js/core/jquery.countTo.min.js"></script>'),
            'cookie' => array('url' => '<script src="'.$this->pub_path.'/js/core/js.cookie.min.js"></script>'),
            'notify' => array('url' => '<script src="'.$this->pub_path.'/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>'),
            'codebase' => array('url' => '<script src="'.$this->pub_path.'/js/codebase.js"></script>'),
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
        $this->checkUser();
        $this->vars = array_add($this->vars,'title',$this->title);
        $this->vars = array_add($this->vars, 'user', $this->user);
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
