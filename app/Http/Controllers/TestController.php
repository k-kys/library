<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Symfony\Component\Console\Input\Input;
use Photo;

class TestController extends Controller
{
    // public static function insertPhoto($fileName, $path, $defaultName = null, Request $request)
    // {
    //     $photo = null;
    //     $file = Input::file($fileName);
    //     if (Input::hasFile($fileName)) {
    //         $destinationPath = $path;
    //         $extension = $file->getClientOriginalExtension();
    //         $name = $file->getClientOriginalName();
    //         $name = date('Y-m-d') . Time() . rand(11111, 99999) . '.' . $extension;
    //         $photo = $destinationPath . '/' . $name;
    //         $file->move($destinationPath, $name);
    //     } else {
    //         $photo = $defaultName;
    //     }
    //     return $photo;
    // }

    // public function postUpload(Request $request)
    // {
    //     try {
    //         $data = array('image_path' => Photo::insertPhoto('image_path', '../storage/img', 'no image', $request));
    //         DB::table('tblImage')->insert($data);

    //         return "saved";
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    public function doUpload(Request $request)
    {
        //Kiểm tra file
        if ($request->hasFile('image_path')) {
            $file = $request->image_path;

            //Lấy Tên files
            echo 'Tên Files: ' . $file->getClientOriginalName();
            echo '<br/>';

            //Lấy Đuôi File
            echo 'Đuôi file: ' . $file->getClientOriginalExtension();
            echo '<br/>';

            //Lấy đường dẫn tạm thời của file
            echo 'Đường dẫn tạm: ' . $file->getRealPath();
            echo '<br/>';

            //Lấy kích cỡ của file đơn vị tính theo bytes
            echo 'Kích cỡ file: ' . $file->getSize();
            echo '<br/>';

            //Lấy kiểu file
            echo 'Kiểu files: ' . $file->getMimeType();

            echo 'Path: ' . $file->move('/storage/avatar', $file->getClientOriginalName());
        }
    }





    // public function upload(Request $request)
    // {
    //     $file = $request->image_path;
    //     // dd($filename);
    //     // resizing an uploaded file
    //     Image::make(Input::file('image_path'))->resize(300, 200)->save('/storage/avatar/' . $file);
    // }

    public function flyResize($size, $imagePath)
    {
        $imageFullPath = public_path($imagePath);
        $sizes = config('image.sizes');

        if (!file_exists($imageFullPath) || !isset($sizes[$size])) {
            abort(404);
        }

        $tmpArr = explode('/', $imagePath); // tách thành array bởi dấu /
        $filename = array_pop($tmpArr); // cắt và lấy phần twr cuối của array

        $savedPath = public_path('/storage/avatar/resizes/' . $size . '/' . $filename);
        $savedDir = dirname($savedPath);
        if (!is_dir($savedDir)) {
            mkdir($savedDir, 777, true);
        }

        list($width, $height) = $sizes[$size];

        $image = Image::make($imageFullPath)->fit($width, $height)->save($savedPath);

        return $image->response(); // trả về ảnh
    }

    // public function resize()
    // {
    //     $image = Image::make('/image/image.jpg');
    //     $image->fit(600, 600)->save('/resize/large/large.jpg');
    //     $image->fit(400, 400)->save('/resize/medium/medium.jpg');
    //     $image->fit(150, 150)->save('/resize/thumbnail/thumbnail.jpg');

    //     return 'Done';
    // }
}
