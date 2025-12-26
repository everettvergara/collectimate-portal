<?php

namespace App\Http\Controllers;

use App\Models\tb_sys_mf_user;
use App\Models\tb_sys_tr_audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tb_sys_tr_audit_controller extends Controller
{
    public function index(Request $r)
    {
        store_audit(Auth::user()->id, 'AUDIT');
        $date_from = $r['date_from'] ?? now()->toDateString();
        $date_to = $r['date_to'] ?? now()->toDateString();
        $user_id = $r['user_id'];
        $dropdowns = $this->get_dropdowns();
        $data = tb_sys_tr_audit::select('tb_sys_tr_audit.*', 'b.name as user')
            ->join('tb_sys_mf_user as b', 'b.id', 'tb_sys_tr_audit.user_id')
            ->when(isset($date_from) && isset($date_to), function ($q) use ($date_from, $date_to) {
                return $q->whereRaw("CAST(tb_sys_tr_audit.timestamp as date) between  '" . $date_from . "' and '" . $date_to . "'");
            })
            ->when(isset($user_id), function ($q) use ($user_id) {
                return $q->where("tb_sys_tr_audit.user_id", $user_id);
            })
            ->sortable()
            ->paginate(config('services.row_manager.row_count'));

        return view('tb_sys_tr_audit.index.view', [
            'date_from' => $date_from,
            'date_to'   => $date_to,
            'user_id'   => $user_id,
            'users'     => $dropdowns['users'],
            'data'      => $data,
        ]);
    }

    private function get_dropdowns()
    {
        return ['users' => tb_sys_mf_user::select('id', 'name')->where('is_active', 1)->get(),];
    }
}
