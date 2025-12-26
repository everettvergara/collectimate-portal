<?php

namespace App\Http\Controllers;

use App\Models\tb_crm_mf_client_device;
use App\Models\tb_re_mf_brg;
use App\Models\tb_re_mf_city;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class select2_controller extends Controller
{
    public function index(Request $request)
    {
        // Log::debug($request);
        // die();
        $model = new ($request->model_path);
        $search = $request->search;
        if ($search == '') {
            $results = $model::select('id', 'name')
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $results = $model::select('id', 'name')
                ->where('name', 'like', '%' . $search . '%')
                ->where('is_active', 1)
                ->orderBy('name', 'asc')
                ->get();
        }

        $response = array();

        foreach ($results as $result) {
            $response[] = array(
                "id" => $result->id,
                "text" => $result->name,
            );
        }
        echo json_encode($response);
    }

    public function city(Request $r)
    {
        $search = $r->search;
        $province_id = $r->province_id;
        $results = tb_re_mf_city::select('a.id', 'a.name')
            ->from('tb_re_mf_city as a')
            ->join('tb_re_mf_province as b', 'b.id', 'a.province_id')
            ->when((!$search == ''), function ($q) use ($search) {
                return $q->where('a.name', 'like', '%' . $search . '%');
            })->orderBy('a.name', 'asc')
            ->when(isset($province_id), function ($q) use ($province_id) {
                return $q->where('b.id', $province_id);
            })
            ->where('a.is_active', 1)
            ->get();
        $response = array();
        foreach ($results as $result) {
            $response[] = array(
                "id" => $result->id,
                "text" => $result->name,
            );
        }
        echo json_encode($response);
    }

    public function brg(Request $r)
    {
        $search = $r->search;
        $city_id = $r->city_id;
        $province_id = $r->province_id;
        $results = tb_re_mf_brg::select('a.id', 'a.name')
            ->from('tb_re_mf_brg as a')
            ->join('tb_re_mf_city as b', 'b.id', 'a.city_id')
            ->join('tb_re_mf_province as c', 'c.id', 'b.province_id')
            ->when((!$search == ''), function ($q) use ($search) {
                return $q->where('a.name', 'like', '%' . $search . '%');
            })->orderBy('a.name', 'asc')
            ->when(isset($city_id), function ($q) use ($city_id) {
                return $q->where('b.id', $city_id);
            })->when(isset($province_id), function ($q) use ($province_id) {
                return $q->where('c.id', $province_id);
            })
            ->where('a.is_active', 1)
            ->get();
        $response = array();
        foreach ($results as $result) {
            $response[] = array(
                "id" => $result->id,
                "text" => $result->name,
            );
        }
        echo json_encode($response);
    }

    public function devices(Request $r)
    {
        $search = $r->search;
        $client_id = $r->client_id;
        $results = tb_crm_mf_client_device::select('a.id', 'a.name')
            ->from('tb_crm_mf_client_device as a')
            ->when((!$search == ''), function ($q) use ($search) {
                return $q->where('a.name', 'like', '%' . $search . '%');
            })->orderBy('a.name', 'asc')
            ->when(isset($client_id), function ($q) use ($client_id) {
                return $q->where('a.client_id', $client_id);
            })
            ->get();
        $response = array();
        foreach ($results as $result) {
            $response[] = array(
                "id" => $result->id,
                "text" => $result->name,
            );
        }
        echo json_encode($response);
    }
}
