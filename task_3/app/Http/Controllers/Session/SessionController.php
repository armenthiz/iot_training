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
    /**
     * controller that used to view the login form, and check if user is
     * already logged in or not.
     */
    public function login()
    {
        // check if user is logged in
        if ($user = Sentinel::check())
        {
            // return flash message with redirect response
            Session::flash('notice', 'You has login,' . $user->email);
            return redirect('/');
        } else {
            return view('session.login');
        }
    }

    /**
     * controller to setup the login
     */
    public function login_store(LoginRequest $request)
    {
        // check if input is remember checkbox is checked
        if ($request->input('remember') != null)
        {
            // if checked then check if credentials is matched
            if ($user = Sentinel::authenticateAndRemember($request->all()))
            {
                Session::flash('notice', 'Welcome ' . $user->email);
                return redirect()->intended('/');
            } else {
                Session::flash('error', 'Login fails');
                return redirect()->back()->withInput();
            }
        } else {
            // if remember checkbox is not checked, then check if credentials
            // is matched
            if ($user = Sentinel::authenticate($request->all()))
            {
                Session::flash('notice', 'Welcome ' . $user->email);
                return redirect()->intended('/');
            } else {
                Session::flash('error', 'Login fails');
                return redirect()->back()->withInput();
            }
        }
    }

    /**
     * controller to action logout
     */
    public function logout()
    {
        Sentinel::logout();
        Session::flash('notice', 'Logout success');
        return redirect('/');
    }
}
