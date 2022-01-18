<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Http\Controllers\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'password' => $request->input('password')
        ], $request->input('remember'))) {
//            #Queue
//            SendMail::dispatch($request -> input('email'))->delay(now()->addSecond(5));

            return redirect('admin/index');
        }

        Session::flash('error', 'Email hoac mat khau khong hop le!!');

        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

}
