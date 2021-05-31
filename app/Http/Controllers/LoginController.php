<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class LoginController extends Controller
{
    // View login
    public function getLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        # validate
        $rules = [
            'email' => 'required',
            'password' => 'required|min:6',
        ];
        $messages = [
            'email.required' => 'Email không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $email = $request->get('email');
        $password = $request->get('password');

        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::guard('student')->attempt(['email' => $email, 'password' => $password])) {
            $id = Auth::guard('student')->id();
            $status = Student::select('status')->where('id', $id)->first()->status;
            if ($status == 1) {
                return redirect()->route('home');
            } else {
                Auth::guard('student')->logout();
                return redirect()->back()->with('errors', 'Tài khoản đã bị khóa');
            }
        }
        return back()->with('errors', 'Email hoặc mật khẩu không chính xác')->withInput();
    }

    public function logout(Request $request)
    {

        // (Auth::guard('admin')->check())
        Auth::guard('admin')->logout();
        Auth::guard('student')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('get_login');
    }

    public function adminUpdatePassword(Request $request)
    {
        $id = Auth::guard('admin')->id();
        // validate
        $rules = [
            'new_password' => 'min:6',
            're_password' => 'min:6',
        ];
        $messages = [
            'new_password.min' => 'Mật khẩu mới ít nhất 6 ký tự',
            're_password.min' => 'Nhập lại mật khẩu mới ít nhất 6 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // toast()->autoClose();
            return redirect()->back()->with('toast_error', $validator->messages()->all()[0]);
        }

        $oldPwd = $request->password;
        $newPwd = $request->new_password;
        $rePwd = $request->re_password;
        $currentPwd = Admin::select('password')->where('id', $id)->first()->password;

        if (Hash::check($oldPwd, $currentPwd)) {
            if ($newPwd === $rePwd) {
                $hashPwd = bcrypt($newPwd);
                $student = Admin::find($id);
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

    public function checkLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.home');
        } elseif (Auth::guard('student')->check()) {
            return redirect()->route('home');
        } else {
            return redirect()->route('get_login');
        }
    }
}
