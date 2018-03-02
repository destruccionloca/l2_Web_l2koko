<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;

class IndexController extends Controller
{
    public function index(Server $server) {
        $servers = $server->all();
        $yesterday = $server->Yesterday()->get();
        $opened = $server->Open()->get();
        $week = $server->Week()->get();
        $seven_days =  $server->SevenDays()->get();
        $content = view('main')->with(["servers" => $servers, "yesterday" => $yesterday, "opened" => $opened, "week" => $week, "seven_days" => $seven_days]);
        return view('index')->with(["content" => $content]);
    }
}
