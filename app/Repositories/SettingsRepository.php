<?php

namespace App\Repositories;

use App\Setting;
use Carbon\Carbon;
use Gate;
use Image;
use File;

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
                $last_upd = $this->model->whereName("last_upd")->first();
                $storeFolder = public_path() . '/images/';   //2
                $img = Image::make($image);
                $img_type = $this->getTypeImg($img->mime());
                if($img_type == ".err") {
                    return ['status' => 'Настройки обновлены без изображениея'];
                }
                $time = Carbon::now()->timestamp;
                if ($img->fit(1920, 285)->save($storeFolder . "bg_" . $time . $img_type)) {
                    File::delete($storeFolder . "bg_" . $last_upd->param . $setting->param);
                    //@todo:Доделать удаление
                }
                $last_upd->param = $time;
                $last_upd->update();
                $setting->param = $img_type;
                $setting->update();
            }
        }

        return array("status" => "Настройки обновлены");
    }
}

?>