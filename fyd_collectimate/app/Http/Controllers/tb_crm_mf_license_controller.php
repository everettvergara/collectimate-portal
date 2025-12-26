<?php

namespace App\Http\Controllers;

use App\Http\Requests\tb_crm_mf_license_request;
use App\Models\tb_crm_mf_client;
use App\Models\tb_crm_mf_client_device;
use App\Models\tb_crm_mf_license;
use App\Models\tb_crm_mf_license_history;
use App\Models\tb_crm_mf_license_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tb_crm_mf_license_controller extends Controller
{
    protected $route;
    protected $route_var;
    protected $title;
    protected $view_path;

    public function __construct()
    {
        $this->route = 'licenses';
        $this->route_var = 'license';
        $this->title = 'License';
        $this->view_path = 'tb_crm_mf_license';
    }

    public function index(Request $r)
    {
        store_audit(Auth::user()->id, $this->title);
        $code = $r['code'];
        $data = tb_crm_mf_license::select('tb_crm_mf_license.*', 'b.name as client', 'c.name as cache_license_type', 'd.name as device')
            ->leftJoin('tb_crm_mf_client as b', 'b.id', 'tb_crm_mf_license.client_id')
            ->leftJoin('tb_crm_mf_license_type as c', 'c.id', 'tb_crm_mf_license.cache_license_type_id')
            ->leftJoin('tb_crm_mf_client_device as d', 'd.id', 'tb_crm_mf_license.device_id')
            ->when(isset($code), function ($q) use ($code) {
                return $q->where('tb_crm_mf_license.code', 'like', '%' . $code . '%');
            })
            ->sortable()
            ->paginate(config('services.row_manager.row_count'));
        $filters    = view($this->view_path . '.index.filters', [
            'code' => $code
        ])->render();
        $tr_header  = view($this->view_path . '.index.tr_header')->render();
        $tr_body    = view($this->view_path . '.index.tr_body', [
            'data'      => $data,
            'route'     => $this->route,
            'route_var' => $this->route_var,
        ]);
        return view('base.header.index', [
            'route'         => $this->route,
            'filters'       => $filters,
            'title'         => $this->title,
            'tr_header'     => $tr_header,
            'tr_body'       => $tr_body,
            'data'          => $data,
        ]);
    }

    public function create()
    {
        $dropdowns = $this->get_dropdowns();
        $head = view($this->view_path . '.create.head')->render();
        $form_fields = view($this->view_path . '.create.form_fields', [
            'clients'           => $dropdowns['clients'],
            'client_devices'    => $dropdowns['client_devices'],
            'license_types'     => $dropdowns['license_types'],
        ])->render();
        $scripts = view($this->view_path . '.create.scripts')->render();
        return view('base.header.create', [
            'route'         => $this->route,
            'title'         => $this->title,
            'head'          => $head,
            'form_fields'   => $form_fields,
            'scripts'       => $scripts,
        ]);
    }

    public function store(tb_crm_mf_license_request $r)
    {
        $validatedData = $r->validated();
        $datum = new tb_crm_mf_license();
        $datum->fill($validatedData);
        $datum->save();
        store_license_history($datum);
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function show($id)
    {
        $datum = tb_crm_mf_license::findOrFail($id);
        $details = $this->get_details($datum->id);
        $dropdowns = $this->get_dropdowns();
        $form_fields = view($this->view_path . '.show.form_fields', [
            'datum'             => $datum,
            'clients'           => $dropdowns['clients'],
            'client_devices'    => $dropdowns['client_devices'],
            'license_types'     => $dropdowns['license_types'],
        ])->render();
        $form_details = view($this->view_path . '.show.form_details', [
            'route_var'         => $this->route_var,
            'route_val'         => $datum->id,
            'license_histories'  => $details['license_histories'],
        ])->render();
        return view('base.header.show', [
            'route'         => $this->route,
            'route_var'     => $this->route_var,
            'route_val'     => $datum->id,
            'title'         => $this->title,
            'form_fields'   => $form_fields,
            'form_details'  => $form_details,
        ]);
    }

    public function edit($id)
    {
        $datum = tb_crm_mf_license::findOrFail($id);
        $dropdowns = $this->get_dropdowns();
        $head = view($this->view_path . '.edit.head')->render();
        $form_fields = view($this->view_path . '.edit.form_fields', [
            'datum'             => $datum,
            'clients'           => $dropdowns['clients'],
            'client_devices'    => $dropdowns['client_devices'],
            'license_types'     => $dropdowns['license_types'],
        ])->render();
        $scripts = view($this->view_path . '.edit.scripts')->render();
        return view('base.header.edit', [
            'route'         => $this->route,
            'route_var'     => $this->route_var,
            'route_val'     => $datum->id,
            'title'         => $this->title,
            'head'          => $head,
            'form_fields'   => $form_fields,
            'scripts'       => $scripts,
        ]);
    }

    public function update(tb_crm_mf_license_request $r, $id)
    {
        $datum = tb_crm_mf_license::findOrFail($id);
        $validatedData = $r->validated();
        $datum->fill($validatedData);
        $datum->update();
        store_license_history($datum);
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function destroy(Request $r, $id)
    {
        $datum = tb_crm_mf_license::findOrFail($id);
        $datum->delete();
        return redirect()->route($this->route . '.index')->with('status', 'Success!');
    }

    private function get_dropdowns()
    {
        return [
            'clients'           => tb_crm_mf_client::get(),
            'client_devices'    => tb_crm_mf_client_device::get(),
            'license_types'     => tb_crm_mf_license_type::get(),
        ];
    }

    private function get_details($fk)
    {
        return [
            'license_histories' => tb_crm_mf_license_history::select('a.*', 'b.name as license_type', 'c.name as device')
                ->from('tb_crm_mf_license_history as a')
                ->leftJoin('tb_crm_mf_license_type as b', 'b.id', 'a.license_type_id')
                ->leftJoin('tb_crm_mf_client_device as c', 'c.id', 'a.device_id')
                ->where('a.license_id', $fk)->get(),
        ];
    }
}
