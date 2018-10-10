<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PagesController extends SiteController
{
    public function __construct()
    {
        parent::__construct(
            new \App\Repositories\ServersRepository(new \App\Server),
            new \App\Repositories\SettingsRepository(new \App\Setting()),
            new \App\Repositories\PagesRepository(new \App\Page()),
            new \App\Repositories\PartnersRepository(new \App\Partner())
        );
        $this->template = 'index';
        $this->title = $this->settings['title'];
        $this->description = $this->settings['description'];
        $this->keywords = $this->settings['keywords'];

    }

    public function show (Page $page) {
        $this->title = $page->title;
        $this->description = $page->desc;
        $this->keywords = $page->keywords;
        $this->h1 = $page->h1;
        $this->p = $page->p;
        $this->content = view('page')->with(["page" => $page])->render();
        return $this->renderOutput();
    }
}
