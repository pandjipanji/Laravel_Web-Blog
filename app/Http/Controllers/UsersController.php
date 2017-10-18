<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Session;
use App\Http\Requests\UserRequest;
class UsersController extends Controller
{
    public function signup()
    {
        return view('users.signup');
    }

    public function signup_store(UserRequest $request)
    {
    //// below code will register and automatic activate account user
    //Sentinel::register($request, true);
    //// or
    $fill = [
        'email' => $request->email,
        'password' => $request->password,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name
    ];
    Sentinel::registerAndActivate($fill);
    Session::flash('notice_register', '');
    return redirect()->back();
    }
}
