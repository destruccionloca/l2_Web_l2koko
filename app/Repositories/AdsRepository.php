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
                        $img_type = $this->getTypeImg($image->getMimeType());
                        $id = $this->model->id;
                        if ($img_type == ".err") {
                            return ['status' => 'Номинация добавлена без изображениея'];
                        } else if ($img_type == ".svg") {
                            $image->storeAs("/uploads/ads", "ad-" . $id . $img_type, "pub");
                        } else {
                            $img = Image::make($image);
                            $img->fit(280, 110)->save($storeFolder . "ad-" . $id . $img_type);
                        }
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
                        $storeFolder = public_path() . '/uploads/ads/';   //2
                        $img_type = $this->getTypeImg($image->getMimeType());
                        $id = $ad->id;
                        if ($img_type == ".err") {
                            return ['status' => 'Номинация добавлена без изображениея'];
                        } else if ($img_type == ".svg") {
                            $image->storeAs("/uploads/ads", "ad-" . $id . $img_type, "pub");
                        } else {
                            $img = Image::make($image);
                            $img->fit(280, 110)->save($storeFolder . "ad-" . $id . $img_type);
                        }
                        $ad->picture = $img_type;
                        $ad->update();
                    }
                }
                return ['status' => 'Рекламный блок обновлен'];
            } else {
                return ['error' => 'Ошибка обновления'];
            }
        }
    }

}