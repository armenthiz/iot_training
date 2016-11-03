<?php

namespace App\Http\Controllers;

use Sentinel;
use Session;
use App\Http\Requests\SessionRequest;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function login()
    {
        if ($user = Sentinel::check())
        {
            Session::flash('notice', 'You has login' . $user->email);
            return redirect('/');
        } else {
            return view('sessions.login');
        }
    }

    public function login_store(SessionRequest $request)
    {
        if ($user = Sentinel::authenticate(array(
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ))) {
            Session::flash('notice', 'Welcome ' . $user->email);
            return redirect()->intended('/');
        } else {
            Session::flash('error', 'Login Fails');
            return view('sessions.login');
        }
    }

    public function logout()
    {
        Sentinel::logout();
        Session::flash('notice', 'Logout success');
        return redirect('/');
    }
}
