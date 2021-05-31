<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    //

    public function image()
    {
        return view('test.summernote');
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
        ]);

        $description = $request->input('description');
        $dom = new \DOMDocument();
        $dom->loadHTML($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $data = $img->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list($type, $data) = explode(',', $data);
            $data = base64_decode($data);

            $path = '/storage/images/book/description/';
            if (!is_dir(public_path($path))) {
                mkdir(public_path($path), 777, true);
            }
            $imageName = $path . time() . '_' . $key . '.png';
            $path = public_path() . $imageName;

            file_put_contents($path, $data);

            $img->removeAttribute('src');
            $img->setAttribute('src', $imageName);
        }

        $description = $dom->saveHTML();

        dd($description);
    }

    public function flyResizeAvatar($size, $imagePath)
    {
        $imageFullPath = public_path($imagePath);
        $sizes = config('image.sizes');

        if (!file_exists($imageFullPath) || !isset($sizes[$size])) {
            abort(404);
        }

        $tmpArr = explode('/', $imagePath); // tách thành array bởi dấu /
        $filename = array_pop($tmpArr); // cắt và lấy phần twr cuối của array

        $savedPath = public_path('/storage/images/avatar/resize/' . $size . '/' . $filename);
        $savedDir = dirname($savedPath);
        if (!is_dir($savedDir)) {
            mkdir($savedDir, 777, true);
        }

        list($width, $height) = $sizes[$size];
        $image = Image::make($imageFullPath)->fit($width, $height)->save($savedPath);
        // dd($image);
        return $image->response();
    }

    public function flyResizeBook($size, $imagePath)
    {
        $imageFullPath = public_path($imagePath);
        $sizes = config('image.sizes');

        if (!file_exists($imageFullPath) || !isset($sizes[$size])) {
            abort(404);
        }

        $tmpArr = explode('/', $imagePath); // tách thành array bởi dấu /
        $filename = array_pop($tmpArr); // cắt và lấy phần twr cuối của array

        $savedPath = public_path('/storage/images/book/resize/' . $size . '/' . $filename);
        $savedDir = dirname($savedPath);
        if (!is_dir($savedDir)) {
            mkdir($savedDir, 777, true);
        }

        list($width, $height) = $sizes[$size];
        $image = Image::make($imageFullPath)->fit($width, $height)->save($savedPath);

        return $image->response();
    }

    public function uploadImageBook()
    {
        /**
         * name
         * ext
         * filename
         *
         */
        // if ($request->hasFile('file')) {

        //     $originalName = $request->file('file')->getClientOriginalName();
        //     $ext = $request->file('file')->getClientOriginalExtension();
        //     $fileNameWithoutExt = substr($originalName, 0, strlen($originalName) - (strlen($ext) + 1));
        //     $fileName = $fileNameWithoutExt . uniqid('_') . '.' . $ext;

        //     $path = '/storage/images/book/';
        //     if (!is_dir(public_path($path))) {
        //         mkdir(public_path($path), 777, true);
        //     }

        //     $request->file('file')->move(public_path($path), $fileName);
        //     return public_path($path) . $fileName;
        // } else {
        //     echo  $message = 'Ooops!  Your upload triggered the following error: ' . $_FILES['file']['error'];
        // }

        if ($_FILES['file']['name']) {
            if (!$_FILES['file']['error']) {
                $name = md5(Rand(100, 200));
                $ext = explode('.', $_FILES['file']['name']);
                $filename = $name . '.' . $ext[1];
                $destination = 'storage/images/book/' . $filename; //change this directory
                if (!is_dir(public_path($destination))) {
                    mkdir(public_path($destination), 777, true);
                }
                $location = $_FILES["file"]["tmp_name"];
                move_uploaded_file($location, $destination);
                echo 'storage/images/book/' . $filename; //change this URL
            } else {
                echo  $message = 'Oops!  Your upload triggered the following error:  ' . $_FILES['file']['error'];
            }
        }
    }
}
