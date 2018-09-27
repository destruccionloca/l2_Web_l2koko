<?php

namespace App\Http\Controllers;

use App\Repositories\PagesRepository;
use App\Repositories\PartnersRepository;
use App\Repositories\ServersRepository;
use App\Repositories\SettingsRepository;
use Illuminate\Http\Request;
use App\Mail\Servers;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    protected  $settings;

    public function __construct(SettingsRepository $settings)
    {
        $settings_col = $settings->get(["name", "param"]);
        foreach ($settings_col as $setting_col) {
            $this->settings[$setting_col->name] = $setting_col->param;
        }

    }

    public function sendMail(Request $request) {
        $data = $request->all();
        $mails = explode(";", $this->settings["mails"]);
        foreach ($mails as $mail) {
            Mail::to($mail)->send(new Servers($data));
        }
        return 'ok';
    }
}
