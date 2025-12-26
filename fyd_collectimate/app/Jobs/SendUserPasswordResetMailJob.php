<?php

namespace App\Jobs;

use App\Mail\UserPasswordResetMail;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;

class SendUserPasswordResetMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $encryptedEmail = Crypt::encrypt($this->email);
        $expiresAt = now()->addDays(7); // URL will expire in 7 Days
        $expiringUrl = URL::temporarySignedRoute('passwords.reset-password', $expiresAt, ['email' => $encryptedEmail]);
        Mail::to($this->email)->send(new UserPasswordResetMail($expiringUrl));
    }
}
