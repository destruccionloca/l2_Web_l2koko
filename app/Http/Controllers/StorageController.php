<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class StorageController extends Controller
{
    public function UploadImage(Request $request)
    {
        if($request->hasFile('upload'))
        {
            $full_path="";
            $image = $request->file('upload');
            if (($image == "none") OR (empty($image->getClientOriginalName() )))
            {
                $message = "Вы не выбрали файл";
            }
            else if ($image->getClientSize()  == 0 OR $image->getClientSize()  > 20050000)
            {
                $message = "Размер файла не соответствует нормам";
            }
            else if (($image->getMimeType()  != "image/jpeg") AND ($image->getMimeType()  != "image/gif") AND ($image->getMimeType()  != "image/png"))
            {
                $message = "Допускается загрузка только картинок JPG и PNG.";
            }
            else{
                $ROOT = $_SERVER['DOCUMENT_ROOT'];
                $img = Image::make($image);
                $storeFolder = $ROOT . '/uploads/post/';   //2
                if (!file_exists($storeFolder)) {
                    mkdir($storeFolder, 0777);
                }
                $name = rand(1, 1000).'-'.$image->getClientOriginalName();
                $img->fit(300)->save($storeFolder. $name);
                $full_path = "/uploads/post/".$name;
                $message = "Файл ".$image->getClientOriginalName()." загружен";
            }
            $callback = $_REQUEST['CKEditorFuncNum'];
            echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("'.$callback.'", "'.$full_path.'", "'.$message.'" );</script>';
        }
    }
}
