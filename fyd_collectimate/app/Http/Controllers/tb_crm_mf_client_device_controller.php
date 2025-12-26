<?php

namespace App\Http\Controllers;

use App\Http\Requests\tb_crm_mf_client_device_request;
use App\Models\tb_crm_mf_client;
use App\Models\tb_crm_mf_client_device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tb_crm_mf_client_device_controller extends Controller
{
    protected $route;
    protected $route_var;
    protected $header_route;
    protected $header_route_var;
    protected $title;
    protected $view_path;
    protected $pk_var;
    protected $pk_val;

    public function __construct()
    {
        $this->route = 'client-devices';
        $this->route_var = 'client_device';
        $this->header_route = 'clients';
        $this->header_route_var = 'client';
        $this->title = 'Client Devices';
        $this->view_path = 'tb_crm_mf_client_device';
        $this->pk_var = 'client_id';
        $this->pk_val = 'client';
    }

    public function create(Request $r)
    {
        $head = view($this->view_path . '.create.head')->render();
        $form_fields = view($this->view_path . '.create.form_fields', [
            $this->pk_var       => $r->{$this->pk_val},
        ])->render();
        $scripts = view($this->view_path . '.create.scripts')->render();
        return view('base.detail.create', [
            'route'             => $this->route,
            'header_route'      => $this->header_route,
            'header_route_var'  => $this->header_route_var,
            'header_route_val'  => $r->{$this->pk_val},
            'title'             => $this->title,
            'head'              => $head,
            'form_fields'       => $form_fields,
            'scripts'           => $scripts,
        ]);
    }

    public function store(tb_crm_mf_client_device_request $r)
    {
        $validatedData = $r->validated();
        $datum = new tb_crm_mf_client_device();
        $datum->fill($validatedData);
        $datum->save();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function show($id)
    {
        $datum = tb_crm_mf_client_device::findOrFail($id);
        $form_fields = view($this->view_path . '.show.form_fields', [
            'datum'             => $datum,
        ])->render();
        return view('base.detail.show', [
            'route'             => $this->route,
            'route_var'         => $this->route_var,
            'route_val'         => $datum->id,
            'header_route'      => $this->header_route,
            'header_route_var'  => $this->header_route_var,
            'header_route_val'  => $datum->{$this->pk_var},
            'title'             => $this->title,
            'form_fields'       => $form_fields,
        ]);
    }

    public function edit($id)
    {
        $datum = tb_crm_mf_client_device::findOrFail($id);
        $head = view($this->view_path . '.edit.head')->render();
        $form_fields = view($this->view_path . '.edit.form_fields', [
            'datum'             => $datum,
        ])->render();
        $scripts = view($this->view_path . '.edit.scripts')->render();
        return view('base.detail.edit', [
            'route'             => $this->route,
            'route_var'         => $this->route_var,
            'route_val'         => $datum->id,
            'header_route'      => $this->header_route,
            'header_route_var'  => $this->header_route_var,
            'header_route_val'  => $datum->{$this->pk_var},
            'title'             => $this->title,
            'head'              => $head,
            'form_fields'       => $form_fields,
            'scripts'           => $scripts,
        ]);
    }

    public function update(tb_crm_mf_client_device_request $r, $id)
    {
        $datum = tb_crm_mf_client_device::findOrFail($id);
        $validatedData = $r->validated();
        $datum->fill($validatedData);
        $datum->update();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function destroy(Request $r, $id)
    {
        $datum = tb_crm_mf_client_device::findOrFail($id);
        $pk = $datum->client_id;
        $datum->delete();
        return redirect()->route($this->header_route . '.show', [$this->header_route_var => $pk])->with('status', 'Success!');
    }

    private function get_dropdowns($fk = null)
    {
        return [
            'clients'   => tb_crm_mf_client::when(isset($fk), function ($q) use ($fk) {
                return $q->where('id', $fk);
            })->get(),
        ];
    }
}
