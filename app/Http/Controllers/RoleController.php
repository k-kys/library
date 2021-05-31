<?php

namespace App\Http\Controllers;

use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index(Request $request)
    {
        $roles = $this->roleRepository->index($request->keyword);
        $permissions = $this->roleRepository->getPermission();

        return view('admin.role.index', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $result = $this->roleRepository->create($request->all());
        toast($result['message'], $result['type']);

        return redirect()->route('admin.role');
    }

    public function edit($id, Request $request)
    {
        $role = $this->roleRepository->find($id);
        $permissions = $this->roleRepository->getPermission();

        return view('admin.role.edit', compact('role', 'permissions'));
    }

    public function update($id, Request $request)
    {
        $result = $this->roleRepository->update($id, $request->all());
        toast($result['message'], $result['type']);

        return redirect()->route('admin.role');
    }

    public function delete($id)
    {
        $result = $this->roleRepository->delete($id);
        toast($result['message'], $result['type']);

        return redirect()->route('admin.role');
    }
}
