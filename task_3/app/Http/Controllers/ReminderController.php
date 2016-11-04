<?php

namespace App\Http\Controllers;

use Session;
use Event;
use Sentinel;
use Reminder;
use App\User;
use App\Http\Requests\ReminderRequest;
use App\Events\ReminderEvent;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function create() 
    {
        return view('reminders.create');
    }

    public function store(Request $request)
    {
        $getuser = User::where('email', $request->email)->first();
        if ($getuser) {
            $user = Sentinel::findById($getuser->id);
            ($reminder = Reminder::exists($user)) || ($reminder = Reminder::create($user));
            Event::fire(new ReminderEvent($user, $reminder));
            Session::flash('notice', 'Check your email for instruction');
        } else {
            Session::flash('error', 'Email not valid');
        }

        return view('reminders.create');
    }

    public function edit($id, $code)
    {
        $user = Sentinel::findById($id);
        if (Reminder::exists($user, $code)) {
            return view('reminders.store', ['id' => $id, 'code' => $code]);
        } else {
            return redirect('/');
        }
    }

    public function update(ReminderRequest $request, $id, $code)
    {
        $user = Sentinel::findById($id);
        $reminder = Reminder::exists($user, $code);
        if ($reminder)
        {
            Session::flash('notice', 'Your password success modified');
            Reminder::complete($user, $code, $request->password);
            return redirect('login');
        } else {
            Session::flash('error', 'Passwords must match.');
        }
    }
}
