<?php

namespace App\Repositories\Student;

use App\Models\Book;
use App\Models\BookOutOnLoan;
use App\Models\Student;
use App\Repositories\RepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
// use Intervention\Image\Image;

class StudentRepositoryEloquent extends RepositoryEloquent implements StudentRepositoryInterface
{
    protected $pathAvatar = '/storage/images/avatar/';

    public function getModel()
    {
        return \App\Models\Student::class;
    }



    // STUDENT

    public function getTotalBook($id)
    {
        return BookOutOnLoan::where('student_id', $id)->count();
    }

    public function getPaidBook($id)
    {
        return BookOutOnLoan::where([
            ['student_id', '=', $id],
            ['status', '=', 1],
        ])->count();
    }

    public function getUnpaidBook($id)
    {
        return BookOutOnLoan::where([
            ['student_id', '=', $id],
            ['status', '=', 0],
        ])->count();
    }

    public function getNumberOfPenalties($id)
    {
        return BookOutOnLoan::where([
            ['student_id', '=', $id],
            ['status', '=', 1],
            ['amount_of_fine', '>', 0],
        ])->count();
    }

    public function getAllBook()
    {
        return Book::orderByDesc('id');
    }

    public function home($keyword)
    {
        $query = Book::query();
        if ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        }
        return $query->orderBy('id', 'desc');
    }

    public function profile($id)
    {
        return Student::findOrFail($id);
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
            $student = $this->_model->findOrFail($id);
            $student->name = $request->name;
            $student->email = $request->email;
            if ($imagePath) {
                $student->image = $imagePath;
            }
            $student->updated_at = date('Y-m-d H:i:s');
            $student->save();

            return [
                'message' => 'Cập nhật thông tin thành công',
                'type' => 'success',
            ];
        }

        return [
            'message' => 'Email đã tồn tại!',
            'type' => 'error'
        ];
    }

    public function updatePassword($id, $data)
    {
        // validate
        $rules = [
            'new_password' => 'min:6',
            're_password' => 'min:6',
        ];
        $messages = [
            'new_password.min' => 'Mật khẩu mới ít nhất 6 ký tự',
            're_password.min' => 'Nhập lại mật khẩu mới ít nhất 6 ký tự',
        ];
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0]);
        }

        $oldPwd = $data['password'];
        $newPwd = $data['new_password'];
        $rePwd = $data['re_password'];
        $currentPwd = $this->_model->select('password')->where('id', $id)->first()->password;

        if (Hash::check($oldPwd, $currentPwd)) {
            if ($newPwd === $rePwd) {
                $hashPwd = bcrypt($newPwd);
                $student = $this->_model->find($id);
                $student->password = $hashPwd;
                $student->save();
                return redirect()->back()->with('success', 'Đổi mật khẩu thành công!');
            } else {
                return redirect()->back()->with('errors', 'Nhập lại mật khẩu mới chưa chính xác');
            }
        } else {
            return redirect()->back()->with('errors', 'Mật khẩu không chính xác');
        }
    }



    // ADMIN

    public function create(array $data)
    {
        $emailTest = $this->_model->where('email', $data['email'])->count();
        if ($emailTest <= 0) {
            $student = new Student();
            $student->name = $data['name'];
            $student->email = $data['email'];
            $student->password = Hash::make('123456'); // pass mặc đinh là 123456
            $student->save();

            return [
                'message' => 'Thêm mới sinh viên thành công!',
                'type' => 'success'
            ];
        }

        return [
            'message' => 'Thêm mới lỗi, kiểm tra lại email',
            'type' => 'error'
        ];
    }

    public function updateStudent($id, array $data)
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
                'message' => 'Cập nhật thông tin sinh viên thành công!',
                'type' => 'success'
            ];
        }

        return [
            'message' => 'Cập nhật không thành công. Kiểm tra lại email',
            'type' => 'error'
        ];
    }

    public function block($id)
    {
        $this->_model->where('id', $id)->update(['status' => 0]);
        return [
            'message' => 'Khóa tài khoản thành công!',
            'type' => 'success'
        ];
    }

    public function unblock($id)
    {
        $this->_model->where('id', $id)->update(['status' => 1]);
        return [
            'message' => 'Mở khóa tài khoản thành công!',
            'type' => 'success'
        ];
    }
}
