<?php
/**
 * Created by PhpStorm.
 * User: Andreev
 * Date: 01.03.2018
 * Time: 13:19
 */

namespace App\Repositories;

use App\Nomination;
use Image;
use File;


class NominationsRepository extends Repository
{

    public function __construct(Nomination $nomination) {
        $this->model = $nomination;
    }

    /**
     * @param $request
     * @return array
     */
    public function add($request) {
        if ($request->has("name")) {
            $data = $request->all();
            $this->model->name = $data["name"];
            if (empty($data['alias'])) {
                $data['alias'] = $this->transliterate($data['name']);
            }
            if ($this->one($data['alias'], FALSE)) {
                $request->merge(array('alias' => $data['alias']));
                $request->flash();

                return ['error' => 'Номинация с таким названием уже существует'];
            }
            if($data["server_id"] == "null") {
                $this->model->server_id = null;
            }else {
                $this->model->server_id = $data["server_id"];
            }
            $this->model->alias = $data["alias"];
            if ($this->model->save()) {
                if ($request->hasFile('picture')) {
                    $image = $request->file('picture');
                    if ($image->isValid()) {
                        $storeFolder = public_path() . '/uploads/nominations/';   //2
                        $img_type = $this->getTypeImg($image->getMimeType());
                        $id = $this->model->id;
                        if ($img_type == ".err") {
                            return ['status' => 'Номинация добавлена без изображениея'];
                        } else if ($img_type == ".svg") {
                            if(file_exists($storeFolder . "nomination-" . $id . $img_type)) {
                                unlink($storeFolder . "nomination-" . $id . $img_type);
                            }
                            $image->storeAs("/uploads/nominations", "nomination-" . $id . $img_type, "pub");
                        } else {
                            if(file_exists($storeFolder . "nomination-" . $id . $img_type)) {
                                unlink($storeFolder . "nomination-" . $id . $img_type);
                            }
                            $img = Image::make($image);
                            $img->fit(54,54)->save($storeFolder . "nomination-" . $id . $img_type);
                        }
                        $this->model->picture = $img_type. "?ver=". random_int(1,1000);
                        $this->model->update();
                    }
                }
                return ['status' => 'Номинация добавлена'];
            } else {
                return ['error' => 'Ошибка добаления'];
            }
        }
    }

    public function update($request, $nomination) {
        if ($request->has("name")) {
            $data = $request->all();
            $nomination->name = $data["name"];
            if (empty($data['alias'])) {
                $data['alias'] = $this->transliterate($data['name']);
            }

            $result = $this->one($data['alias'],FALSE);
            if(isset($result->id) && ($result->id != $nomination->id)) {
                $request->merge(array('alias' => $data['alias']));
                $request->flash();

                return ['error' => 'Статья с таким названием уже существует'];
            }

            if($data["server_id"] == "null") {
                $nomination->server_id = null;
            } else {
                $nomination->server_id = $data["server_id"];
            }

            $nomination->alias = $data["alias"];
            if ($nomination->update()) {
                if ($request->hasFile('picture')) {
                    $image = $request->file('picture');
                    if ($image->isValid()) {
                        $storeFolder = public_path() . '/uploads/nominations/';   //2
                        $img_type = $this->getTypeImg($image->getMimeType());
                        $id = $nomination->id;
                        if ($img_type == ".err") {
                            return ['status' => 'Номинация добавлена без изображениея'];
                        } else if ($img_type == ".svg") {
                            if(file_exists($storeFolder . "nomination-" . $id . $img_type)) {
                                unlink($storeFolder . "nomination-" . $id . $img_type);
                            }
                            $image->storeAs("/uploads/nominations", "nomination-" . $id . $img_type, "pub");
                        } else {
                            if(file_exists($storeFolder . "nomination-" . $id . $img_type)) {
                                unlink($storeFolder . "nomination-" . $id . $img_type);
                            }
                            $img = Image::make($image);
                            $img->fit(54,54)->save($storeFolder . "nomination-" . $id . $img_type);
                        }
                        $nomination->picture = $img_type. "?ver=". random_int(1,1000);
                        $nomination->update();
                    }
                }
                return ['status' => 'Номинация обновлена'];
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