<?php

namespace App\Http\Controllers\Session;

use Sentinel;
use Session;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function login ()
    {
        if ($user = Sentinel::check())
        {
            Session::flash('notice', 'You has login,' . $user->email);
            return redirect('/');
        } else {
            return view('session.login');
        }
    }

    public function login_store (LoginRequest $request)
    {
        if ($user = Sentinel::authenticate($request->all())) {
            Session::flash('notice', 'Welcome ' . $user->email);
            return redirect()->intended('/');
        } else {
            Session::flash('error', 'Login fails');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        Sentinel::logout();
        Session::flash('notice', 'Logout success');
        return redirect('/');
    }

    public function register ()
    {
        return view('session.register');
    }

    public function register_store (RegisterRequest $request)
    {
        // Register and Automatically activate the account
        Sentinel::register($request->all(), true);
        Session::flash('notice', 'Successfully created new user');
        return redirect()->route('home.index');
    }
}
