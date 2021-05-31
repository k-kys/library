<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Repositories\Major\MajorRepositoryInterface;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    protected $majorRepository;

    public function __construct(MajorRepositoryInterface $majorRepository)
    {
        $this->majorRepository = $majorRepository;
    }

    public function index(Request $request)
    {
        $majors = $this->majorRepository->index($request->keyword);

        return view('admin.major.index', compact('majors'));
    }

    public function store(Request $request)
    {
        $result = $this->majorRepository->create($request->all());
        toast($result['message'], $result['type']);

        return redirect()->route('admin.major');
    }

    public function edit($id)
    {
        $major = $this->majorRepository->find($id);

        return view('admin.major.edit', compact('major'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'name' => $request->name,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $result = $this->majorRepository->update($id, $data);
        toast($result['message'], $result['type']);

        return redirect()->route('admin.major');
    }

    public function delete($id)
    {
        $result = $this->majorRepository->delete($id);
        toast($result['message'], $result['type']);

        return redirect()->route('admin.major');
    }
}
