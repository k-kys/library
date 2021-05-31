<?php

namespace App\Http\Controllers;

use App\Repositories\Permission\PermissionRepositoryInterface;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index(Request $request)
    {
        $permissions = $this->permissionRepository->index($request->keyword);

        return view('admin.permission.index', compact('permissions'));
    }

    public function store(Request $request)
    {
        $result = $this->permissionRepository->create($request->all());
        toast($result['message'], $result['type']);

        return redirect()->route('admin.permission');
    }

    public function delete($id)
    {
        $result = $this->permissionRepository->delete($id);
        toast($result['message'], $result['type']);

        return redirect()->route('admin.permission');
    }
}
