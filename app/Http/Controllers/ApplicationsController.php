<?php

namespace App\Http\Controllers;

use App\Nomination;
use App\Repositories\ApplicationsRepository;
use Illuminate\Http\Request;

class ApplicationsController extends SiteController
{
    protected $ap_rep;

    public function __construct(ApplicationsRepository $ap_rep)
    {
        parent::__construct(new \App\Repositories\ServersRepository(new \App\Server), new \App\Repositories\SettingsRepository(new \App\Setting()), new \App\Repositories\PagesRepository(new \App\Page()));
        $this->template = 'index';
        $this->title = $this->settings['title'];
        $this->description = $this->settings['description'];
        $this->keywords = $this->settings['keywords'];
        $this->ap_rep = $ap_rep;
    }


    public function store(Request $request, Nomination $nomination) {
        $result = $this->ap_rep->add($request, $nomination);
        if(is_array($result) && (!empty($result['error']) || !empty($result['errors']))) {
            return back()->with($result);
        }

        return redirect('/')->with($result);
    }
}
