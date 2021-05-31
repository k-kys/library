<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryRepository->index($request->keyword);
        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $result = $this->categoryRepository->create($request->all());
        toast($result['message'], $result['type']);

        return redirect()->route('admin.category');
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'name' => $request->name,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $result = $this->categoryRepository->update($id, $data);
        toast($result['message'], $result['type']);
        return redirect()->route('admin.category');
    }

    public function delete($id)
    {
        $result = $this->categoryRepository->delete($id);
        toast($result['message'], $result['type']);
        return redirect()->route('admin.category');
    }
}
