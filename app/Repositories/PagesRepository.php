<?php
/**
 * Created by PhpStorm.
 * User: Трик
 * Date: 18.06.2017
 * Time: 21:14
 */

namespace App\Repositories;

use App\Page;
use Image;

class PagesRepository extends Repository
{

    public function __construct(Page $page) {
        $this->model = $page;
    }

    public function one($alias,$attr = array()) {
        $article = parent::one($alias,$attr);
//        if($article && !empty($attr)) {
//            $article->load('comments');
//            $article->comments->load('user');//        }
        return $article;
    }

    public function addPage($request) {
//		if (\Gate::denies('create',$this->model)) {
////            abort(403);
//        }
        $data = $request->all();
        if(empty($data['alias'])) {
            $data['alias'] = $this->transliterate($data['title']);
        }
        if($this->one($data['alias'],FALSE)) {
            $request->merge(array('alias' => $data['alias']));
            $request->flash();

            return ['error' => 'Страница с таким названием уже существует'];
        }
        $this->model->create([
            'title' => $data['title'],
            'text' => $data['text'],
            'desc' => $data['desc'],
            'keywords' => $data['keywords'],
            'alias' => $data['alias'],
            'type' => $data['type'],
        ]);

        return ['status' => 'Страница добавлена'];

    }

    public function editPage($request, $page) {
//		if (\Gate::denies('create',$this->model)) {
////            abort(403);
//        }
        $data = $request->all();
        if(empty($data['alias'])) {
            $data['alias'] = $this->transliterate($data['title']);
        }

        $result = $this->one($data['alias'],FALSE);

        if(isset($result->id) && ($result->id != $page->id)) {
            $request->merge(array('alias' => $data['alias']));
            $request->flash();

            return ['error' => 'Статья с таким названием уже существует'];
        }
        $page->update([
            'title' => $data['title'],
            'text' => $data['text'],
            'desc' => $data['desc'],
            'alias' => $data['alias'],
            'keywords' => $data['keywords'],
            'type' => $data['type'],
        ]);

        return ['status' => 'Статья обновлена'];

    }

    public function deletePage($page) {
        if($page->delete()) {
            return ['status' => 'Статья удалена'];
        } else {
            return ["error" => "Ошибка удаления статьи"];
        }
    }

    private function uploadImage($request) {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $uploadDir = public_path() . '/' . config('settings.theme') . '/uploads/page/';   //2
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777);
                }
                $img = Image::make($image);
                $img_type = $this->getTypeImg($img->mime());
                if($img_type == ".err") {
                    return false;
                }
                $str = str_random(8);
                $image_path = $str . $img_type;
                $img->fit(480, 360)->save($uploadDir ."/". $image_path);
                return $image_path;
            }
        }
        return $request->has('old_image') ? $request->old_image : '';
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