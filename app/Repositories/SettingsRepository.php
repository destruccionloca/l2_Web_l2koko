<?php

namespace App\Repositories;

use App\Setting;
use Gate;
use Image;

class SettingsRepository extends Repository {

    public function __construct(Setting $setting) {
        $this->model = $setting;
    }

    public function updateSettings($request) {
        $data = $request->except('_token', '_method');;
        foreach ($data as $key => $value) {
            $setting = $this->model->whereName($key)->first();
            $setting->param = $value;
            if (!$setting->update()) {
                return array("error" => "Ошибка обновления настроек");
            }
        }
        if ($request->hasFile('main_pic')) {
            $image = $request->file('main_pic');
            if ($image->isValid()) {
                $setting = $this->model->whereName("main_pic")->first();
                $storeFolder = public_path() . '/images/';   //2
                $img = Image::make($image);
                $img_type = $this->getTypeImg($img->mime());
                if($img_type == ".err") {
                    return ['status' => 'Настройки обновлены без изображениея'];
                }
                $img->fit(1920, 372)->save($storeFolder . "bg" . $img_type);
                $setting->param = $img_type;
                $setting->update();
            }
        }

        return array("status" => "Настройки обновлены");
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

?>