<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03.03.2018
 * Time: 10:31
 */

namespace App\Repositories;

use App\Partner;
use Image;

class PartnersRepository extends Repository
{

    public function __construct(Partner $partner) {
        $this->model = $partner;
    }

    public function add($request) {
//		if (\Gate::denies('create',$this->model)) {
////            abort(403);
//        }
        if ($request->has("title")) {
            $data = $request->all();
            $this->model->title = $data["title"];
            $this->model->link = $data["link"];
            $this->model->alt = $data["alt"];
            $this->model->token = (isset($data["token"])) ? $data["token"] : null;
            $this->model->group_id = (isset($data["group_id"])) ? $data["group_id"] : null;

            if ($this->model->save()) {
                if ($request->hasFile('picture')) {
                    $image = $request->file('picture');
                    if ($image->isValid()) {
                        $storeFolder = public_path() . '/' . '/uploads/partners/';   //2
                        $img = Image::make($image);
                        $img_type = $this->getTypeImg($img->mime());
                        if ($img_type == ".err") {
                            return ['status' => 'Партнер добавлен без изображения'];
                        }
                        $id = $this->model->id;
                        $img->fit(255,90)->save($storeFolder . "partner-" . $id . $img_type);
                        $this->model->picture = $img_type;
                        $this->model->update();
                    }
                }
                return ['status' => 'Партнер добавлен'];
            } else {
                return ['error' => 'Ошибка добаления'];
            }
        }
    }

    public function update($request, $partner) {
//		if (\Gate::denies('create',$this->model)) {
////            abort(403);
//        }
        if ($request->has("title")) {
            $data = $request->all();
            $partner->title = $data["title"];
            $partner->link = $data["link"];
            $partner->alt = $data["alt"];
            $partner->token = $data["token"];
            $partner->group_id = $data["group_id"];

            if ($partner->update()) {
                if ($request->hasFile('picture')) {
                    $image = $request->file('picture');
                    if ($image->isValid()) {
                        $storeFolder = public_path() . '/' . '/uploads/partners/';   //2
                        $img = Image::make($image);
                        $img_type = $this->getTypeImg($img->mime());
                        if ($img_type == ".err") {
                            return ['status' => 'Партнер добавлен без изображения'];
                        }
                        $id = $partner->id;
                        $img->fit(255,90)->save($storeFolder . "partner-" . $id . $img_type);
                        $partner->picture = $img_type;
                        $partner->update();
                    }
                }
                return ['status' => 'Партнер обновлен'];
            } else {
                return ['error' => 'Ошибка обновления'];
            }
        }
    }

    private function getTypeImg($mime) {
        if ($mime == "image/gif") {
            return ".gif";
        } else if ($mime == "image/jpeg") {
            return ".jpg";
        } else if ($mime == "image/png") {
            return ".png";
        } else {
            return ".err";
        }

    }

}