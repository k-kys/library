<?php

namespace App\Repositories\Book;

use App\Repositories\RepositoryInterface;

interface BookRepositoryInterface extends RepositoryInterface
{
    // khai báo các function riêng của Book ngoài các func chung ở RepositoryInterface
    public function getCategory();
    public function getMajor();
    public function createBook($request, $description);
    public function updateBook($id, $request, $description);
    public function checkBook($id);
    // public static function upload(string $filename, string $path = null, string $customFileName = null);
    // public function checkImage($hasFile);
}
