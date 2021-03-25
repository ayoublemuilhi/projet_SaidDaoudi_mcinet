<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Hash;
use Session;
class UserController extends Controller
{

    public function index()
    {

        $users = User::with(['roles' => function($q){
            $q->where('name','!=', ROLE );
        }])->orderBy('id','ASC')->cursor();




        return view('users.index',compact('users'));
    }

    public function create()
    {
        $roles = Role::select('id','name')->where('name','!=',ROLE)->cursor();

        return view('users.create',compact('roles'));
    }

    public function store(UserRequest $request)
    {
       // return $request;

        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);
        $data['image'] = 'default.png';
        $user = User::create($data);

        $user->assignRole($request->input('roles'));
        return redirect()->route('users.create')->with('success',__('users.utilisateur success in add'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        //
    }
}
