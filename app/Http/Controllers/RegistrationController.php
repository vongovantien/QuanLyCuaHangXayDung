<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use function auth;
use function redirect;
use function request;
use function view;

class RegistrationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('register', ['title' => 'Đăng ký người dùng']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'

        ]);


        try {
            $token = Str::random(64);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'confirmation_code' => $token,
                'confirmed' => 0,
                'role_id' => 1
            ]);

            Mail::send('verifyregister', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email, $request->name)->subject('Verify your email address');
            });
            return redirect(route('login'))->with('status', 'Vui lòng xác nhận tài khoản email');
        } catch (Exception $err) {
            return response()->json(['error' => "Đăng ký không thành công !! Có lỗi xảy ra"]);
        }
        return redirect()->to('/login');
    }

    public function verify($code)
    {
        $user = User::where('confirmation_code', $code);

        if ($user->count() > 0) {
            $user->update([
                'confirmed' => 1,
                'confirmation_code' => null
            ]);
            $notification_status = 'Bạn đã xác nhận thành công';
        } else {
            $notification_status = 'Mã xác nhận không chính xác';
        }

        return redirect(route('login'))->with('status', $notification_status);
    }
}
