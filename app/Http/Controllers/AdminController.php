<?php

namespace App\Http\Controllers;

use App\Repositories\Admin\AdminRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    protected $adminRepository;
    private $photoPath;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
        $this->photoPath = public_path('/storage/images/avatar');
    }

    public function index(Request $request)
    {
        $staffs = $this->adminRepository->index($request->keyword);

        return view('admin.staff.index', compact('staffs'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $result = $this->adminRepository->create($data);
        toast($result['message'], $result['type']);

        return redirect()->route('admin.staff');
    }

    public function show()
    {
        # code...
    }

    public function edit($id)
    {
        $staff = $this->adminRepository->find($id);

        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $result = $this->adminRepository->update($id, $request->all());
        toast($result['message'], $result['type']);

        return redirect()->route('admin.staff');
    }

    public function delete($id)
    {
        $result = $this->adminRepository->delete($id);
        toast($result['message'], $result['type']);

        return redirect()->route('admin.staff');
    }

    public function editRolePermission($id, Request $request)
    {
        $staff = $this->adminRepository->find($id);
        $roles = $this->adminRepository->getRole();
        $permissions = $this->adminRepository->getPermission();

        return view('admin.staff.role-permission', compact('staff', 'roles', 'permissions'));
    }

    protected $model = 'App\Models\Admin';

    public function updateRolePermission($id, Request $request)
    {
        $staff = $this->adminRepository->find($id);

        // $roleName = Role::findById($role_id)->name;
        if (!$request->role_id && !$request->permission_id) {
            toast('Lỗi phân quyền', 'error');
            return redirect()->route('admin.staff');
        }

        if (!$request->role_id) {
            $role = DB::table('model_has_roles')->select('role_id')->where('model_type', $this->model)->first();
            if ($role) {
                $staff->removeRole($role->role_id);
            }
        } else {
            $staff->syncRoles($request->role_id);
        }

        if (!$request->permission_id) {
            $permission = DB::table('model_has_permissions')->select('permission_id')->where('model_type', $this->model)->first();
            if ($permission) {
                $staff->revokePermissionTo($permission->permission_id);
            }
        } else {
            $staff->syncPermissions($request->permission_id);
        }

        toast('Phân quyền thành công!', 'success');
        return redirect()->route('admin.staff');
    }



    // MY PROFILE
    public function profile()
    {
        $profile = $this->adminRepository->find(Auth::guard('admin')->id());
        return view('admin.profile.index', compact('profile'));
    }

    public function updateProfile(Request $request, $id)
    {
        $result = $this->adminRepository->updateProfile($id, $request);
        toast($result['message'], $result['type']);
        return redirect()->route('admin.profile');
    }
}
