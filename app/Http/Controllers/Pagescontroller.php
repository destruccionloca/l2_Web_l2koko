<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class Pagescontroller extends SiteController
{
    public function __construct()
    {
        parent::__construct(new \App\Repositories\ServersRepository(new \App\Server), new \App\Repositories\SettingsRepository(new \App\Setting()), new \App\Repositories\PagesRepository(new \App\Page()));
        $this->template = 'index';
        $this->title = $this->settings['title'];
        $this->description = $this->settings['description'];
        $this->keywords = $this->settings['keywords'];

    }

    public function show (Page $page) {
        $this->title = $page->title;
        $this->description = $page->desc;
        $this->keywords = $page->keywords;
        $this->content = view('page')->with(["page" => $page])->render();
        return $this->renderOutput();
    }
}
