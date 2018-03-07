<?php
/**
 * Created by PhpStorm.
 * User: Andreev
 * Date: 05.03.2018
 * Time: 10:49
 */

namespace App\Repositories;


use App\Ad;
use Image;

class AdsRepository extends Repository
{

    public function __construct(Ad $ad) {
        $this->model = $ad;
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

            if ($this->model->save()) {
                if ($request->hasFile('picture')) {
                    $image = $request->file('picture');
                    if ($image->isValid()) {
                        $storeFolder = public_path() . '/' . '/uploads/ads/';   //2
                        $img = Image::make($image);
                        $img_type = $this->getTypeImg($img->mime());
                        if ($img_type == ".err") {
                            return ['status' => 'Партнер добавлен без изображения'];
                        }
                        $id = $this->model->id;
                        $img->save($storeFolder . "ad-" . $id . $img_type);
                        $this->model->picture = $img_type;
                        $this->model->update();
                    }
                }
                return ['status' => 'Рекламный блок добавлен'];
            } else {
                return ['error' => 'Ошибка добаления'];
            }
        }
    }

    public function update($request, $ad) {
//		if (\Gate::denies('create',$this->model)) {
////            abort(403);
//        }
        if ($request->has("title")) {
            $data = $request->all();
            $ad->title = $data["title"];
            $ad->link = $data["link"];
            $ad->alt = $data["alt"];

            if ($ad->update()) {
                if ($request->hasFile('picture')) {
                    $image = $request->file('picture');
                    if ($image->isValid()) {
                        $storeFolder = public_path() . '/' . '/uploads/ads/';   //2
                        $img = Image::make($image);
                        $img_type = $this->getTypeImg($img->mime());
                        if ($img_type == ".err") {
                            return ['status' => 'Партнер добавлен без изображения'];
                        }
                        $id = $ad->id;
                        $img->save($storeFolder . "ad-" . $id . $img_type);
                        $ad->picture = $img_type;
                        $ad->update();
                    }
                }
                return ['status' => 'Реклаиный блок обновлен'];
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