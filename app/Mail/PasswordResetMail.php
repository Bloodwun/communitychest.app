<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;

    // Pass the token and email to the view
    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function build()
    {
        return $this->subject('Password Reset Request')
                    ->view('auth.passwords.reset_mail')
                    ->with([
                        'url' => url('/password/reset/'.$this->token),
                        'email' => $this->email
                    ]);
    }
}
