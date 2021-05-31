<?php

namespace App\Repositories\Admin;

use App\Models\Admin;
use App\Repositories\RepositoryEloquent;
use Illuminate\Support\Facades\Hash;
use Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminRepositoryEloquent extends RepositoryEloquent implements AdminRepositoryInterface
{
    protected $pathAvatar = '/storage/images/avatar/';

    public function getModel()
    {
        return \App\Models\Admin::class;
    }

    public function getRole()
    {
        return Role::all();
    }

    public function getPermission()
    {
        return Permission::all();
    }

    public function create(array $data)
    {
        $emailTest = $this->_model->where('email', $data['email'])->count();
        if ($emailTest <= 0) {
            $staff = new Admin();
            $staff->name = $data['name'];
            $staff->email = $data['email'];
            $staff->password = Hash::make('123456'); // pass mặc đinh là 123456
            $staff->save();

            return [
                'message' => 'Thêm nhân viên thành công!',
                'type' => 'success'
            ];
        }

        return [
            'message' => 'Thêm mới lỗi, kiểm tra lại email',
            'type' => 'error'
        ];
    }

    public function update($id, $data)
    {
        $emailTest = $this->_model->select('email')->where('email', $data['email'])->first();
        $emailCurrent = $this->_model->select('email')->where('id', $id)->first();

        if ($emailTest) {
            $check = strcasecmp($emailTest->email, $emailCurrent->email);
        }
        if (!$emailTest || $check == 0) {
            $student = $this->_model->find($id);
            $student->name = $data['name'];
            $student->email = $data['email'];
            $student->updated_at = date('Y-m-d H:i:s');
            $student->save();

            return [
                'message' => 'Cập nhật thông tin thành công!',
                'type' => 'success'
            ];
        }

        return [
            'message' => 'Cập nhật không thành công. Kiểm tra lại email',
            'type' => 'error'
        ];
    }

    public function updateProfile($id, $request)
    {
        $emailTest = $this->_model->select('email')->where('email', $request->email)->first();
        $emailCurrent = $this->_model->select('email')->where('id', $id)->first();

        if ($emailTest) {
            $check = strcasecmp($emailTest->email, $emailCurrent->email);
        }

        if (!$emailTest || $check == 0) {
            $imagePath = $this->updateImagePath($request->hasFile('image'), $request->file('image'), $id);
            $admin = $this->_model->findOrFail($id);
            $admin->name = $request->name;
            $admin->email = $request->email;
            if ($imagePath) {
                $admin->image = $imagePath;
            }
            $admin->updated_at = date('Y-m-d H:i:s');
            $admin->save();

            return [
                'message' => 'Cập nhật thành công',
                'type' => 'success',
            ];
        }

        return [
            'message' => 'Email đã tồn tại!',
            'type' => 'error'
        ];
    }
}
