<?php

namespace App\Repositories\Book;

use App\Models\Book;
use App\Models\Category;
use App\Models\Major;
use App\Repositories\RepositoryEloquent;
use Illuminate\Support\Facades\DB;

class BookRepositoryEloquent extends RepositoryEloquent implements BookRepositoryInterface
{
    protected $pathAvatar = '/storage/images/book/';

    public function getModel()
    {
        // có thể để scope vào đây => sửa duy nhất ở đây
        return \App\Models\Book::class;
    }

    // các function từ BookRepositoryInterface (nếu có)
    public function getCategory()
    {
        return Category::all();
    }

    public function getMajor()
    {
        return Major::all();
    }

    // * ADMIN
    public function index($keyword)
    {
        if ($keyword) {
            return $this->search($keyword);
        } elseif (!$keyword || $keyword == '') {
            return $this->getAll()->sortByDesc('updated_at');
        }
    }

    public function createBook($request, $description)
    {
        $path = '/storage/images/book/';
        $imageFileName = $this->uploadImage($request->hasFile('image'), $request->file('image'));
        $imagePath = $path . $imageFileName;
        $book = new Book();
        $book->isbn = $request->isbn;
        $book->name = $request->name;
        $book->description = $description;
        $book->price = $request->price;
        $book->amount = $request->amount;
        $book->stock_amount = $request->amount;
        if ($imageFileName !== null) {
            $book->image = $imagePath;
        }
        $book->created_at = date('Y-m-d H:i:s');
        $book->save();
        $book->categories()->attach($request->category_id);
        $book->majors()->attach($request->major_id);

        return [
            'message' => 'Thêm sách thành công!',
            'type' => 'success',
        ];
    }

    public function updateBook($id, $request, $description)
    {
        $imagePath = $this->updateImagePath($request->hasFile('image'), $request->file('image'), $id);
        $book = Book::find($id);
        $book->isbn = $request->isbn;
        $book->name = $request->name;
        $book->description = $description;
        $book->price = $request->price;
        $book->amount = $book->amount + $request->add_amount;
        $book->stock_amount = $book->stock_amount + $request->add_amount;
        if ($imagePath) {
            $book->image = $imagePath;
        }
        $book->updated_at = date('Y-m-d H:i:s');
        $book->save();
        $book->categories()->sync($request->category_id);
        $book->majors()->sync($request->major_id);

        return [
            'message' => 'Sửa sách thành công!',
            'type' => 'success',
        ];
    }

    public function checkBook($id)
    {
        $check = DB::table('books_out_on_loan')->select('book_id')->where([['book_id', $id], ['status', '=', 0]])->count();
        if ($check > 0) {
            return false;
        }
        return true;
    }

    // public static function upload(string $name, string $path = null, string $customFileName = null)
    // {
    //     $filename = $_FILES[$name]['name'];

    //     $tmpArr = explode('.', $filename);
    //     $extension = array_pop($tmpArr);

    //     $newName = time() . ".{$extension}";

    //     if ($customFileName) {
    //         $newName = $customFileName;
    //     }
    //     $uploadPath = '/img/book/' . $newName;
    //     if ($path) {
    //         $uploadPath = $path . $newName;
    //     }
    //     $tmpPath = $_FILES[$name]['tmp_name'];
    //     move_uploaded_file($tmpPath, './' . $uploadPath);

    //     return $uploadPath;

    //     // $filename = $request->img;
    //     // $extension = $request->img->extension();
    //     // $path = $request->img->path();
    //     // return $data['img']->store('./image/book');
    // }

    // public function checkImage($hasFile)
    // {
    //     if ($hasFile) {
    //         $path = $this->upload('img');

    //         return $path;
    //     } else {
    //         return null;
    //     }
    // }
}
