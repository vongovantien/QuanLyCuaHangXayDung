<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use function view;

class UserController extends Controller
{
    public function getRole()
    {
        return Role::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        (string)$kw = $request->query('kw');
        (int)$quantity = $request->query('quantity');
        (string)$filter = $request->query('filter');
        $user = User::with('role')->orderByDesc('id');

        if ($kw !== null) {
            $user = $user->where('name', 'like', "%$kw%");
        }
        if ($filter !== null) {
            switch ($filter) {
                case "date" :
                    $user = $user->orderBy('id');
                    break;
                case "date_desc":
                    $user = $user->orderByDesc('id');
                    break;
                case "name_desc":
                    $user = $user->orderByDesc('name');
                    break;
                default:
                    $user = $user->orderBy('name');
            }
        }
        if ($quantity !== null) {
            $user = $user->paginate($quantity);
        } else {
            $user = $user->paginate(15);
        }
        return view('admin.user.list', [
            'users' => $user,
            'title' => 'Danh sách người dùng'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $role = $this->getRole();
        return view('admin.user.edit', [
            'user' => $user,
            'roles' => $role,
            'title' => 'Cập nhật nhân viên'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ])->validate();

        $user = User::find($id);

        try {
            if ($request->has('confirmed')) {
                if($request->confirmed == 'on')
                {
                    $user->confirmed = 1;
                }
            } else {
                $user->confirmed = 0;
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->email = $request->email;
            $user->role_id = $request->role;
            $user->save();
            Session::flash('success', 'Cập nhật nhân viên thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật nhân viên thất bại' . ' ' . $err->getMessage());
            redirect()->back();
        }
        return redirect('/admin/users/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
