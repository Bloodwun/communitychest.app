<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends Controller
{
    // Show the password reset form
    public function showResetForm(Request $request, $token = null, $email = null)
    {
        return view('auth.reset_password_form', ['token' => $token, 'email' => $email]);
    }

    // Handle the password reset
    public function reset(Request $request)
    {
        // Validate the input fields
        $request->validate([
            
            'password' => 'required|confirmed|min:8', // 'confirmed' will check that password and password_confirmation match
        ]);

        // Find the user based on the email
        $user = User::where('remember_token', $request->token)->first();
      
        // Check if the user exists and if the reset token matches
        if ($user && $user->remember_token === $request->token) {
            // Update the password
            $user->update([
                'password' => Hash::make($request->password),
                'remember_token' => null, // Reset the token after password change
            ]);

            return redirect()->route('index')->with('success', 'Your password has been reset!');
        }

        return back()->withErrors(['fail' => 'The provided token is invalid or has expired.']);
    }
}
