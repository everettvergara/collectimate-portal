<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        // Manual validation for API
        $validator = Validator::make($r->all(), [
            'user_code'  => 'required|string',
            'device'     => 'required|string',
            'password'   => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'VALIDATION_ERROR',
                    'message' => $validator->errors()->first(), // return first error message
                ]
            ], 422);
        }

        // Attempt authentication
        $credentials = [
            'code'     => $r->user_code, // adjust if you use email/username
            'password' => $r->password,
        ];

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'INVALID_CREDENTIALS',
                    'message' => 'Invalid login credentials.',
                ]
            ], 401);
        }

        $user = Auth::user();

        // Find client by code
        $client = \DB::table('tb_crm_mf_client')
            ->where('user_id', $user->id)
            ->first();

        if (!$client) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'CLIENT_NOT_FOUND',
                    'message' => 'Invalid client code.',
                ]
            ], 401);
        }

        // Get latest device record
        $device = \DB::table('tb_crm_mf_client_device')
            ->where('client_id', $client->id)
            ->where('name', $r->device)
            ->orderBy('id', 'desc')
            ->first();

        if (!$device) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'DEVICE_NOT_FOUND',
                    'message' => 'Device not registered for this client.',
                ]
            ], 401);
        }

        // Generate token
        $newToken = $user->createToken('authToken', ['device_id' => $device->id]);
        $newToken->accessToken->expires_at = Carbon::now()->endOfDay();
        $newToken->accessToken->save();

        $token = preg_replace('/^\d+\|/', '', $newToken->plainTextToken);

        return response()->json([
            'success' => true,
            'data' => [
                'access_token' => $token,
                'client_code'  => $client->code,
                'client_key'   => $device->client_key,
            ]
        ], 200);
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
