<?php

namespace App\Http\Controllers;


use function view;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.main', [
            'title' => 'Trang chủ',
        ]);
    }
}
