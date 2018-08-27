<?php
/**
 * Created by PhpStorm.
 * User: Andreev
 * Date: 20.02.2018
 * Time: 10:17
 */

namespace App\Repositories;


use App\Server;
use Image;
use Carbon\Carbon;

class ServersRepository extends Repository
{

    public function __construct(Server $server) {
        $this->model = $server;
    }

    public function add($request, $from = "back_side") {
        if ($request->has("name")) {
            $data = $request->all();
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
            $this->model->short_desc = $data["short_desc"];
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
            $this->model->social_fb = isset($data["fb"])? $data["fb"]: null;;
            $this->model->social_tw = isset($data["tw"])? $data["tw"]: null;
            $this->model->social_icq = isset($data["icq"])? $data["icq"]: null;
            $this->model->alias = $data["alias"];
            $this->model->title = isset($data["title"])? $data["title"]: null;
            $this->model->h1 = isset($data["h1"])? $data["h1"]: null;
            $this->model->p = isset($data["p"])? $data["p"]: null;
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
                        $img->fit(537,240)->insert($storeFolder . "/WATEMARK.png", "bottom-right")->save($storeFolder . "server-" . $id . $img_type);
                        $this->model->picture = $img_type;
                        $this->model->update();
                    }
                } else {
                    $this->model->picture = "default";
                    $this->model->update();
                }
                return ['status' => 'Сервер добавлен'];
            } else {
                return ['error' => 'Ошибка добаления'];
            }
        }
    }

    public function update($request, $server) {
        if ($request->has("name")) {
            $data = $request->all();
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
            $server->short_desc = $data["short_desc"];
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
            $server->title = isset($data["title"])? $data["title"]: null;
            $server->h1 = isset($data["h1"])? $data["h1"]: null;
            $server->p = isset($data["p"])? $data["p"]: null;
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

    public function one($alias, $attr = array()) {
        $server = parent::one($alias,$attr);
        return $server;
    }

}