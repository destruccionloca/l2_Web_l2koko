<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;
use Carbon\Carbon;

class ServerController extends Controller
{
    public function showAddServer() {
        $content = view('addserver');
        return view('index')->with(["content" => $content]);
    }

    public function addServer(Request $request, Server $server) {
        $data = $request->all();
        $server->create([
            'unumber' => $this->generateRandStr(10),
            'link' => $data['link'],
            'chronicles' => $data['chronic'],
            'date_start' => Carbon::createFromFormat( 'd.m.Y H:i' ,$data['date']),
            'rate' => $data['rate'],
            'email' => $data['email'],
            'social_vk' => $data['vk'],
            'description' => $data['desc'],
            'social_groupvk' => $data['vkgroup'],
            'social_groupfb' => $data['fb'],
            'social_grouptw' => $data['tw'],
            'social_groupicq' => $data['icq'],
            'name' => $data['name'],
        ]);
        return redirect('/');
    }

    public function generateRandStr($length = 8){
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }
}
