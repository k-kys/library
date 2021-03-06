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
                'message' => 'C???p nh???t th??ng tin th??nh c??ng',
                'type' => 'success',
            ];
        }

        return [
            'message' => 'Email ???? t???n t???i!',
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
            'new_password.min' => 'M???t kh???u m???i ??t nh???t 6 k?? t???',
            're_password.min' => 'Nh???p l???i m???t kh???u m???i ??t nh???t 6 k?? t???',
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
                return redirect()->back()->with('success', '?????i m???t kh???u th??nh c??ng!');
            } else {
                return redirect()->back()->with('errors', 'Nh???p l???i m???t kh???u m???i ch??a ch??nh x??c');
            }
        } else {
            return redirect()->back()->with('errors', 'M???t kh???u kh??ng ch??nh x??c');
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
            $student->password = Hash::make('123456'); // pass m???c ??inh l?? 123456
            $student->save();

            return [
                'message' => 'Th??m m???i sinh vi??n th??nh c??ng!',
                'type' => 'success'
            ];
        }

        return [
            'message' => 'Th??m m???i l???i, ki???m tra l???i email',
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
                'message' => 'C???p nh???t th??ng tin sinh vi??n th??nh c??ng!',
                'type' => 'success'
            ];
        }

        return [
            'message' => 'C???p nh???t kh??ng th??nh c??ng. Ki???m tra l???i email',
            'type' => 'error'
        ];
    }

    public function block($id)
    {
        $this->_model->where('id', $id)->update(['status' => 0]);
        return [
            'message' => 'Kh??a t??i kho???n th??nh c??ng!',
            'type' => 'success'
        ];
    }

    public function unblock($id)
    {
        $this->_model->where('id', $id)->update(['status' => 1]);
        return [
            'message' => 'M??? kh??a t??i kho???n th??nh c??ng!',
            'type' => 'success'
        ];
    }
}
