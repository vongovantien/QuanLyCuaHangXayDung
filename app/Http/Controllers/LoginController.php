<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Jobs\SendMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use function now;
use function redirect;
use function view;

class LoginController extends Controller
{
    public function index()
    {
        return view('login', [
            'title' => 'Đăng nhập hệ thống',
        ]);
    }

    public function store(Request $request)
    {


        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'confirmed' => 1
        ], $request->input('remember'))) {
            return redirect('admin/index');
        }

        Session::flash('error', 'Email và mật khẩu không hợp lệ!!');

        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function getEmail()
    {
        return view('email', ['title' => 'Quên mật khẩu']);
    }

    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

//        $user = User::whereEmail($request->email)->first();
//        if (count($user) == 0) {
//            return redirect()->back()->with(['error' => "Email khong ton tai"]);
//        }

        $token = Str::random(64);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('verify', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }


    public function getPassword($token)
    {
        return view('reset', ['token' => $token, 'title' => 'Đăng nhập hệ thống']);
    }

    public function updatePassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $updatePassword = DB::table('password_resets')
            ->where(['email' => $request->email, 'token' => $request->token])
            ->first();

        if (!$updatePassword)
            return back()->withInput()->with('error', 'Invalid token!');

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');
    }

}
