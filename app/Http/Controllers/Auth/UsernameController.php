<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class UsernameController extends Controller
{
    public function showUsernameRequestForm()
    {
        return view('auth.email');
    }

    public function sendUsernameEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
      
        if ($user) {
            // Send an email with the username
            Mail::raw("Your username is: {$user->user_name}", function ($message) use ($user) {
                $message->to($user->email)->subject('Username Verify');
            });

            return redirect()->route('index')->with('success', 'We have emailed your username!');
        }

        return back()->withErrors(['fail' => 'No account found with that email.']);
    }
}
