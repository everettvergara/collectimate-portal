<?php

namespace App\Http\Controllers;

use App\Http\Requests\tb_crm_mf_client_request;
use App\Models\tb_crm_mf_client;
use App\Models\tb_crm_mf_client_device;
use App\Models\tb_sys_mf_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tb_crm_mf_client_controller extends Controller
{
    protected $route;
    protected $route_var;
    protected $title;
    protected $view_path;

    public function __construct()
    {
        $this->route = 'clients';
        $this->route_var = 'client';
        $this->title = 'Clients';
        $this->view_path = 'tb_crm_mf_client';
    }

    public function index(Request $r)
    {
        store_audit(Auth::user()->id, $this->title);
        $name = $r['name'];
        $data = tb_crm_mf_client::select('tb_crm_mf_client.*', 'b.name as user')
            ->leftJoin('tb_sys_mf_user as b', 'b.id', 'user_id')
            ->when(isset($name), function ($q) use ($name) {
                return $q->where('tb_crm_mf_client.name', 'like', '%' . $name . '%');
            })
            ->sortable()
            ->paginate(config('services.row_manager.row_count'));
        $filters    = view($this->view_path . '.index.filters', ['name' => $name])->render();
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
            'users' => $dropdowns['users'],
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

    public function store(tb_crm_mf_client_request $r)
    {
        $validatedData = $r->validated();
        $datum = new tb_crm_mf_client();
        $datum->fill($validatedData);
        $datum->save();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function show($id)
    {
        $datum = tb_crm_mf_client::findOrFail($id);
        $dropdowns = $this->get_dropdowns();
        $form_fields = view($this->view_path . '.show.form_fields', [
            'datum'             => $datum,
            'users'             => $dropdowns['users'],
        ])->render();
        $details = $this->get_details($datum->id);
        $form_details = view($this->view_path . '.show.form_details', [
            'route_var'         => $this->route_var,
            'route_val'         => $datum->id,
            'client_devices'    => $details['client_devices'],
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
        $datum = tb_crm_mf_client::findOrFail($id);
        $dropdowns = $this->get_dropdowns();
        $head = view($this->view_path . '.edit.head')->render();
        $form_fields = view($this->view_path . '.edit.form_fields', [
            'datum'             => $datum,
            'users'             => $dropdowns['users'],
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

    public function update(tb_crm_mf_client_request $r, $id)
    {
        $datum = tb_crm_mf_client::findOrFail($id);
        $validatedData = $r->validated();
        $datum->fill($validatedData);
        $datum->update();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function destroy(Request $r, $id)
    {
        $datum = tb_crm_mf_client::findOrFail($id);
        $datum->delete();
        return redirect()->route($this->route . '.index')->with('status', 'Success!');
    }

    public function get_dropdowns()
    {
        return [
            'users' => tb_sys_mf_user::get(),
        ];
    }

    private function get_details($fk)
    {
        return [
            'client_devices' => tb_crm_mf_client_device::select('*',)
                ->where('client_id', $fk)->get(),
        ];
    }
}
