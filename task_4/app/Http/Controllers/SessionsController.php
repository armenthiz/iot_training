<?php

namespace App\Http\Controllers;

use Sentinel;
use Session;
use App\Http\Requests\SessionRequest;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    /**
     * controller to display the login form, and check if user is already
     * logged in or not.
     */
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

    /**
     * controller to setup the login
     */
    public function login_store(SessionRequest $request)
    {
        // Determine if the `remember` checkbox is checked
        if ($request->input('remember') != null) {

            // then check if credentials are match
            if ($user = Sentinel::authenticateAndRemember(array(
                    'email' => $request->input('email'),
                    'password' => $request->input('password')
                ))) {
                // if match, return flash message and redirect to root
                Session::flash('notice', 'Welcome ' . $user->email);
                return redirect()->intended('/');
            } else {
                // if not match return flash message and redirect back to login
                Session::flash('error', 'Login Fails');
                return redirect()->route('login')->withInput();
            }
        } else {
            // if `remember` checkbox is not checked then check if credentials
            // are matched.
            if ($user = Sentinel::authenticate(array(
                    'email' => $request->input('email'),
                    'password' => $request->input('password')
                ))) {
                // If match, return flash message and redirect to root
                Session::flash('notice', 'Welcome ' . $user->email);
                return redirect()->intended('/');
            } else {
                // if not match return flash message and redirect back to login
                Session::flash('error', 'Login Fails');
                return redirect()->route('login')->withInput();
            }
        }
    }

    public function logout()
    {
        Sentinel::logout();
        Session::flash('notice', 'Logout success');
        return redirect('/');
    }
}
