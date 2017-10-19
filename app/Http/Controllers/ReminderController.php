<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\ReminderRequest;
use Session, Event;
use Sentinel, Reminder;
use App\Events\ReminderEvent;

class ReminderController extends Controller
{
    public function create(){
        return view('reminders.create');
    }

    public function store(Request $request) {
        $getuser = User::where('email', $request->email)->first();

        if($getuser) {
            $user = Sentinel::findById($getuser->id);
            ($reminder = Reminder::exists($user)) ||($reminder = Reminder::create($user));
            Event::fire(new ReminderEvent($user, $reminder));
            Session::flash('notice', 'Check your email for instruction');
        } else {
            Session::flash('error', 'Email not valid');
        }
        return view('reminders.create');
    }

    public function edit($id, $code){
        $user = Sentinel::findById($id);
        if (Reminder::exists($user, $code)) {
            return view('reminders.edit', ['id' => $id, 'code' => $code]);
        } else {
            return redirect('/');
        }
    }

    public function update(ReminderRequest $request, $id, $code){
        $user = Sentinel::findById($id);
        $reminder = Reminder::exists($user, $code);

        if ($reminder) {
            Session::flash('notice', 'Your password modified successfuly');
            Reminder::complete($user, $code, $request->password);
            return redirect('login');
        } else {
            Session::flash('eror', 'Passwords must match.');
        }
        
    }
}
