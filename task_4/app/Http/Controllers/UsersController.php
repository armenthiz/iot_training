<?php

namespace App\Http\Controllers;

use Sentinel;
use Session;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * controller to display the register form
     */
    public function signup()
    {
        return view('users.signup');
    }

    /**
     * controller to registering new user, and auto activating
     */
    public function signup_store(UserRequest $request)
    {
        // Below code will register and automatic activate account user
        $user = Sentinel::registerAndActivate($request->all());

        // Automatically add permissions into registered users
        $user->permissions = [
            'articles.index' => true,
            'articles.store' => true,
            'articles.create' => true,
            'articles.destroy' => true,
            'articles.show' => true,
            'articles.update' => true,
            'articles.edit' => true,
            'comments.index' => true,
            'comments.store' => true,
            'comments.create' => true,
            'comments.destroy' => true,
            'comments.show' => true,
            'comments.update' => true,
            'comments.edit' => true,
            'articles.storeExcel' => true,
            'articles.showExportPdf' => true,
            'articles.showExportExcel' => true,
        ];
        $user->save();

        // Then return flash message and redirect back
        Session::flash('notice', 'Success create new user');
        return redirect()->route('root');
    }
}
