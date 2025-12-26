<?php

namespace App\Http\Controllers;

use App\Http\Requests\tb_crm_mf_license_history_request;
use App\Models\tb_crm_mf_license_history;
use App\Models\tb_crm_mf_license_type;
use Illuminate\Http\Request;

class tb_crm_mf_license_history_controller extends Controller
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
        $this->route = 'license-histories';
        $this->route_var = 'license_history';
        $this->header_route = 'licenses';
        $this->header_route_var = 'license';
        $this->title = 'License History';
        $this->view_path = 'tb_crm_mf_license_history';
        $this->pk_var = 'license_id';
        $this->pk_val = 'license';
    }

    public function create(Request $r)
    {
        $head = view($this->view_path . '.create.head')->render();
        $dropdowns = $this->get_dropdowns();
        $form_fields = view($this->view_path . '.create.form_fields', [
            $this->pk_var       => $r->{$this->pk_val},
            'license_types'     => $dropdowns['license_types']
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

    public function store(tb_crm_mf_license_history_request $r)
    {
        $validatedData = $r->validated();
        $datum = new tb_crm_mf_license_history();
        $datum->fill($validatedData);
        $datum->save();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function show($id)
    {
        $datum = tb_crm_mf_license_history::findOrFail($id);
        $dropdowns = $this->get_dropdowns();
        $form_fields = view($this->view_path . '.show.form_fields', [
            'datum'             => $datum,
            'license_types'     => $dropdowns['license_types']
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
        $datum = tb_crm_mf_license_history::findOrFail($id);
        $head = view($this->view_path . '.edit.head')->render();
        $dropdowns = $this->get_dropdowns();
        $form_fields = view($this->view_path . '.edit.form_fields', [
            'datum'             => $datum,
            'license_types'     => $dropdowns['license_types']
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

    public function update(tb_crm_mf_license_history_request $r, $id)
    {
        $datum = tb_crm_mf_license_history::findOrFail($id);
        $validatedData = $r->validated();
        $datum->fill($validatedData);
        $datum->update();
        return redirect()->route($this->route . '.show', [$this->route_var => $datum->id])->with('status', 'Success!');
    }

    public function destroy(Request $r, $id)
    {
        $datum = tb_crm_mf_license_history::findOrFail($id);
        $pk = $datum->license_id;
        $datum->delete();
        return redirect()->route($this->header_route . '.show', [$this->header_route_var => $pk])->with('status', 'Success!');
    }

    private function get_dropdowns()
    {
        return [
            'license_types' => tb_crm_mf_license_type::get(),
        ];
    }
}
