<?php

namespace App\Repositories;

use File;
use Illuminate\Support\Facades\Schema;
use Intervention\Image\Facades\Image;
// use Intervention\Image\Image;


abstract class RepositoryEloquent implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->_model = app()->make($this->getModel());
    }

    public function getAll()
    {
        return $this->_model->all();
    }

    public function query()
    {
        return $this->_model->query();
    }

    public function find($id)
    {
        return $this->_model->find($id);
    }

    public function search($keyword)
    {
        return $this->_model->where('name', 'like', "%{$keyword}%")->orderBy('name')->get();
    }


    public function show($id)
    {
        return $this->_model->where('id', $id)->first();
    }

    public function index($keyword)
    {
        if ($keyword) {
            return $this->search($keyword);
        } elseif (!$keyword || $keyword == '') {
            return $this->getAll()->sortBy('name');
        }
    }

    public function create(array $attributes)
    {
        $this->_model->create($attributes);

        return [
            'message' => 'Thêm mới thành công!',
            'type' => 'success',
        ];
    }

    public function update($id, $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);

            return [
                'message' => 'Cập nhật thành công!',
                'type' => 'success',
            ];
        }

        return [
            'message' => 'Cập nhật không thành công!',
            'type' => 'error',
        ];
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            return [
                'message' => 'Xóa thành công!',
                'type' => 'success',
            ];
        }
        return [
            'message' => 'Xóa không thành công',
            'type' => 'error',
        ];
    }



    /**
     * Xử lý upload, remove, update AVATAR IMAGE
     */

    public function getImageDirectory()
    {
        if (!is_dir(public_path($this->pathAvatar))) {
            mkdir(public_path($this->pathAvatar), 777, true);
        }
        return public_path($this->pathAvatar);
    }

    // Lay filename cua file khong chua phan dinh dang file
    public function getFileNameWithoutExtension($originalFileName, $extensionFileName)
    {
        return substr($originalFileName, 0, strlen($originalFileName) - (strlen($extensionFileName) + 1));
    }

    // Kiem tra file co ton tai khong
    public function isExistedFile($path)
    {
        return File::exists(public_path($path));
        // return File::exists($this->uploadDir . '/' . $originalFileName);
    }

    // Tao file name khong trung voi file khac
    public function createUniqueFileName($originalFileName, $extensionFileName)
    {
        // $fileName = '';
        // if ($this->isExistedFile($originalFileName)) {
        $fileNameWithoutExtension = $this->getFileNameWithoutExtension($originalFileName, $extensionFileName);
        $fileName = $fileNameWithoutExtension . uniqid('_') . '.' . $extensionFileName;
        // } else {
        //     $fileName = $originalFileName;
        // }
        return $fileName;
    }

    // Lay path cua avatar cu
    public function getOldImagePath($id)
    {
        return $this->_model->findOrFail($id)->image;
    }

    // Upload File
    public function uploadImage($hasFile, $file)
    {
        $imageFileName = null;
        if ($hasFile) {
            $originalFileName = $file->getClientOriginalName();
            $extensionFileName = $file->getClientOriginalExtension();
            $imageFileName = $this->createUniqueFileName($originalFileName, $extensionFileName);
            $file->move($this->getImageDirectory(), $imageFileName);
        }
        return $imageFileName;
    }

    // Xoa anh avatar
    public function removeImage($path)
    {
        if ($this->isExistedFile($path)) {
            $tmpArr = explode('/', $path);
            $fileName = array_pop($tmpArr);
            $resizeThumbnailPath = public_path('/storage/images/avatar/resize/thumbnail/' . $fileName);

            File::delete($resizeThumbnailPath);
            File::delete(public_path($path));
        }
    }

    // cập nhật Ảnh
    public function updateImagePath($requestHasFile, $requestFile, $id)
    {
        $oldImagePath = $this->getOldImagePath($id);
        if ($requestHasFile) {
            if ($oldImagePath) {
                $this->removeImage($oldImagePath);
            }
            $imageFileName = $this->uploadImage($requestHasFile, $requestFile);
            return $this->pathAvatar . $imageFileName;
        }
        return false;
    }

    public function getDescription($oldDescription, $request, $path)
    {
        // Tắt lỗi libxml - Disable libxml errors and allow user to fetch error information as needed
        libxml_use_internal_errors(true);

        // khai báo biến trả về description mặc định là null nếu không có giá trị
        $result = null;

        // Lấy description mới trên form vừa submit
        $description = $request->description;
        if (!empty($description)) {
            # code...
            $dom = new \DOMDocument();
            $dom->loadHTML(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            $src = [];
            foreach ($images as $key => $img) {
                $data = $img->getAttribute('src');
                // Lấy src của description mới cho vào 1 array
                array_push($src, $data);

                // Tạo ảnh mới
                if (strpos($data, 'base64') !== false) {
                    // echo 'Tìm thấy';
                    list($type, $data) = explode(';', $data);
                    list($type, $data) = explode(',', $data);
                    // giải mã base64
                    $data = base64_decode($data);

                    // $path = '/storage/images/book/description/';
                    if (!is_dir(public_path($path))) {
                        mkdir(public_path($path), 777, true);
                    }
                    // Tạo 1 ảnh png
                    $imageName = $path . time() . '_' . $key . '.png';
                    $publicPath = public_path() . $imageName;

                    // ghi dữ liệu vào ảnh png vừa tạo (chuyển base64 vào ảnh -> tạo ra ảnh mới)
                    file_put_contents($publicPath, $data);

                    // Xoá src cũ chứa base64; đặt src mới chứa đường dẫn ảnh vừa tạo
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $imageName);
                }
            }

            $result = $dom->saveHTML();
        }

        if (!empty($oldDescription)) {
            // Lấy src của description cũ cho vào 1 array
            $domOldDescription = new \DOMDocument();

            $domOldDescription->loadHTML(mb_convert_encoding($oldDescription, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imagesOldDescription = $domOldDescription->getElementsByTagName('img');
            $srcOld = [];
            foreach ($imagesOldDescription as $key => $value) {
                array_push($srcOld, $value->getAttribute('src'));
            }
            // Lấy src có trong description cũ mà không có trong description mới (đã bỏ ảnh đó khỏi mô tả mới -> xoá ảnh)
            $srcDelete = array_diff($srcOld, $src);
            foreach ($srcDelete as $key => $value) {
                $this->removeImage($value);
            }
        }

        return $result;
    }
}
