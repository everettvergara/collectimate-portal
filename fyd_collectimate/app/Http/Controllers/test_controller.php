<?php

namespace App\Http\Controllers;

use App\Mail\RaffleEntryNoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendRaffleEntryNoMailJob;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class test_controller extends Controller
{
    public function index()
    {
        $receipt_id = 1;
        return new RaffleEntryNoMail($receipt_id);
    }

    public function mail()
    {
        $receipt_id = 1;
        Mail::to('rjsuarez@shinra.com.ph')->send(new RaffleEntryNoMail($receipt_id));
        // SendRaffleEntryNoMailJob::dispatch($receipt_id, 'rjsuarez@shinra.com.ph');
        return response()->json(['status' => 'Success.'], 200);
    }

    public function captcha()
    {
        return view('test.captcha.view');
    }

    public function captcha_submit(Request $r)
    {
        $r->validate([
            'g-recaptcha-response' => 'required',
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('GOOGLE_CAPTCHA_SECRET_KEY'),
            'response' => $r->input('g-recaptcha-response'),
            'remoteip' => $r->ip(),
        ]);

        if (!$response->json()['success']) {
            return back()->withErrors(['captcha' => 'reCAPTCHA verification failed.']);
        }
        return response()->json(['status' => 'Success.'], 200);
    }
}
