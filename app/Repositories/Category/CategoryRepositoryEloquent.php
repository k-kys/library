<?php

namespace App\Repositories\Category;

use App\Repositories\RepositoryEloquent;

class CategoryRepositoryEloquent extends RepositoryEloquent implements CategoryRepositoryInterface
{
    public function getModel()
    {
        # code...
        return \App\Models\Category::class;
    }

    // public function create(array $data)
    // {
    //     $category = new Category();
    //     $category->name = $data['name'];
    //     $category->created_at = date('Y-m-d H:i:s');
    //     $category->save();
    // }

    // public function update($id, array $data)
    // {
    //     $category = Category::find($id);
    //     $category->name = $data['name'];
    //     $category->updated_at = date('Y-m-d H:i:s');
    //     $category->save();
    // }
}
