<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    // Show the form to request a password reset link
    public function showLinkRequestForm()
    {
        return view('auth.reset_password');
    }

    // Send the password reset link to the user's email
    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email
        $request->validate([
            'email' => 'required|email|exists:users,email',  // Ensure the email exists in the users table
        ]);

        // Get the user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with that email address.']);
        }

        // Generate a random token (you can also use other token generation methods)
        $token = Str::random(60);

        // Save the token in the remember_token column
        $user->update(['remember_token' => $token]);

        // Send the reset link email with the token (you can customize the email)
        Mail::send('emails.password_reset', ['token' => $token, 'email' => $user->email], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Password Reset Link');
        });

        return redirect()->route('index')->with('success', 'We have sent you a password reset link!');
    }


}
