<?php

namespace App\Http\Controllers\User;

use Sentinel;
use Session;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * controller to view register form
     */
    public function register()
    {
        return view('user.register');
    }

    /**
     * controller to perform registering
     */
    public function register_store (RegisterRequest $request)
    {
        // Register and Automatically activate the account
        Sentinel::register($request->all(), true);
        Session::flash('notice', 'Successfully created new user');
        return redirect()->route('home.index');
    }
}
