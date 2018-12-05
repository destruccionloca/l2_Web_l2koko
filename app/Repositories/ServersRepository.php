<?php
/**
 * Created by PhpStorm.
 * User: Andreev
 * Date: 20.02.2018
 * Time: 10:17
 */

namespace App\Repositories;


use App\Server;
use App\Mail\Servers;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Rate;
use App\Chronicle;
use App\Repositories\SettingsRepository;

class ServersRepository extends Repository
{
    protected $settings;
    protected $mails;

    public function __construct(Server $server) {
        $this->model = $server;
        $setting  = new SettingsRepository(new \App\Setting);
        $settings_col = $setting->get(["name", "param"]);
        foreach ($settings_col as $setting_col) {
            $this->settings[$setting_col->name] = $setting_col->param;
        }
        $this->mails = explode(";", $this->settings["mails"]);
    }

    public function add($request, $from = "back_side") {
        if ($request->has("name")) {
            setlocale(LC_TIME, 'ru_RU.utf8');
            $data = $request->all();
            $data["name"] = strtoupper($data["name"]);
            $rate = Rate::find($data["rate_id"]);
            $chronicle = Chronicle::find($data["chronicle_id"]);
            $this->model->name = $data["name"];
            if (empty($data['alias'])) {
                $data['alias'] = $this->transliterate($data['name']);
            }
            if ($this->one($data['alias'], FALSE)) {
                $request->merge(array('alias' => $data['alias']));
                $request->flash();

                return ['error' => 'Сервер с таким названием уже существует'];
            }
            $this->model->description = $data["description"];
            $this->model->short_desc = isset($data["short_desc"])? $data["short_desc"]: null;
            $this->model->start_at = Carbon::createFromFormat('d.m.Y H:i', $data['start_at']);
            $this->model->chronicle_id = $data["chronicle_id"];
            if ($from == "front_side") {
                $this->model->status_id = 1;
                $this->model->moderated = 0;
            } else {
                $this->model->status_id = $data["status_id"];
                $this->model->moderated = 1;
            }
            $this->model->rate_id = $data["rate_id"];
            $this->model->link = $data["link"];
            $this->model->email = $data["email"];
            $this->model->social_vk = isset($data["vk"])? $data["vk"]: null;
            $this->model->social_fb = isset($data["fb"])? $data["fb"]: null;
            $this->model->social_tw = isset($data["tw"])? $data["tw"]: null;
            $this->model->social_icq = isset($data["icq"])? $data["icq"]: null;
            $this->model->alias = $data["alias"];
            $this->model->title = isset($data["title"])? $data["title"] : $data["name"];
            $this->model->h1 = isset($data["h1"])? $data["h1"] : $data["name"] . " - " . $chronicle->name . " " . $rate->name;
            $this->model->p = isset($data["p"])? $data["p"] : "Открытие " . $this->model->start_at->format('d') . " " . $this->monthTrans($this->model->start_at->formatLocalized('%B')) . ", в " . $this->model->start_at->format('H:i');
            $this->model->h2 = isset($data["h2"])? $data["h2"] : $data['link'];
            if ($this->model->save()) {
                if ($request->hasFile('picture')) {
                    $image = $request->file('picture');
                    if ($image->isValid()) {
                        $storeFolder = public_path() . '/uploads/servers';   //2
                        $id = $this->model->id;
                        $img_type = $this->getTypeImg($image->getMimeType());
                        if($img_type == ".err") {
                            return ['status' => 'Сервер обновлен без изображениея'];
                        } else if ($img_type == ".svg") {
                            $image->storeAs("/uploads/servers", "server-". $id . $img_type, "pub");
                        } else {
                            $img = Image::make($image);
                            $img->save($storeFolder . "server-". $id . $img_type);
                        }
                        $img = Image::make($image);
                        $img->fit(537,240)->insert($storeFolder . "/WATEMARK.png", "bottom-right")->save($storeFolder . "/server-" . $id . $img_type);
                        $this->model->picture = $img_type;
                        $this->model->update();
                    }
                } else {
                    $this->model->picture = "default";
                    $this->model->update();
                }
                $this->sendMail($this->model->name);
                return ['status' => 'Сервер добавлен'];
            } else {
                return ['error' => 'Ошибка добаления'];
            }
        }
    }

    public function update($request, $server) {
        if ($request->has("name")) {
            setlocale(LC_TIME, 'ru_RU.utf8');
            $data = $request->all();
            $data["name"] = strtoupper($data["name"]);
            $server->name = $data["name"];
            if(empty($data['alias'])) {
                $data['alias'] = $this->transliterate($data['name']);
            }
            $result = $this->one($data['alias'],FALSE);
            if(isset($result->id) && ($result->id != $server->id)) {
                $request->merge(array('alias' => $data['alias']));
                $request->flash();

                return ['error' => 'Статья с таким названием уже существует'];
            }
            $server->description = $data["description"];
            $server->short_desc = isset($data["short_desc"])? $data["short_desc"]: null;
            $server->start_at = Carbon::createFromFormat( 'd.m.Y H:i' ,$data['start_at']);
            $server->chronicle_id = $data["chronicle_id"];
            $server->rate_id = $data["rate_id"];
            $server->status_id = $data["status_id"];
            $server->link = $data["link"];
            $server->email = $data["email"];
            $server->social_vk = isset($data["vk"])? $data["vk"]: null;
            $server->social_fb = isset($data["fb"])? $data["fb"]: null;
            $server->social_tw = isset($data["tw"])? $data["tw"]: null;
            $server->social_icq = isset($data["icq"])? $data["icq"]: null;
            $server->alias = $data["alias"];
            $server->title = isset($data["title"])? $data["title"]: $data["name"];
            $server->h1 = isset($data["h1"])? $data["h1"]: $data["name"] . " - " . $server->chronicle->name . " " . $server->rate->name;
            $server->p = isset($data["p"])? $data["p"] : "Открытие " . $server->start_at->format('d') ." ". $this->monthTrans($server->start_at->formatLocalized('%B')) . ", в " . $server->start_at->format('H:i');
            $server->h2 = isset($data["h2"])? $data["h2"] : $data['link'];
            if($server->save()) {
                if ($request->hasFile('picture')) {
                    $image = $request->file('picture');
                    if ($image->isValid()) {
                        $storeFolder = public_path() . '/uploads/servers';   //2
                        $id = $server->id;
                        $img_type = $this->getTypeImg($image->getMimeType());
                        if($img_type == ".err") {
                            return ['status' => 'Сервер обновлен без изображениея'];
                        } else if ($img_type == ".svg") {
                            $image->storeAs("/uploads/servers", "server-". $id . $img_type, "pub");
                        } else {
                            $img = Image::make($image);
                            $img->fit(537,240)->insert($storeFolder . "/WATEMARK.png", "bottom-right")->save($storeFolder . "/server-". $id . $img_type);
                        }
                        $server->picture = $img_type;
                        $server->update();
                    }
                }
                return ['status' => 'Сервер обновлен'];
            } else {
                return ['error' => 'Ошибка обновления'];
            }
        }
    }

    private function monthTrans($month){
        $m = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
        $m_ = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
        for ($i = 0; $i < count($m); $i++) {
            if ($month == $m[$i]) {
                return $m_[$i];
            }
        }
    }

    public function one($alias, $attr = array()) {
        $server = parent::one($alias,$attr);
        return $server;
    }

    private function sendMail($server){
        foreach ($this->mails as $mail) {
            Mail::to($mail)->send(new Servers(["server" => $server]));
        }
    }
}