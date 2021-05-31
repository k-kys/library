<?php

namespace App\Repositories\Role;

use App\Repositories\RepositoryEloquent;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRepositoryEloquent extends RepositoryEloquent implements RoleRepositoryInterface
{
    public function getModel()
    {
        return \Spatie\Permission\Models\Role::class;
    }

    public function getPermission()
    {
        return Permission::all();
    }

    public function create(array $data)
    {
        if (Role::select('name')->where('name', $data['name'])->count() > 0) {
            return [
                'message' => 'Vai trò đã tồn tại',
                'type' => 'error',
            ];
        }
        $role = Role::create(['name' => $data['name']]);
        $role->syncPermissions($data['permission_id']);

        return [
            'message' => 'Thêm vai trò thành công!',
            'type' => 'success',
        ];
    }

    public function update($id, $data)
    {
        $role = Role::find($id);
        $role->update(['name' => $data['name']]);
        $role->syncPermissions($data['permission_id']);

        return [
            'message' => 'Cập nhật thành công!',
            'type' => 'success',
        ];
    }
}
