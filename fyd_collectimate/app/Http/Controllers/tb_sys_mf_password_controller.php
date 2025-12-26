<?php

namespace App\Http\Controllers;

use App\Jobs\SendUserPasswordResetMailJob;
use App\Models\tb_sys_mf_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class tb_sys_mf_password_controller extends Controller
{
    public function forgot_password()
    {
        return view('auth.forgot-password');
    }

    public function send(Request $r)
    {
        $validated = $this->validate($r, ['email' => 'required|email']);
        $user = tb_sys_mf_user::where('email', $validated['email'])->first();
        if (!$user) {
            return redirect()->back()->with('alert', 'Invalid Email');
        }
        SendUserPasswordResetMailJob::dispatch($validated['email']);
        return redirect()->route('passwords.forgot-password-sent');
    }

    public function forgot_password_sent(Request $r)
    {
        return view('auth.reset-password-send');
    }

    public function reset_password(Request $r)
    {
        return view('auth.edit_password', [
            'email' => $r->get('email')
        ]);
    }

    public function update(Request $r, $email)
    {
        $validated = $this->validate($r, [
            'password'      => 'required|string|min:8',
            'cf_password'   => 'required|string|min:8|same:password',
        ]);
        $decryptedEmail = Crypt::decrypt($email);
        $datum = tb_sys_mf_user::where('email', $decryptedEmail)->first();
        $validated['password'] = Hash::make($r['password']);
        unset($validated["cf_password"]);
        $datum->fill($validated);
        $datum->update();
        return redirect()->route('passwords.reset-password-success', ['email' => $email]);
    }

    public function reset_password_success(Request $r, $email)
    {
        $decryptedEmail = Crypt::decrypt($email);
        $datum = tb_sys_mf_user::where('email', $decryptedEmail)->first();
        $url = route('login');
        return view('auth.reset-password-success', ['url' => $url]);
    }

    public function test(Request $r,)
    {
        $email = 'rjsuarez@shinra.com.ph';
        return view('auth.edit_password', [
            'email' => $email
        ]);
    }
}
