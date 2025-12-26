<?php

namespace App\Http\Controllers;

use App\Models\tb_crm_mf_client;
use App\Models\tb_crm_mf_license;
use App\Models\tb_crm_tr_script;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class collectimate_controller extends Controller
{
    public function get_license()
    {
        $user = Auth::user();

        $client = tb_crm_mf_client::where('user_id', $user->id)->first();

        $token = $user->currentAccessToken();
        $abilities = $token ? $token->abilities : [];

        $licenses = tb_crm_mf_license::select('b.name as license_type', 'a.cache_expiration_date', 'a.cache_no_of_license')
            ->from('tb_crm_mf_license as a')
            ->join('tb_crm_mf_license_type as b', 'b.id', 'a.cache_license_type_id')
            ->where('client_id', $client->id)
            ->where('device_id', $abilities['device_id'] ?? 0)
            ->get();

        $data = [];

        try {
            foreach ($licenses as $i => $license) {
                $data[$i] = [
                    "license_type" => $license->license_type,
                    "expiration" => Carbon::parse($license->cache_expiration_date)->timestamp,
                    "max_license" => $license->cache_no_of_license,
                ];
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'ERROR',
                    'message' => $th->getMessage(),
                ]
            ], 401);
        }

        return response()->json([
            'success' => true,
            'data'    => $data,
            'licenses'  => $licenses,
            'abilities' => $abilities,
        ], 200);
    }

    public function get_script(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'timestamp'  => 'required|numeric',
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

        $timestamp = $r->timestamp;
        $user = Auth::user();

        $client = tb_crm_mf_client::where('user_id', $user->id)->first();

        $scripts = tb_crm_tr_script::select('a.*', 'b.name as license_type')
            ->from('tb_crm_tr_script as a')
            ->join('tb_crm_mf_license_type as b', 'b.id', 'a.license_type_id')
            ->where('client_id', $client->id)
            ->where('a.updated_at', '>=', Carbon::createFromTimestamp($timestamp)->toDateTimeString())
            ->get();

        $data = [];
        try {
            foreach ($scripts as $i => $script) {
                $data[$i] = [
                    "id" => $script->id,
                    "name" => $script->name,
                    "license_type" => $script->license_type,
                    "script" => $script->json_file_path,
                    "b64" => null,
                ];
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'ERROR',
                    'message' => $th->getMessage(),
                ]
            ], 401);
        }

        return response()->json([
            'success' => true,
            'data'    => $data,
        ], 200);
    }
}
