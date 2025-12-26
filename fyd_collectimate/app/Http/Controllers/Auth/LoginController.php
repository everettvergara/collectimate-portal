<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'code';
    }

    public function api_login(Request $r)
    {
        $credentials = $r->only('code', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['access_token' => $token, 'token_type' => 'Bearer',], 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    protected function redirectTo()
    {
        $redirect = request()->input('redirectTo', '/');

        // Only allow relative paths, not full URLs
        if (! str_starts_with($redirect, '/')) {
            $redirect = '/';
        }

        return $redirect;
    }

    protected function authenticated(Request $r, $user)
    {
        store_audit($user->id, 'LOGIN');
    }
}
